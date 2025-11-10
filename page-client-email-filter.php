<?php
/*
Template Name: Client Email Filter (Service Based)
Description: সার্ভিসের meta data অনুযায়ী ক্লায়েন্টদের ইমেইল দেখাবে
*/

get_header();
global $wpdb;
?>

<!-- ✅ Bootstrap 4 -->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

<div class="container my-5">
    <div class="card shadow">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0">🎯 Filter Clients by Service Meta</h5>
        </div>
        <div class="card-body">
            <form method="get" class="row">
                <!-- client_status -->
                <div class="col-md-3">
                    <label><strong>client_status</strong></label>
                    <select name="client_status" class="form-control">
                        <option value="">-- All --</option>
                        <option value="Active" <?php selected($_GET['client_status'] ?? '', 'Active'); ?>>Active</option>
                        <option value="Inactive" <?php selected($_GET['client_status'] ?? '', 'Inactive'); ?>>Inactive</option>
                    </select>
                </div>

                <!-- Domain Provider -->
                <div class="col-md-3">
                    <label><strong>Domain Provider</strong></label>
                    <select name="domain_provider" class="form-control">
                        <option value="">-- All --</option>
                        <?php
                        $domain_values = $wpdb->get_col("
              SELECT DISTINCT meta_value FROM $wpdb->postmeta
              WHERE meta_key = 'domain_provider' AND meta_value != ''
              ORDER BY meta_value ASC
            ");
                        foreach ($domain_values as $domain) {
                            printf('<option value="%1$s" %2$s>%1$s</option>', esc_html($domain), selected($_GET['domain_provider'] ?? '', $domain, false));
                        }
                        ?>
                    </select>
                </div>

                <!-- Hosting Provider -->
                <div class="col-md-3">
                    <label><strong>Hosting Provider</strong></label>
                    <select name="hosting_provider" class="form-control">
                        <option value="">-- All --</option>
                        <?php
                        $hosting_values = $wpdb->get_col("
              SELECT DISTINCT meta_value FROM $wpdb->postmeta
              WHERE meta_key = 'hosting_provider' AND meta_value != ''
              ORDER BY meta_value ASC
            ");
                        foreach ($hosting_values as $hosting) {
                            printf('<option value="%1$s" %2$s>%1$s</option>', esc_html($hosting), selected($_GET['hosting_provider'] ?? '', $hosting, false));
                        }
                        ?>
                    </select>
                </div>

                <!-- Submit -->
                <div class="col-md-3 d-flex align-items-end">
                    <button type="submit" class="btn btn-success btn-block">Filter</button>
                </div>
            </form>
        </div>
    </div>

    <?php
    // =================== SERVICE QUERY ===================
    $service_args = array(
        'post_type'      => 'service',
        'posts_per_page' => -1,
        'meta_query'     => array('relation' => 'AND'),
        'fields'         => 'ids'
    );

    if (!empty($_GET['client_status'])) {
        $service_args['meta_query'][] = array(
            'key'     => 'client_status',
            'value'   => sanitize_text_field($_GET['client_status']),
            'compare' => '='
        );
    }

    if (!empty($_GET['domain_provider'])) {
        $service_args['meta_query'][] = array(
            'key'     => 'domain_provider',
            'value'   => sanitize_text_field($_GET['domain_provider']),
            'compare' => '='
        );
    }

    if (!empty($_GET['hosting_provider'])) {
        $service_args['meta_query'][] = array(
            'key'     => 'hosting_provider',
            'value'   => sanitize_text_field($_GET['hosting_provider']),
            'compare' => '='
        );
    }

    $services = new WP_Query($service_args);

    if ($services->have_posts()) {
        $client_ids = array();

        // ✅ collect all client IDs from service posts
        foreach ($services->posts as $service_id) {
            $cid = get_post_meta($service_id, 'client_id', true);
            if (!empty($cid)) $client_ids[] = $cid;
        }

        // remove duplicates
        $client_ids = array_unique($client_ids);

        // ✅ now query clients by IDs
        if (!empty($client_ids)) {
            $client_query = new WP_Query(array(
                'post_type' => 'clients',
                'post__in'  => $client_ids,
                'posts_per_page' => -1,
            ));

            $emails = array();
            while ($client_query->have_posts()) : $client_query->the_post();
                $email = get_post_meta(get_the_ID(), 'email', true);
                if (!empty($email)) $emails[] = $email;
            endwhile;
            wp_reset_postdata();

    ?>
            <div class="card mt-4 shadow">
                <div class="card-header bg-success text-white d-flex justify-content-between align-items-center">
                    <h6 class="mb-0">Filtered Client Emails (<?php echo count($emails); ?> found)</h6>
                    <button class="btn btn-light btn-sm" onclick="copyEmails()">Copy Emails</button>
                </div>
                <div class="card-body">
                    <?php if (!empty($emails)) : ?>
                        <textarea id="emailsBox" class="form-control" rows="6"><?php echo esc_textarea(implode(', ', $emails)); ?></textarea>
                        <small class="text-muted d-block mt-2">
                            কপি করে Mailchimp, Gmail বা অন্য ইমেইল মার্কেটিং টুলে ব্যবহার করতে পারবেন।
                        </small>
                    <?php else : ?>
                        <p class="text-danger mb-0">কোনো ই-মেইল পাওয়া যায়নি।</p>
                    <?php endif; ?>
                </div>
            </div>
    <?php
        } else {
            echo '<div class="alert alert-warning mt-4">কোনো ক্লায়েন্ট ID পাওয়া যায়নি।</div>';
        }
    } else {
        echo '<div class="alert alert-warning mt-4">কোনো সার্ভিস পাওয়া যায়নি।</div>';
    }
    ?>
</div>

<!-- ✅ Copy Button Script -->
<script>
    function copyEmails() {
        var textarea = document.getElementById('emailsBox');
        textarea.select();
        document.execCommand('copy');
        alert('✅ Email list copied!');
    }
</script>

<?php get_footer(); ?>
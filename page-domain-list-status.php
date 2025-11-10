<?php
/**
 * Template Name: Domain List (ACF Working)
 * Description: Status (Active/Inactive) এবং Provider অনুযায়ী Domain তালিকা দেখাবে
 */

get_header();
include_once('include/breadcrumb-design.php');
?>


<?php
$services = new WP_Query(array(
    'post_type' => 'service',
    'posts_per_page' => 5,
));

while($services->have_posts()) {
    $services->the_post();
    echo get_the_title() . ' - Status: ' . get_field('status') . '<br>';
}
wp_reset_postdata();

?>

<div class="container my-4">
    <div class="row">
        <div class="col-md-10 mx-auto">

            <h4 class="mb-3">Domain Service List</h4>

            <?php
            // ================= QUERY PARAMETERS =================
            $provider = isset($_GET['provider']) ? sanitize_text_field($_GET['provider']) : '';
            $status   = isset($_GET['status']) ? sanitize_text_field($_GET['status']) : '';

            // ================= STATUS MAP =================
            // DB-এ stored value অনুযায়ী map
            $status_map = array(
                'Active'   => 'Active',   // DB value check করুন
                'Inactive' => 'Inactive',
            );

            // ================= STATUS COUNT =================
            $active_count = new WP_Query(array(
                'post_type'      => 'service',
                'posts_per_page' => -1,
                'fields'         => 'ids',
                'meta_query'     => array(
                    array(
                        'key'     => 'status',
                        'value'   => $status_map['Active'],
                        'compare' => '=',
                    ),
                ),
            ));
            $active_count = $active_count->found_posts;
            wp_reset_postdata();

            $inactive_count = new WP_Query(array(
                'post_type'      => 'service',
                'posts_per_page' => -1,
                'fields'         => 'ids',
                'meta_query'     => array(
                    array(
                        'key'     => 'status',
                        'value'   => $status_map['Inactive'],
                        'compare' => '=',
                    ),
                ),
            ));
            $inactive_count = $inactive_count->found_posts;
            wp_reset_postdata();
            ?>

            <!-- ================= STATUS CARD ================= -->
            <div class="card mb-4 shadow-sm">
                <div class="card-header">
                    <h6 class="mb-0">Status</h6>
                </div>
                <div class="card-body p-0">
                    <ul class="list-unstyled p-0 list-group list-group-flush">
                        <?php foreach ($status_map as $status_name => $value) :
                            $link_args = array('status' => $status_name);
                            if ($provider) {
                                $link_args['provider'] = $provider;
                            }
                            $link = add_query_arg($link_args, site_url('/domain-list/'));
                        ?>
                            <li class="d-flex justify-content-between list-group-item">
                                <div class="status_title">
                                    <a href="<?php echo esc_url($link); ?>" class="text-dark text-capitalize fw-bold">
                                        <?php echo esc_html($status_name); ?>
                                    </a>
                                </div>
                                <div class="status_figure fw-bold">
                                    <?php echo esc_html($status_name == 'Active' ? $active_count : $inactive_count); ?>
                                </div>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            </div>
            <!-- ================= STATUS CARD END ================= -->

            <?php
            // ================= DOMAIN QUERY =================
            $args = array(
                'post_type'      => 'service',
                'posts_per_page' => -1,
                'orderby'        => 'date',
                'order'          => 'DESC',
            );

            $meta_query = array('relation' => 'AND');

            if (!empty($status) && isset($status_map[$status])) {
                $meta_query[] = array(
                    'key'     => 'status',
                    'value'   => $status_map[$status],
                    'compare' => '=',
                );
            }

            if (!empty($provider)) {
                $meta_query[] = array(
                    'key'     => 'domains_from',
                    'value'   => $provider,
                    'compare' => '=',
                );
            }

            if (count($meta_query) > 1) {
                $args['meta_query'] = $meta_query;
            }

            $query = new WP_Query($args);
            ?>

            <!-- ================= DOMAIN LIST TABLE ================= -->
            <div class="card shadow-sm">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h6 class="mb-0">
                        <?php
                        if ($provider) {
                            echo 'Provider: <span class="text-primary">' . esc_html($provider) . '</span>';
                        } elseif ($status) {
                            echo 'Status: <span class="text-primary">' . esc_html($status) . '</span>';
                        } else {
                            echo 'All Domains';
                        }
                        ?>
                    </h6>
                    <a href="<?php echo site_url('/domain-list'); ?>" class="btn btn-sm btn-outline-secondary">↩ Back</a>
                </div>

                <div class="card-body p-0">
                    <?php if ($query->have_posts()) : ?>
                        <div class="table-responsive">
                            <table id="domainTable" class="table table-striped mb-0 align-middle">
                                <thead class="table-light">
                                    <tr>
                                        <th>#</th>
                                        <th>Domain Name</th>
                                        <th>Client Name</th>
                                        <th>Domain From</th>
                                        <th>Hosting From</th>
                                        <th>Hosting Size</th>
                                        <th>Status</th>
                                        <th>Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $sl = 1;
                                    while ($query->have_posts()) :
                                        $query->the_post();

                                        $client_id    = get_field('client_id');
                                        $client_name  = $client_id ? get_the_title($client_id) : 'N/A';
                                        $domains_from = get_field('domains_from');
                                        $hosting_from = get_field('hosting_from');
                                        $hosting_size = get_field('hosting_size');
                                        $status_field = get_field('status');
                                        $date_field   = get_field('date');
                                    ?>
                                        <tr>
                                            <td><?php echo esc_html($sl++); ?></td>
                                            <td><?php the_title(); ?></td>
                                            <td><?php echo esc_html($client_name); ?></td>
                                            <td><?php echo esc_html($domains_from); ?></td>
                                            <td><?php echo esc_html($hosting_from); ?></td>
                                            <td><?php echo esc_html($hosting_size); ?> GB</td>
                                            <td>
                                                <?php if ($status_field == 'Active') : ?>
                                                    <span class="badge bg-success">Active</span>
                                                <?php else : ?>
                                                    <span class="badge bg-danger">Inactive</span>
                                                <?php endif; ?>
                                            </td>
                                            <td><?php echo esc_html($date_field); ?></td>
                                        </tr>
                                    <?php endwhile; ?>
                                </tbody>
                            </table>
                        </div>
                    <?php else : ?>
                        <div class="alert alert-warning text-center m-3">কোনো সার্ভিস পাওয়া যায়নি।</div>
                    <?php endif; ?>

                    <?php wp_reset_postdata(); ?>
                </div>
            </div>
            <!-- ================= DOMAIN LIST TABLE END ================= -->

        </div>
    </div>
</div>

<!-- ================= DATATABLES ================= -->
<link rel="stylesheet" href="https://cdn.datatables.net/2.3.4/css/dataTables.dataTables.min.css">
<script src="https://cdn.datatables.net/2.3.4/js/dataTables.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    new DataTable('#domainTable');
});
</script>

<?php get_footer();
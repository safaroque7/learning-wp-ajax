<?php
/**
 * Template Name: Domain Provider List
 * কাজ: নির্দিষ্ট প্রোভাইডারের অধীনে থাকা সব ডোমেইন (service পোস্ট) দেখাবে
 */

get_header();

$provider = isset($_GET['provider']) ? sanitize_text_field($_GET['provider']) : '';
?>

<!-- ✅ DataTables CSS -->
<link rel="stylesheet" href="https://cdn.datatables.net/2.3.4/css/dataTables.dataTables.min.css">

<div class="container my-4">
    <div class="card shadow-sm">
        <div class="card-header d-flex justify-content-between align-items-center">
            <div>
                <?php if ($provider): ?>
                    <h5 class="mb-0">"<?php echo esc_html($provider); ?>" প্রোভাইডারের ডোমেইন তালিকা</h5>
                <?php else: ?>
                    <h5 class="mb-0">সব প্রোভাইডারের ডোমেইন</h5>
                <?php endif; ?>
            </div>
            <a href="<?php echo esc_url(home_url('/clients'));?>" class="btn btn-sm btn-outline-secondary">⬅ Back</a>
        </div>

        <div class="card-body">
            <?php
            $args = array(
                'post_type'      => 'service',
                'posts_per_page' => -1,
            );

            // যদি নির্দিষ্ট প্রোভাইডার দেওয়া থাকে, তাহলে ফিল্টার করো
            if ($provider) {
                $args['meta_query'] = array(
                    array(
                        'key'     => 'domains_from',
                        'value'   => $provider,
                        'compare' => '=',
                    ),
                );
            }

            $services = new WP_Query($args);

            if ($services->have_posts()):
                ?>
                <div class="table-responsive">
                    <table id="domainTable" class="table table-striped table-bordered align-middle">
                        <thead class="table-light">
                            <tr>
                                <th>#</th>
                                <th>ডোমেইন নাম</th>
                                <th>ক্লায়েন্ট</th>
                                <th>তারিখ</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $i = 1;
                            while ($services->have_posts()): $services->the_post();
                                $client = get_field('client_id');
                                $client_name = $client ? get_the_title($client->ID) : '—';
                                $date = get_field('date');
                                ?>
                                <tr>
                                    <td><?php echo esc_html($i++); ?></td>
                                    <td>
                                        <!-- ✅ ডোমেইন নামকে পোস্টের লিঙ্কে যুক্ত করা হলো -->
                                        <a href="<?php the_permalink(); ?>" target="_blank"><?php the_title(); ?></a>
                                    </td>
                                    <td><?php echo esc_html($client_name); ?></td>
                                    <td><?php echo esc_html($date); ?></td>
                                </tr>
                            <?php endwhile; ?>
                        </tbody>
                    </table>
                </div>
            <?php
            else:
                echo '<p class="text-center text-muted">এই প্রোভাইডারের কোনো ডোমেইন পাওয়া যায়নি।</p>';
            endif;

            wp_reset_postdata();
            ?>
        </div>
    </div>
</div>

<!-- ✅ DataTables JS -->
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.datatables.net/2.3.4/js/dataTables.min.js"></script>

<script>
jQuery(document).ready(function($){
    // Initialize DataTable
    $('#domainTable').DataTable({
        "pageLength": 10, // প্রতি পেইজে কত রো দেখাবে
        "order": [[0, "asc"]],
        "language": {
            "search": "খোঁজ করুন:",
            "lengthMenu": "প্রতি পেইজে _MENU_ টি রেকর্ড দেখাও",
            "info": "মোট _TOTAL_ টি ডোমেইনের মধ্যে _START_ থেকে _END_ পর্যন্ত দেখানো হচ্ছে",
            "paginate": {
                "previous": "আগে",
                "next": "পরে"
            },
            "zeroRecords": "কোনো ফলাফল পাওয়া যায়নি"
        }
    });
});
</script>

<?php get_footer(); ?>
<?php

/**
 * Template Name: Single Client
 * প্রদর্শন করবে ক্লায়েন্টের বিস্তারিত তথ্য এবং তার সংশ্লিষ্ট সার্ভিস লিস্ট
 */
get_header();
include_once('include/breadcrumb-design.php');
?>

<!-- ✅ DataTables CSS -->
<link rel="stylesheet" href="https://cdn.datatables.net/2.3.4/css/dataTables.dataTables.min.css">

<!-- ✅ jQuery (DataTables-এর জন্য দরকার) -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- ✅ DataTables JS -->
<script src="https://cdn.datatables.net/2.3.4/js/dataTables.min.js"></script>

<div class="container my-4">
    <div class="row">

        <!-- ✅ Sidebar -->
        <div class="col-md-3">

            <!-- Back Button -->
            <div class="card mb-3">
                <div class="card-header">
                    <h6 class="mb-0">
                        <a href="<?php echo esc_url(home_url('clients')); ?>">
                            <i class="bi bi-arrow-left"></i> Back to Client Page
                        </a>
                    </h6>
                </div>
            </div>

            <!-- Client Information -->
            <div class="card mb-3">
                <div class="card-header">
                    <h6 class="mb-0">Client's Information</h6>
                </div>
                <div class="card-body p-0">
                    <ul class="list-unstyled p-0 list-group list-group-flush">
                        <li class="list-group-item">
                            <h6 class="text-dark mb-0"><?php the_title(); ?></h6>
                        </li>

                        <li class="list-group-item">
                            <h6 class="text-dark mb-0"><?php echo esc_html(get_field('phone')); ?></h6>
                        </li>

                        <li class="list-group-item">
                            <h6 class="text-dark mb-0"><?php echo esc_html(get_field('email')); ?></h6>
                        </li>

                        <li class="list-group-item">
                            <h6 class="text-dark mb-0"><?php echo esc_html(get_field('address')); ?></h6>
                        </li>

                        <li class="list-group-item">
                            <h6 class="text-dark mb-0"><?php echo esc_html(get_field('khata_no')); ?></h6>
                        </li>

                    </ul>
                </div>
            </div>

            <!-- ✅ Client's Others Information (Domain & Hosting Summary) -->
            <?php
            $current_client_id = get_the_ID();

            // ক্লায়েন্ট অনুযায়ী সার্ভিস ডাটা বের করা
            $service_summary = new WP_Query(array(
                'post_type'      => 'service',
                'posts_per_page' => -1,
                'meta_query'     => array(
                    array(
                        'key'     => 'client_id',
                        'value'   => $current_client_id,
                        'compare' => '=',
                    ),
                ),
            ));

            $total_domains = 0;
            $total_gb = 0;

            if ($service_summary->have_posts()):
                while ($service_summary->have_posts()): $service_summary->the_post();
                    $total_domains++;
                    $hosting_size = get_field('hosting_size');
                    if (is_numeric($hosting_size)) {
                        $total_gb += floatval($hosting_size);
                    }
                endwhile;
            endif;
            wp_reset_postdata();
            ?>

            <div class="card mb-3">
                <div class="card-header">
                    <h6 class="mb-0">Details</h6>
                </div>
                <div class="card-body p-0">
                    <ul class="list-unstyled p-0 list-group list-group-flush">
                        <!-- Domain Count -->
                        <li class="d-flex justify-content-between list-group-item">
                            <div class="status_title"> <a href="#" class="text-dark">Domain</a> </div>
                            <div class="status_figure"> <?php echo esc_html($total_domains); ?> </div>
                        </li>
                        <!-- Total Hosting -->
                        <li class="d-flex justify-content-between list-group-item">
                            <div class="status_title"> <a href="#" class="text-dark">Hosting</a> </div>
                            <div class="status_figure"> <?php echo esc_html($total_gb); ?> GB </div>
                        </li>
                    </ul>
                </div>
            </div>

        </div>

        <!-- ✅ Main Content -->
        <div class="col-md-9">
            <h4 class="mb-3">Client's Services</h4>

            <table class="table table-striped bg-white" id="myTable">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Domain</th>
                        <th>Domain From</th>
                        <th>Hosting From</th>
                        <th>GB</th>
                        <th>Status</th>
                        <th>Date</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $services = new WP_Query(array(
                        'post_type'      => 'service',
                        'posts_per_page' => -1,
                        'order'          => 'DESC',
                        'orderby'        => 'date',
                        'meta_query'     => array(
                            array(
                                'key'     => 'client_id',
                                'value'   => $current_client_id,
                                'compare' => '=',
                            ),
                        ),
                    ));

                    $slNumber = 1;

                    if ($services->have_posts()):
                        while ($services->have_posts()): $services->the_post(); ?>
                            <tr>
                                <td><?php echo $slNumber++; ?></td>
                                <td><a href="<?php echo esc_url(get_the_title()); ?>" class="text-dark"
                                        target="_blank"><?php the_title(); ?></a></td>
                                <td><?php echo esc_html(get_field('domains_from')); ?></td>
                                <td><?php echo esc_html(get_field('hosting_from')); ?></td>
                                <td>
                                    <?php
                                    $hosting_size = get_field('hosting_size');
                                    echo esc_html($hosting_size);
                                    if (!empty($hosting_size)) {
                                        echo 'GB';
                                    } else {
                                        echo 'None';
                                    }
                                    ?>
                                </td>
                                <td><?php echo esc_html(get_field('status')); ?></td>
                                <td>
                                    <?php
                                    $start_date = get_field('date');
                                    if (!empty($start_date)) {
                                        echo $start_date;
                                    } else {
                                        echo 'None';
                                    }
                                    ?>
                                </td>
                            </tr>
                        <?php endwhile;
                    else: ?>
                        <tr>
                            <td colspan="6" class="text-center text-muted">No service found for this client.</td>
                        </tr>
                    <?php endif;
                    wp_reset_postdata();
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- ✅ DataTables Initialize -->
<script>
    jQuery(document).ready(function($) {
        $('#myTable').DataTable({
            "paging": true,
            "searching": true,
            "info": true,
            "ordering": true,
            "autoWidth": false,
            "responsive": true
        });
    });
</script>

<?php get_footer(); ?>
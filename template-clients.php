<?php
/*
Template Name: Clients
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

<!-- ✅ Initialize the table -->
<script>
    jQuery(document).ready(function($) {
        $('#myTable').DataTable({
            "pageLength": 10,
            "order": [
                [0, "desc"]
            ]
        });
    });
</script>

<div class="container-fluid">
    <div class="row">
        <!-- Sidebar start -->
        <div class="col-md-2">

            <div class="card mb-3">
                <div class="card-header">
                    <h6 class="mb-0"> Email </h6>
                </div>

                <div class="card-body">
                    <form>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="option1" value="option1">
                            <label class="form-check-label" for="option1">
                                Option 1
                            </label>
                        </div>

                        <button type="submit" class="btn btn-success mt-3">Submit</button>
                    </form>
                </div>

            </div>

            <!-- ✅ Status card (Dynamic) -->
            <div class="card mb-3">
                <div class="card-header">
                    <h6 class="mb-0">Status</h6>
                </div>
                <div class="card-body p-0">
                    <ul class="list-unstyled p-0 list-group list-group-flush">

                        <?php
                        // সব service পোস্ট আনো (শুধু ID নাও পারফরম্যান্সের জন্য)
                        $services = new WP_Query(array(
                            'post_type'      => 'service',
                            'posts_per_page' => -1,
                            'fields'         => 'ids',
                        ));

                        $status_count = array();

                        if ($services->have_posts()) {
                            foreach ($services->posts as $service_id) {
                                $status = get_field('status', $service_id); // ACF ফিল্ড থেকে স্ট্যাটাস নাও

                                if (!empty($status)) {
                                    // কাউন্ট বাড়াও
                                    if (isset($status_count[$status])) {
                                        $status_count[$status]++;
                                    } else {
                                        $status_count[$status] = 1;
                                    }
                                }
                            }

                            // স্ট্যাটাসগুলো দেখাও
                            foreach ($status_count as $status_name => $count) {
                                // ✅ লিংক তৈরি: নির্দিষ্ট স্ট্যাটাস অনুযায়ী সার্ভিস তালিকা দেখাবে
                                $link = add_query_arg(
                                    'status',
                                    urlencode($status_name),
                                    site_url('/domain-list/') // আপনার "Domain Provider List" পেজের লিংক
                                );
                        ?>
                                <li class="d-flex justify-content-between list-group-item">
                                    <div class="status_title">
                                        <a href="<?php echo esc_url($link); ?>" class="text-dark text-capitalize">
                                            <?php echo esc_html($status_name); ?>
                                        </a>
                                    </div>
                                    <div class="status_figure fw-bold">
                                        <?php echo esc_html($count); ?>
                                    </div>
                                </li>
                        <?php
                            }
                        } else {
                            echo '<li class="list-group-item text-center text-muted">কোনো সার্ভিস পাওয়া যায়নি</li>';
                        }

                        wp_reset_postdata();
                        ?>
                    </ul>
                </div>
            </div>


            <!-- Domain card -->
            <div class="card mb-3">
                <div class="card-header">
                    <h6 class="mb-0"> Domain </h6>
                </div>

                <div class="card-body p-0">
                    <ul class="list-unstyled p-0 list-group list-group-flush">

                        <?php
                        // সব service পোস্ট আনো
                        $services = new WP_Query(array(
                            'post_type'      => 'service',
                            'posts_per_page' => -1,
                            'fields'         => 'ids', // শুধু আইডি আনলে দ্রুত কাজ করবে
                        ));

                        $provider_count = array();

                        if ($services->have_posts()) {
                            foreach ($services->posts as $service_id) {
                                // domains_from ফিল্ডের মান আনো
                                $provider = get_field('domains_from', $service_id);

                                if (!empty($provider)) {
                                    // কাউন্ট বাড়াও
                                    if (isset($provider_count[$provider])) {
                                        $provider_count[$provider]++;
                                    } else {
                                        $provider_count[$provider] = 1;
                                    }
                                }
                            }

                            // এখন তালিকা দেখাও
                            foreach ($provider_count as $provider_name => $count) {
                        ?>
                                <li class="d-flex justify-content-between list-group-item">
                                    <div class="status_title text-capitalize">


                                        <a href="<?php echo add_query_arg('provider', urlencode($provider_name), site_url('/domain-list/')); ?>"
                                            class="text-dark">
                                            <?php echo esc_html($provider_name); ?>
                                        </a>



                                    </div>
                                    <div class="status_figure fw-bold"><?php echo esc_html($count); ?></div>
                                </li>
                        <?php
                            }
                        } else {
                            echo '<li class="list-group-item text-center text-muted">কোনো সার্ভিস পাওয়া যায়নি</li>';
                        }

                        wp_reset_postdata();
                        ?>
                    </ul>
                </div>


            </div>

            <!-- Hosting card -->
            <div class="card mb-3">
                <div class="card-header">
                    <h6 class="mb-0"> Hosting </h6>
                </div>
                <div class="card-body p-0">
                    <ul class="list-unstyled p-0 list-group list-group-flush">
                        <li class="d-flex justify-content-between list-group-item">
                            <div class="status_title"><a href="#" class="text-dark"> Linkon Vai international </a></div>
                            <div class="status_figure"> 20GB </div>
                        </li>
                        <li class="d-flex justify-content-between list-group-item">
                            <div class="status_title"><a href="#" class="text-dark"> Linkon Vai BDiX </a></div>
                            <div class="status_figure"> 20GB </div>
                        </li>
                        <li class="d-flex justify-content-between list-group-item">
                            <div class="status_title"><a href="#" class="text-dark"> bdwebs.com </a></div>
                            <div class="status_figure"> 5GB </div>
                        </li>
                        <li class="d-flex justify-content-between list-group-item">
                            <div class="status_title"><a href="#" class="text-dark"> GoDadday </a></div>
                            <div class="status_figure"> 10GB </div>
                        </li>
                    </ul>
                </div>
            </div>

            <!-- News Post card -->
            <div class="card mb-3">
                <div class="card-header">
                    <h6 class="mb-0"> News Post </h6>
                </div>
                <div class="card-body p-0">
                    <ul class="list-unstyled p-0 list-group list-group-flush">
                        <li class="d-flex justify-content-between list-group-item">
                            <div class="status_title"><a href="#" class="text-dark"> nykagoj </a></div>
                            <div class="status_figure"> 5 </div>
                        </li>
                        <li class="d-flex justify-content-between list-group-item">
                            <div class="status_title"><a href="#" class="text-dark"> orthonitybangladesh </a></div>
                            <div class="status_figure"> 4 </div>
                        </li>
                        <li class="d-flex justify-content-between list-group-item">
                            <div class="status_title"><a href="#" class="text-dark"> akhauranews.com </a></div>
                            <div class="status_figure"> 2 </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- Sidebar end -->

        <!-- col-md-9 start -->
        <div class="col-md-10">
            <table class="table table-striped bg-white" id="myTable">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Phone Number</th>
                        <th>Email</th>
                        <th>Domains</th>
                        <th>Khatha No.</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $clients = new WP_Query(array(
                        'post_type' => 'clients',
                        'posts_per_page' => 20,
                        'order' => 'ASC',
                        'orderby' => 'date'
                    ));

                    $slNumber = $clients->found_posts;

                    while ($clients->have_posts()) : $clients->the_post();
                        $client_id = get_the_ID();

                        $domains = array();

                        // সব service পোস্ট
                        $services = get_posts(array(
                            'post_type' => 'service',
                            'posts_per_page' => -1,
                        ));

                        if ($services) {
                            foreach ($services as $service) {
                                $linked_clients = get_field('client_id', $service->ID); // relationship field

                                if ($linked_clients) {
                                    // linked_clients যদি array of WP_Post objects হয়
                                    if (is_array($linked_clients)) {
                                        foreach ($linked_clients as $linked_client) {
                                            if ($linked_client instanceof WP_Post) {
                                                if ($linked_client->ID == $client_id) {
                                                    $domain_field = get_field('domain', $service->ID);
                                                    if ($domain_field) {
                                                        if (is_array($domain_field)) {
                                                            $domains = array_merge($domains, $domain_field);
                                                        } else {
                                                            $domains[] = $domain_field;
                                                        }
                                                    }
                                                }
                                            }
                                        }
                                    } else {
                                        // single WP_Post object
                                        if ($linked_clients instanceof WP_Post && $linked_clients->ID == $client_id) {
                                            $domain_field = get_field('domain', $service->ID);
                                            if ($domain_field) $domains[] = $domain_field;
                                        }
                                    }
                                }
                            }
                        }
                    ?>
                        <tr>
                            <th><?php echo $slNumber--; ?></th>
                            <td><a href="<?php the_permalink(); ?>" class="text-dark"><?php the_title(); ?></a></td>
                            <td><?php echo esc_html(get_field('phone')); ?></td>
                            <td><?php echo esc_html(get_field('email')); ?></td>

                            <?php
                            $domains = array();
                            if ($services) {
                                foreach ($services as $service) {
                                    $linked_clients = get_field('client_id', $service->ID);

                                    // Relationship field WP_Post Object
                                    if ($linked_clients) {
                                        if (is_array($linked_clients)) {
                                            foreach ($linked_clients as $linked_client) {
                                                if ($linked_client->ID == $client_id) {
                                                    $domains[] = get_the_title($service->ID); // Service title as domain
                                                }
                                            }
                                        } else {
                                            if ($linked_clients->ID == $client_id) {
                                                $domains[] = get_the_title($service->ID); // Service title as domain
                                            }
                                        }
                                    }
                                }
                            }
                            ?>

                            <td><?php echo !empty($domains) ? implode(' <br> ', $domains) : 'No Domain'; ?></td>
                            <td><?php echo esc_html(get_field('khata_no')); ?></td>
                        </tr>
                    <?php endwhile;
                    wp_reset_postdata(); ?>
                </tbody>
            </table>
        </div>



    </div>
</div>

<?php get_footer();

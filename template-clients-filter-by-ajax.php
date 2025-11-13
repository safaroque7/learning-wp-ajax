<?php
/*
Template Name: Clients DataTable Page
*/
get_header();

// ===============================
// Password Protection Check
// ===============================
if ( post_password_required() ) {
    echo '<div class="container"><div class="row"><div class="col-12">';
    echo get_the_password_form();
    echo '</div></div></div>';
    get_footer();
    return; // Stop here if password not entered
}
?>



<style>
    .card-header {
        user-select: none;
    }

    .arrow {
        font-weight: bold;
    }
</style>

<div class="container-fluid my-4">
    <div class="row">

        <!-- Sidebar Filters -->
        <div class="col-md-2">

            <div class="card mb-2">
                <div class="card-header d-flex justify-content-between align-items-center text-white bg-dark"
                    style="cursor:pointer;" data-toggle="collapse" data-target="#collapse_email_phone_number">
                    <span class="text-white"> Email and Phone </span>
                    <span class="arrow text-white">&#9650;</span> <!-- Up arrow initially -->
                </div>
                <div id="collapse_email_phone_number" class="collapse show">

                    <div class="card-body p-0">
                        <div class="list-group">
                            <div class="list-group-item">
                                <label class="mb-0"><input type="checkbox" class="filter" value="email"
                                        data-type="show"> Show
                                    Email</label>
                            </div>
                            <div class="list-group-item">
                                <label class="mb-0"><input type="checkbox" class="filter" value="phone"
                                        data-type="show"> Show
                                    Phone</label>
                            </div>
                        </div>

                    </div>
                </div>
            </div>


            <?php
                global $wpdb;

                // Meta keys
                $meta_keys = [
                    'status'           => 'Status',
                    'domain_provider'  => 'Domain Provider',
                    'hosting_provider' => 'Hosting Provider',
                    'review'           => 'Review',
                    'project_type'     => 'Project Type'
                ];

                foreach ($meta_keys as $meta_key => $label) :
                    // Get values with count
                    $values = $wpdb->get_results("
                        SELECT pm.meta_value, COUNT(*) as count
                        FROM {$wpdb->postmeta} pm
                        INNER JOIN {$wpdb->posts} p ON p.ID = pm.post_id
                        WHERE pm.meta_key='{$meta_key}' AND p.post_type='services' AND p.post_status='publish'
                        GROUP BY pm.meta_value
                        ORDER BY pm.meta_value ASC
                    ");
                    if (!$values) continue;
                ?>
            <div class="card mb-2">
                <div class="card-header d-flex justify-content-between align-items-center text-white bg-dark"
                    style="cursor:pointer;" data-toggle="collapse"
                    data-target="#collapse_<?php echo esc_attr($meta_key); ?>">
                    <span class="text-white"><?php echo esc_html($label); ?></span>
                    <span class="arrow text-white">&#9650;</span> <!-- Up arrow initially -->
                </div>
                <div id="collapse_<?php echo esc_attr($meta_key); ?>" class="collapse show">
                    <div class="card-body p-0">
                        <div class="list-group">

                            <?php foreach ($values as $val) : ?>
                            <div class="list-group-item">
                                <label class="d-flex justify-content-between mb-0">

                                    <div class="meta-key-name">
                                        <input type="checkbox" class="filter"
                                            value="<?php echo esc_attr($val->meta_value); ?>"
                                            data-type="<?php echo esc_attr($meta_key); ?>">
                                        <?php echo esc_html($val->meta_value); ?>
                                    </div>
                                    <div class="figure-box">
                                        <?php echo intval($val->count); ?>
                                    </div>
                                </label>
                            </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>

        </div>

        <!-- Results -->
        <div class="col-md-10">
            <div class="bg-white p-md-3 p-1">
                <h3 class="text-center mb-3">
                    <div class="card">
                        <div class="card-header bg-secondary text-white">
                            <?php
                                $all_clients = new WP_Query(array(
                                    'post_type'     =>  'clients',
                                    'post_status'   =>  'publish',
                                    'numberposts'   =>   -1,
                                    'fields'        =>  'ids'
                                ));

                                $active_clients = new WP_Query(array(
                                    'post_type'     =>  'services',
                                    'post_status'   =>  'publish',
                                    'meta_key'      =>  'status',
                                    'meta_value'    =>  'Active',
                                    'fields'        =>  'ids',
                                    'nopaging'      =>  true
                                ));

                                //Total Clients
                                $total_clients = $all_clients->post_count;
                                
                                //Total Active Cleitns
                                $active_clients = $active_clients->post_count;

                                //Inactive Clients
                                $inactive_clients = $total_clients - $active_clients;
                                
                                echo 'Clients\' Information ( ' . $total_clients . ' / ' . $active_clients . ' / ' . $inactive_clients . ' )' ;
                            ?>

                        </div>
                    </div>
                </h3>
                <table id="clientTable" class="display w-100"></table>
            </div>
        </div>

    </div>
</div>

<!-- DataTables CSS & JS -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>

<script>
    jQuery(document).ready(function ($) {

        let table;
        let allData = [];

        // Load all clients once via AJAX
        function loadClients() {
            $.ajax({
                url: '<?php echo admin_url("admin-ajax.php"); ?>',
                type: 'POST',
                data: {
                    action: 'faroque_load_clients'
                },
                success: function (res) {
                    allData = res.data;
                    initDataTable(allData);
                }
            });
        }

        function initDataTable(data) {
            if (table) table.destroy();

            table = $('#clientTable').DataTable({
                data: data,
                columns: [{
                        data: 'sl',
                        title: 'SL'
                    },
                    {
                        data: 'name',
                        title: 'Client Name'
                    },
                    {
                        data: 'phone',
                        title: 'Phone'
                    },
                    {
                        data: 'email',
                        title: 'Email'
                    },
                    {
                        data: 'khatha_no',
                        title: 'Khatha No.'
                    },
                    {
                        data: 'domains',
                        title: 'Domains'
                    },
                    {
                        data: 'domain_provider',
                        title: 'Domain Provider'
                    },
                    {
                        data: 'hosting_provider',
                        title: 'Hosting Provider'
                    },
                    {
                        data: 'address',
                        title: 'Address'
                    },
                    {
                        data: 'status',
                        title: 'Status'
                    },
                    {
                        data: 'review',
                        title: 'Review'
                    }
                ],
                pageLength: 10,
                responsive: true,
                scrollX: true,
                autoWidth: false,
                drawCallback: function () {
                    updateExtraBoxes();
                }
            });

            applyFilters();
        }

        // Apply filters
        function applyFilters() {
            table.rows().every(function () {
                let rowData = this.data();

                let selectedStatus = $('.filter[data-type="status"]:checked').map(function () {
                    return $(this).val();
                }).get();
                let selectedDomains = $('.filter[data-type="domain_provider"]:checked').map(
                    function () {
                        return $(this).val();
                    }).get();
                let selectedHostings = $('.filter[data-type="hosting_provider"]:checked').map(
                    function () {
                        return $(this).val();
                    }).get();
                let selectedReviews = $('.filter[data-type="review"]:checked').map(function () {
                    return $(this).val();
                }).get();
                let selectedProjects = $('.filter[data-type="project_type"]:checked').map(
                    function () {
                        return $(this).val();
                    }).get();

                let statusMatch = selectedStatus.length === 0 || selectedStatus.some(s => rowData
                    .status
                    .includes(s));
                let domainMatch = selectedDomains.length === 0 || selectedDomains.some(d => rowData
                    .domain_provider.includes(d));
                let hostingMatch = selectedHostings.length === 0 || selectedHostings.some(h =>
                    rowData
                    .hosting_provider.includes(h));
                let reviewMatch = selectedReviews.length === 0 || selectedReviews.some(r => rowData
                    .review.includes(r));

                // Handle Project Type
                let projectTypes = [];
                if (rowData.project_type) {
                    if (Array.isArray(rowData.project_type)) projectTypes = rowData.project_type;
                    else projectTypes = rowData.project_type.split(',');
                }
                let projectMatch = selectedProjects.length === 0 || selectedProjects.some(p =>
                    projectTypes.includes(p));

                if (statusMatch && domainMatch && hostingMatch && reviewMatch && projectMatch) {
                    $(this.node()).show();
                } else {
                    $(this.node()).hide();
                }
            });

            updateExtraBoxes();
        }

        // Filter change events
        $('.filter').on('change', function () {
            applyFilters();
        });

        // Show Email / Phone boxes
        function updateExtraBoxes() {
            $('#extraBoxes').remove();

            let showFields = $('.filter[data-type="show"]:checked').map(function () {
                return $(this).val();
            }).get();
            if (showFields.length === 0) return;

            let selectedStatus = $('.filter[data-type="status"]:checked').map(function () {
                return $(this).val();
            }).get();
            let selectedDomains = $('.filter[data-type="domain_provider"]:checked').map(function () {
                return $(this).val();
            }).get();
            let selectedHostings = $('.filter[data-type="hosting_provider"]:checked').map(function () {
                return $(this).val();
            }).get();
            let selectedReviews = $('.filter[data-type="review"]:checked').map(function () {
                return $(this).val();
            }).get();
            let selectedProjects = $('.filter[data-type="project_type"]:checked').map(function () {
                return $(this).val();
            }).get();

            let rows = allData.filter(r => {
                let statusMatch = selectedStatus.length === 0 || selectedStatus.some(s => r.status
                    .includes(s));
                let domainMatch = selectedDomains.length === 0 || selectedDomains.some(d => r
                    .domain_provider.includes(d));
                let hostingMatch = selectedHostings.length === 0 || selectedHostings.some(h => r
                    .hosting_provider.includes(h));
                let reviewMatch = selectedReviews.length === 0 || selectedReviews.some(rv => r
                    .review
                    .includes(rv));

                // Project Type
                let projectTypes = [];
                if (r.project_type) {
                    if (Array.isArray(r.project_type)) projectTypes = r.project_type;
                    else projectTypes = r.project_type.split(',');
                }
                let projectMatch = selectedProjects.length === 0 || selectedProjects.some(p =>
                    projectTypes.includes(p));

                return statusMatch && domainMatch && hostingMatch && reviewMatch && projectMatch;
            });

            let boxHtml = '<div id="extraBoxes" class="my-3">';

            // Emails
            if (showFields.includes('email')) {
                let emails = rows.map(r => r.email).filter(e => e && e !== '-');
                if (emails.length) {
                    boxHtml += `<div class="mb-3">
                    <h6>All Emails (Total: ${emails.length})</h6>
                    <textarea id="emailListBox" class="form-control" rows="4">${emails.join(", ")}</textarea>
                    <button id="copyEmailsBtn" class="btn btn-sm btn-primary mt-2">Copy All Emails</button>
                </div>`;
                }
            }

            // Phones
            if (showFields.includes('phone')) {
                let phones = rows.map(r => r.phone).filter(p => p && p !== '-');
                if (phones.length) {
                    boxHtml += `<div class="mb-3">
                    <h6>All Phone Numbers (Total: ${phones.length})</h6>
                    <textarea id="phoneListBox" class="form-control" rows="4">${phones.join(", ")}</textarea>
                    <button id="copyPhonesBtn" class="btn btn-sm btn-success mt-2">Copy All Phones</button>
                </div>`;
                }
            }

            boxHtml += '</div>';
            $('#clientTable_wrapper').before(boxHtml);

            $('#copyEmailsBtn').on('click', function () {
                $('#emailListBox').select();
                document.execCommand('copy');
                alert('✅ All emails copied!');
            });
            $('#copyPhonesBtn').on('click', function () {
                $('#phoneListBox').select();
                document.execCommand('copy');
                alert('✅ All phone numbers copied!');
            });
        }

        // Initial load
        loadClients();

    });

    $('.collapse').on('shown.bs.collapse', function () {
        $(this).prev('.card-header').find('.arrow').html('▼');
    });
    $('.collapse').on('hidden.bs.collapse', function () {
        $(this).prev('.card-header').find('.arrow').html('▲');
    });
</script>



<?php get_footer();
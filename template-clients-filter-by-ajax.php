<?php
/*
Template Name: Clients DataTable Page
*/
get_header();
global $wpdb;
?>

<div class="container-fluid my-4">
    <div class="row">

        <!-- Sidebar Filters -->
        <div class="col-md-2">
            <div class="bg-white p-md-3 p-2">
                <h5 class="mb-3">Filters</h5>

                <div class="list-group">

                    <!-- Show Emails and Phone -->
                    <h6 class="mb-2">Show Emails and Phone</h6>
                    <label><input type="checkbox" class="filter" value="email" data-type="show"> Show Email</label>
                    <label><input type="checkbox" class="filter" value="phone" data-type="show"> Show Phone</label>

                    <hr>

                    <!-- Filter by Status -->
                    <?php
                    $statuses = $wpdb->get_col("
                        SELECT DISTINCT pm.meta_value
                        FROM $wpdb->postmeta pm
                        INNER JOIN $wpdb->posts p ON p.ID = pm.post_id
                        WHERE pm.meta_key = 'status'
                        AND pm.meta_value != ''
                        AND p.post_type = 'services'
                        AND p.post_status = 'publish'
                        ORDER BY pm.meta_value ASC
                    ");
                    if ($statuses) {
                        echo '<h6 class="mb-2">Filter by Status</h6>';
                        foreach ($statuses as $status) {
                            echo '<label class="d-block"><input type="checkbox" class="filter" value="' . esc_attr($status) . '" data-type="status"> ' . esc_html(ucfirst($status)) . '</label>';
                        }
                    }
                    ?>

                    <hr>

                    <!-- Filter by Domain Provider -->
                    <?php
                    $domain_providers = $wpdb->get_col("
                        SELECT DISTINCT pm.meta_value
                        FROM $wpdb->postmeta pm
                        INNER JOIN $wpdb->posts p ON p.ID = pm.post_id
                        WHERE pm.meta_key = 'domain_provider'
                        AND pm.meta_value != ''
                        AND p.post_type = 'services'
                        AND p.post_status = 'publish'
                        ORDER BY pm.meta_value ASC
                    ");
                    if ($domain_providers) {
                        echo '<h6 class="mb-2 mt-3">Filter by Domain Provider</h6>';
                        foreach ($domain_providers as $provider) {
                            echo '<label><input type="checkbox" class="filter" value="' . esc_attr($provider) . '" data-type="domain_provider"> ' . esc_html($provider) . '</label>';
                        }
                    }
                    ?>

                    <hr>

                    <!-- Filter by Hosting Provider -->
                    <?php
                    $hosting_providers = $wpdb->get_col("
                        SELECT DISTINCT pm.meta_value
                        FROM $wpdb->postmeta pm
                        INNER JOIN $wpdb->posts p ON p.ID = pm.post_id
                        WHERE pm.meta_key = 'hosting_provider'
                        AND pm.meta_value != ''
                        AND p.post_type = 'services'
                        AND p.post_status = 'publish'
                        ORDER BY pm.meta_value ASC
                    ");
                    if ($hosting_providers) {
                        echo '<h6 class="mb-2 mt-3">Filter by Hosting Provider</h6>';
                        foreach ($hosting_providers as $provider) {
                            echo '<label><input type="checkbox" class="filter" value="' . esc_attr($provider) . '" data-type="hosting_provider"> ' . esc_html($provider) . '</label>';
                        }
                    }
                    ?>

                    <hr>

                    <!-- Filter by Review -->
                    <?php
                    $reviews = $wpdb->get_col("
                        SELECT DISTINCT pm.meta_value
                        FROM $wpdb->postmeta pm
                        INNER JOIN $wpdb->posts p ON p.ID = pm.post_id
                        WHERE pm.meta_key = 'review'
                        AND pm.meta_value != ''
                        AND p.post_type = 'services'
                        AND p.post_status = 'publish'
                        ORDER BY pm.meta_value DESC
                    ");
                    if ($reviews) {
                        echo '<h6 class="mb-2 mt-3">Filter by Review</h6>';
                        foreach ($reviews as $review) {
                            echo '<label><input type="checkbox" class="filter" value="' . esc_attr($review) . '" data-type="review"> ' . esc_html($review) . '</label>';
                        }
                    }
                    ?>

                </div>
            </div>
        </div>

        <!-- Results -->
        <div class="col-md-10">
            <div class="bg-white p-md-3 p-1">
                <h3 class="text-center"> Clients' Information </h3>
                <table id="clientTable" class="display w-100 bg-white"></table>
            </div>
        </div>
    </div>
</div>

<!-- DataTables CSS & JS -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>

<script>
jQuery(document).ready(function($) {

    let table = $('#clientTable').DataTable({
        ajax: {
            url: '<?php echo admin_url("admin-ajax.php"); ?>',
            type: 'POST',
            data: function(d) {
                let filters = {};
                $('.filter:checked').each(function() {
                    let type = $(this).data('type');
                    if (!filters[type]) filters[type] = [];
                    filters[type].push($(this).val());
                });
                d.action = 'faroque_filter_clients';
                d.filters = filters;
            },
            dataSrc: 'data'
        },
        columns: [
            { data: 'sl', title: 'SL' },
            { data: 'name', title: 'Client Name' },
            { data: 'email', title: 'Email' },
            { data: 'khatha_no', title: 'Khatha No.' },
            { data: 'phone', title: 'Phone' },
            { data: 'address', title: 'Address' },
            { data: 'status', title: 'Status' },
            { data: 'domain_provider', title: 'Domain Provider' },
            { data: 'review', title: 'Review' },
            { data: 'hosting_provider', title: 'Hosting Provider' }
        ],
        pageLength: 10,
        responsive: true
    });

    // Filter checkbox change
    $('.filter').on('change', function() {
        table.ajax.reload();
        showExtraBoxes();
    });

    // Show Email / Phone Box
    function showExtraBoxes() {
        $('#extraBoxes').remove();

        let showFields = [];
        $('.filter[data-type="show"]:checked').each(function() {
            showFields.push($(this).val());
        });

        if (showFields.length === 0) return;

        let boxHtml = '<div id="extraBoxes" class="my-3">';
        let data = table.ajax.json();
        if (!data || !data.data) return;

        // Emails
        if (showFields.includes('email')) {
            let emails = data.data.map(row => row.email).filter(e => e);
            if (emails.length) {
                boxHtml += `
                    <div class="mb-3">
                        <h6>All Emails (Total: ${emails.length})</h6>
                        <textarea id="emailListBox" class="form-control" rows="4">${emails.join(", ")}</textarea>
                        <button id="copyEmailsBtn" class="btn btn-sm btn-primary mt-2">Copy All Emails</button>
                    </div>
                `;
            }
        }

        // Phones
        if (showFields.includes('phone')) {
            let phones = data.data.map(row => row.phone).filter(p => p);
            if (phones.length) {
                boxHtml += `
                    <div class="mb-3">
                        <h6>All Phone Numbers(Total: ${phones.length})</h6>
                        <textarea id="phoneListBox" class="form-control" rows="4">${phones.join(", ")}</textarea>
                        <button id="copyPhonesBtn" class="btn btn-sm btn-success mt-2">Copy All Phones</button>
                    </div>
                `;
            }
        }

        boxHtml += '</div>';
        $('#clientTable_wrapper').before(boxHtml);

        $('#copyEmailsBtn').on('click', function() {
            $('#emailListBox').select();
            document.execCommand('copy');
            alert('✅ All emails copied!');
        });
        $('#copyPhonesBtn').on('click', function() {
            $('#phoneListBox').select();
            document.execCommand('copy');
            alert('✅ All phone numbers copied!');
        });
    }

    // Table redraw এ boxes আপডেট
    table.on('draw', function() {
        showExtraBoxes();
    });

});
</script>
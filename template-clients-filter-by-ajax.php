<?php
/*
Template Name: Clients DataTable Page
*/
get_header();
global $wpdb;

// ===============================
// Password Protection
// ===============================
if (post_password_required()) {
    echo get_the_password_form();
    get_footer();
    return;
}
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
                    <h6 class="mb-2">Filter by Status</h6>
                    <?php
                    $statuses = $wpdb->get_col("
                        SELECT DISTINCT pm.meta_value
                        FROM {$wpdb->postmeta} pm
                        INNER JOIN {$wpdb->posts} p ON p.ID = pm.post_id
                        WHERE pm.meta_key='status' AND p.post_type='services' AND p.post_status='publish'
                        ORDER BY pm.meta_value ASC
                    ");
                    foreach ($statuses as $status) {
                        echo '<label><input type="checkbox" class="filter" value="' . esc_attr($status) . '" data-type="status"> ' . esc_html($status) . '</label>';
                    }
                    ?>

                    <hr>

                    <!-- Filter by Domain Provider -->
                    <h6 class="mb-2">Filter by Domain Provider</h6>
                    <?php
                    $domains = $wpdb->get_col("
                        SELECT DISTINCT pm.meta_value
                        FROM {$wpdb->postmeta} pm
                        INNER JOIN {$wpdb->posts} p ON p.ID = pm.post_id
                        WHERE pm.meta_key='domain_provider' AND p.post_type='services' AND p.post_status='publish'
                        ORDER BY pm.meta_value ASC
                    ");
                    foreach ($domains as $d) {
                        echo '<label><input type="checkbox" class="filter" value="' . esc_attr($d) . '" data-type="domain_provider"> ' . esc_html($d) . '</label>';
                    }
                    ?>

                    <hr>

                    <!-- Filter by Hosting Provider -->
                    <h6 class="mb-2">Filter by Hosting Provider</h6>
                    <?php
                    $hosts = $wpdb->get_col("
                        SELECT DISTINCT pm.meta_value
                        FROM {$wpdb->postmeta} pm
                        INNER JOIN {$wpdb->posts} p ON p.ID = pm.post_id
                        WHERE pm.meta_key='hosting_provider' AND p.post_type='services' AND p.post_status='publish'
                        ORDER BY pm.meta_value ASC
                    ");
                    foreach ($hosts as $h) {
                        echo '<label><input type="checkbox" class="filter" value="' . esc_attr($h) . '" data-type="hosting_provider"> ' . esc_html($h) . '</label>';
                    }
                    ?>

                    <hr>

                    <!-- Filter by Review -->
                    <h6 class="mb-2">Filter by Review</h6>
                    <?php
                    $reviews = $wpdb->get_col("
                        SELECT DISTINCT pm.meta_value
                        FROM {$wpdb->postmeta} pm
                        INNER JOIN {$wpdb->posts} p ON p.ID = pm.post_id
                        WHERE pm.meta_key='review' AND p.post_type='services' AND p.post_status='publish'
                        ORDER BY pm.meta_value ASC
                    ");
                    foreach ($reviews as $r) {
                        echo '<label><input type="checkbox" class="filter" value="' . esc_attr($r) . '" data-type="review"> ' . esc_html($r) . '</label>';
                    }
                    ?>

                    <hr>

                    <!-- Filter By Project Type -->
                    <h6> Filter by Project Type </h6>
                    <?php 
                        $projectTypes = $wpdb->get_col("
                            SELECT DISTINCT pm.meta_value
                            FROM {$wpdb->postmeta} pm
                            INNER JOIN {$wpdb->posts} p ON p.ID = pm.post_id
                            WHERE pm.meta_key='project_type' AND p.post_type='services' AND p.post_status='publish'
                            ORDER BY pm.meta_value ASC
                        ");
                        foreach($projectTypes as $projectType ) {
                            echo '<label> <input type="checkbox" class="filter" value="' . esc_attr($projectType) . '" data-type="project_type"> ' . esc_html($projectType) . '</label>';
                        };
                     ?>

                </div>
            </div>
        </div>

        <!-- Results -->
        <div class="col-md-10">
            <div class="bg-white p-md-3 p-1">
                <h3 class="text-center mb-3"> 
                    <div class="card">
                        <div class="card-header bg-secondary text-white">
                            Clients' Information
                        </div>
                </div> </h3>
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
            data: { action: 'faroque_load_clients' },
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
            columns: [
                { data: 'sl', title: 'SL' },
                { data: 'name', title: 'Client Name' },
                { data: 'phone', title: 'Phone' },
                { data: 'email', title: 'Email' },
                { data: 'khatha_no', title: 'Khatha No.' },
                { data: 'domains', title: 'Domains' },
                { data: 'domain_provider', title: 'Domain Provider' },
                { data: 'hosting_provider', title: 'Hosting Provider' },
                { data: 'address', title: 'Address' },
                { data: 'status', title: 'Status' },
                { data: 'review', title: 'Review' }
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

            let selectedStatus = $('.filter[data-type="status"]:checked').map(function () { return $(this).val(); }).get();
            let selectedDomains = $('.filter[data-type="domain_provider"]:checked').map(function () { return $(this).val(); }).get();
            let selectedHostings = $('.filter[data-type="hosting_provider"]:checked').map(function () { return $(this).val(); }).get();
            let selectedReviews = $('.filter[data-type="review"]:checked').map(function () { return $(this).val(); }).get();
            let selectedProjects = $('.filter[data-type="project_type"]:checked').map(function () { return $(this).val(); }).get();

            let statusMatch = selectedStatus.length === 0 || selectedStatus.some(s => rowData.status.includes(s));
            let domainMatch = selectedDomains.length === 0 || selectedDomains.some(d => rowData.domain_provider.includes(d));
            let hostingMatch = selectedHostings.length === 0 || selectedHostings.some(h => rowData.hosting_provider.includes(h));
            let reviewMatch = selectedReviews.length === 0 || selectedReviews.some(r => rowData.review.includes(r));

            // Handle Project Type
            let projectTypes = [];
            if (rowData.project_type) {
                if (Array.isArray(rowData.project_type)) projectTypes = rowData.project_type;
                else projectTypes = rowData.project_type.split(',');
            }
            let projectMatch = selectedProjects.length === 0 || selectedProjects.some(p => projectTypes.includes(p));

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

        let showFields = $('.filter[data-type="show"]:checked').map(function () { return $(this).val(); }).get();
        if (showFields.length === 0) return;

        let selectedStatus = $('.filter[data-type="status"]:checked').map(function () { return $(this).val(); }).get();
        let selectedDomains = $('.filter[data-type="domain_provider"]:checked').map(function () { return $(this).val(); }).get();
        let selectedHostings = $('.filter[data-type="hosting_provider"]:checked').map(function () { return $(this).val(); }).get();
        let selectedReviews = $('.filter[data-type="review"]:checked').map(function () { return $(this).val(); }).get();
        let selectedProjects = $('.filter[data-type="project_type"]:checked').map(function () { return $(this).val(); }).get();

        let rows = allData.filter(r => {
            let statusMatch = selectedStatus.length === 0 || selectedStatus.some(s => r.status.includes(s));
            let domainMatch = selectedDomains.length === 0 || selectedDomains.some(d => r.domain_provider.includes(d));
            let hostingMatch = selectedHostings.length === 0 || selectedHostings.some(h => r.hosting_provider.includes(h));
            let reviewMatch = selectedReviews.length === 0 || selectedReviews.some(rv => r.review.includes(rv));

            // Project Type
            let projectTypes = [];
            if (r.project_type) {
                if (Array.isArray(r.project_type)) projectTypes = r.project_type;
                else projectTypes = r.project_type.split(',');
            }
            let projectMatch = selectedProjects.length === 0 || selectedProjects.some(p => projectTypes.includes(p));

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
</script>

<?php get_footer(); ?>
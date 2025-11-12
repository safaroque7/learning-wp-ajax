<?php
/*
Template Name: Client Details Page
*/
get_header();

// ===============================
// Password Protection Check
// ===============================
if (post_password_required()) {
    echo get_the_password_form();
    get_footer();
    return; // Password না দেওয়া হলে বাকি অংশ লোড হবে না
}

// ================
// Get Client ID
// ================
$client_id = isset($_GET['client_id']) ? intval($_GET['client_id']) : 0;

if (!$client_id) {
    echo '<div class="container py-5"><h4>No client selected.</h4></div>';
    get_footer();
    exit;
}

// Get Client Info
$client = get_post($client_id);
if (!$client || $client->post_type !== 'clients') {
    echo '<div class="container py-5"><h4>Invalid client.</h4></div>';
    get_footer();
    exit;
}

$client_name  = esc_html(get_the_title($client_id));
$phone        = esc_html(get_field('phone_number', $client_id));
$email        = esc_html(get_field('client_email', $client_id));
$address      = esc_html(get_field('client_address', $client_id));

// ==========================
// Client Photo Handling
// ==========================
$client_photo = get_field('client_photo', $client_id); // ACF Image field
$featured_img = get_the_post_thumbnail_url($client_id, 'medium');

if ($client_photo) {
    $photo_url = esc_url($client_photo['url']);
} elseif ($featured_img) {
    $photo_url = esc_url($featured_img);
} else {
    $photo_url = 'https://placehold.co/300x300?text=No+Image';
}


// ==========================
// Get all services of client
// ==========================
$all_services = get_posts([
    'post_type'      => 'services',
    'posts_per_page' => -1,
    'post_status'    => 'publish',
    'meta_query'     => [
        [
            'key'     => 'client_id',
            'value'   => $client_id,
            'compare' => '='
        ]
    ]
]);
$total_domains = count($all_services);

// ==========================
// Count by status
// ==========================
$status_counts = ['Active' => 0, 'Inactive' => 0, 'Pending' => 0];
foreach ($all_services as $srv) {
    $st = get_field('status', $srv->ID);
    if (isset($status_counts[$st])) {
        $status_counts[$st]++;
    }
}

// ==========================
// Determine Header Gradient and Total Domains Card Class
// ==========================
$statuses = array_map(function ($srv) {
    return get_field('status', $srv->ID);
}, $all_services);

if (!$statuses) {
    $header_gradient = 'linear-gradient(135deg, #007bff, #6610f2)';
    $domain_card_class = 'bg-primary text-white';
} elseif (count(array_unique($statuses)) === 1) {
    if ($statuses[0] === 'Active') {
        $header_gradient = 'linear-gradient(135deg, #28a745, #218838)';
        $domain_card_class = 'bg-success text-white';
    } elseif ($statuses[0] === 'Inactive') {
        $header_gradient = 'linear-gradient(135deg, #dc3545, #c82333)';
        $domain_card_class = 'bg-danger text-white';
    } else {
        $header_gradient = 'linear-gradient(135deg, #6c757d, #495057)';
        $domain_card_class = 'bg-secondary text-white';
    }
} else {
    $header_gradient = 'linear-gradient(135deg, #007bff, #6610f2)';
    $domain_card_class = 'bg-primary text-white';
}
?>

<!-- Bootstrap 4 CSS -->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap4.min.css">

<style>
    .client-card {
        border: none;
        overflow: hidden;
        border-radius: 15px;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.15);
        margin-bottom: 20px;
    }

    .client-header {
        color: #fff;
        text-align: center;
        padding: 25px 15px;
        background: <?php echo $header_gradient;
                    ?>;
    }

    .client-header img {
        width: 100px;
        height: 100px;
        border-radius: 50%;
        border: 3px solid #fff;
        object-fit: cover;
        margin-bottom: 10px;
    }

    .client-header h4 {
        margin: 0;
        font-weight: 600;
    }

    .client-info p {
        margin-bottom: 6px;
    }

    .client-info strong {
        width: 90px;
        display: inline-block;
    }

    .back-btn {
        margin-bottom: 15px;
    }

    .table td,
    .table th {
        vertical-align: middle !important;
    }
</style>

<div class="container-fluid my-5">
    <div class="row">
        <!-- Left Side: Contact Info + Total Domains -->
        <div class="col-md-2">
            <!-- Back Button -->
            <a href="<?php echo site_url('/clients/'); ?>" class="btn btn-outline-primary btn-sm mb-3">
                &larr; Back to Clients
            </a>

            <!-- Contact Info Card -->
            <div class="card mb-3">
                <div class="card-body text-center">
                    <img src="<?php echo $photo_url; ?>" alt="<?php echo $client_name; ?>"
                        class="img-fluid rounded-circle mb-3" style="width:120px; height:120px; object-fit:cover;">
                    <h4 class="card-title"><?php echo $client_name; ?></h4>
                </div>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item">
                        <strong>📞 Phone:</strong><br>
                        <?php echo $phone ?: '-'; ?>
                    </li>
                    <li class="list-group-item">
                        <strong>✉️ Email:</strong><br>
                        <?php echo $email ?: '-'; ?>
                    </li>
                    <li class="list-group-item">
                        <strong>📍 Address:</strong><br>
                        <?php echo $address ?: '-'; ?>
                    </li>
                </ul>
            </div>

            <!-- Total Domains Card -->
            <div class="card mb-3">
                <div class="card-header">
                    Total Domains: <?php echo $total_domains; ?>
                </div>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        Active
                        <span class="badge badge-success badge-pill"><?php echo $status_counts['Active']; ?></span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        Inactive
                        <span class="badge badge-danger badge-pill"><?php echo $status_counts['Inactive']; ?></span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        Pending
                        <span class="badge badge-primary badge-pill"><?php echo $status_counts['Pending']; ?></span>
                    </li>
                </ul>
            </div>
        </div>


        <!-- Right Side: Domain/Service Table -->
        <div class="col-md-10">
            <div class="card shadow-sm border-0">
                <div class="card-body">
                    <h5 class="card-title mb-3 font-weight-bold text-primary">
                        <i class="fas fa-globe"></i> Domains / Services
                    </h5>
                    <?php if ($total_domains > 0): ?>
                        <div class="table-responsive">
                            <table id="clientServices" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Domain Name</th>
                                        <th>Khatha No</th>
                                        <th>Domain Provider</th>
                                        <th>Hosting Provider</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $i = 1;
                                    foreach ($all_services as $srv):
                                        $domain_name = esc_html($srv->post_title);
                                        $khatha = esc_html(get_field('khatha_no', $srv->ID));
                                        $domain_provider = esc_html(get_field('domain_provider', $srv->ID));
                                        $hosting_provider = esc_html(get_field('hosting_provider', $srv->ID));
                                        $status = esc_html(get_field('status', $srv->ID));
                                    ?>
                                        <tr>
                                            <td><?php echo $i++; ?></td>
                                            <td><a href="https://<?php echo $domain_name; ?>"
                                                    target="_blank"><?php echo $domain_name; ?></a></td>
                                            <td><?php echo $khatha ?: '-'; ?></td>
                                            <td><?php echo $domain_provider ?: '-'; ?></td>
                                            <td><?php echo $hosting_provider ?: '-'; ?></td>
                                            <td>
                                                <?php
                                                if ($status === 'Active') {
                                                    echo '<span class="badge badge-success">Active</span>';
                                                } elseif ($status === 'Inactive') {
                                                    echo '<span class="badge badge-danger">Inactive</span>';
                                                } else {
                                                    echo '<span class="badge badge-primary">' . ($status ?: '-') . '</span>';
                                                }
                                                ?>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    <?php else: ?>
                        <p class="text-muted">No services found for this client.</p>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- jQuery + Bootstrap + DataTables + FontAwesome -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap4.min.js"></script>
<script src="https://kit.fontawesome.com/a2e0e6ad3d.js" crossorigin="anonymous"></script>

<script>
    jQuery(document).ready(function($) {
        $('#clientServices').DataTable({
            pageLength: 10,
            order: [
                [0, 'asc']
            ],
            language: {
                search: "_INPUT_",
                searchPlaceholder: "Search domain..."
            }
        });
    });
</script>

<?php get_footer(); ?>
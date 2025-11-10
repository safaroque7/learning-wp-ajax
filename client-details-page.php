<?php
/*
Template Name: Client Detail Page
*/

get_header();
global $wpdb;

// Get client ID from URL
$client_id = isset($_GET['client_id']) ? $_GET['client_id'] : 0;
if (!$client_id) {
    echo "Invalid client ID.";
    get_footer();
    exit;
}

// Fetch client details from database
$client = $wpdb->get_row($wpdb->prepare("
    SELECT * 
    FROM $wpdb->posts p
    LEFT JOIN $wpdb->postmeta pm ON p.ID = pm.post_id
    WHERE p.ID = %d
    AND p.post_type = 'services'
", $client_id));

if (!$client) {
    echo "Client not found.";
    get_footer();
    exit;
}

// Fetch client's domains
$domains = get_post_meta($client_id, 'domains', true);

?>

<div class="container">
    <h2>Client Detail - <?php echo esc_html($client->post_title); ?></h2>
    <p><strong>Email:</strong> <?php echo esc_html(get_post_meta($client_id, 'email', true)); ?></p>
    <p><strong>Phone:</strong> <?php echo esc_html(get_post_meta($client_id, 'phone', true)); ?></p>
    <p><strong>Khatha No:</strong> <?php echo esc_html(get_post_meta($client_id, 'khatha_no', true)); ?></p>
    <h3>Domains</h3>
    <ul>
        <?php if ($domains) {
            foreach ($domains as $domain) {
                echo "<li><a href='https://$domain' target='_blank'>$domain</a></li>";
            }
        } else {
            echo "<li>No domains found for this client.</li>";
        } ?>
    </ul>
</div>

<?php
get_footer();
?>

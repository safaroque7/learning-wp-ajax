<?php 
// Phone Number ইউনিক চেক
add_filter('acf/validate_value/name=phone_number', function($valid, $value, $field, $input) {
    if (!$valid) return $valid;

    $post_id = $_POST['post_ID'] ?? 0; // যদি edit mode হয়
    $args = [
        'post_type'      => 'clients',
        'posts_per_page' => 1,
        'post__not_in'   => [$post_id], // নিজের পোস্ট বাদ
        'meta_query'     => [
            ['key' => 'phone_number', 'value' => $value, 'compare' => '=']
        ]
    ];
    $query = new WP_Query($args);
    if ($query->have_posts()) return 'This phone number is already used!';
    return $valid;
}, 10, 4);

// Client Email ইউনিক চেক
add_filter('acf/validate_value/name=client_email', function($valid, $value, $field, $input) {
    if (!$valid) return $valid;

    $post_id = $_POST['post_ID'] ?? 0; // যদি edit mode হয়
    $args = [
        'post_type'      => 'clients',
        'posts_per_page' => 1,
        'post__not_in'   => [$post_id], // নিজের পোস্ট বাদ
        'meta_query'     => [
            ['key' => 'client_email', 'value' => $value, 'compare' => '=']
        ]
    ];
    $query = new WP_Query($args);
    if ($query->have_posts()) return 'This email is already used!';
    return $valid;
}, 10, 4);


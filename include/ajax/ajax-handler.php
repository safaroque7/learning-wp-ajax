<?php
add_action('wp_ajax_faroque_filter_clients', 'faroque_filter_clients');
add_action('wp_ajax_nopriv_faroque_filter_clients', 'faroque_filter_clients');

function faroque_filter_clients() {
    global $wpdb;

    $filters = isset($_POST['filters']) ? $_POST['filters'] : array();

    $meta_query = array('relation' => 'AND');

    foreach (['status','domain_provider','review','hosting_provider'] as $key) {
        if (!empty($filters[$key])) {
            $meta_query[] = array(
                'key' => $key,
                'value' => $filters[$key],
                'compare' => 'IN'
            );
        }
    }

    $search = !empty($filters['search']) ? sanitize_text_field($filters['search']) : '';

    $args = array(
        'post_type' => 'services',
        'posts_per_page' => -1, // DataTables pagination handled client-side
        'post_status' => 'publish',
        's' => $search,
        'meta_query' => $meta_query
    );

    $query = new WP_Query($args);

    $data = [];
    $emails = [];
    $phones = [];
    $sl = 1; // Serial number

    if ($query->have_posts()) {
        while ($query->have_posts()) {
            $query->the_post();
            $service_id = get_the_ID();

            // Services meta
            $status = get_post_meta($service_id, 'status', true);
            $domain_provider = get_post_meta($service_id, 'domain_provider', true);
            $review = get_post_meta($service_id, 'review', true);
            $hosting_provider = get_post_meta($service_id, 'hosting_provider', true);
            $khatha_no = get_post_meta($service_id, 'khatha_no', true);

              

            // Clients ACF relationship
            $client_id = get_field('client_id', $service_id);
            if ($client_id) {
                $client_name = get_the_title($client_id);
                $client_email = get_field('client_email', $client_id);
              
                $phone_number = get_field('phone_number', $client_id);
                $client_address = get_field('client_address', $client_id);

                if ($client_email) $emails[] = $client_email;
                if ($phone_number) $phones[] = $phone_number;

                $data[] = [
                    'sl' => $sl++, // Serial Number
                    'name' => esc_html($client_name),
                    'email' => esc_html($client_email),
                    'khatha_no' => esc_html($khatha_no), // নতুন কলাম
                    'phone' => esc_html($phone_number),
                    'address' => esc_html($client_address),
                    'status' => esc_html($status),
                    'domain_provider' => esc_html($domain_provider),
                    'review' => esc_html($review),
                    'hosting_provider' => esc_html($hosting_provider)
                ];
            }
        }
        wp_reset_postdata();
    }

    wp_send_json([
        'data' => $data,
        'emails' => array_unique($emails),
        'phones' => array_unique($phones)
    ]);
}
<?php
// ===========================
// Load Clients for DataTable
// ===========================
add_action('wp_ajax_faroque_load_clients', 'faroque_load_clients');
add_action('wp_ajax_nopriv_faroque_load_clients', 'faroque_load_clients');

function faroque_load_clients(){

    $filters = isset($_POST['filters']) ? $_POST['filters'] : [];

    // Prepare meta_query for filtering services
    $meta_query = [];
    foreach($filters as $key => $values){
        $meta_query[] = [
            'key' => $key,
            'value' => $values,
            'compare' => 'IN'
        ];
    }

    $services = get_posts([
        'post_type' => 'services',
        'posts_per_page' => -1,
        'post_status' => 'publish',
        'meta_query' => $meta_query
    ]);

    // Map client_id => services
    $client_services = [];
    foreach($services as $srv){
        $client_id = get_field('client_id', $srv->ID);
        if(!$client_id) continue;
        if(is_array($client_id)) $client_id = $client_id[0];
        $client_id = is_object($client_id) ? $client_id->ID : $client_id;
        $client_services[$client_id][] = $srv;
    }

    // Fetch all clients
    $clients = get_posts([
        'post_type' => 'clients',
        'posts_per_page' => -1,
        'post_status' => 'publish',
        'orderby' => 'title',
        'order' => 'ASC'
    ]);

    $data = [];
    $sl = 1;

    foreach($clients as $client){
        $client_id = $client->ID;
        $client_name = esc_html(get_the_title($client_id));
        $phone = esc_html(get_field('phone_number', $client_id));
        $email = esc_html(get_field('client_email', $client_id));
        $address = esc_html(get_field('client_address', $client_id));

        $details_page = site_url('/client-details/');
        $client_name_link = '<a href="'.$details_page.'?client_id='.$client_id.'">'.$client_name.'</a>';



        $services = isset($client_services[$client_id]) ? $client_services[$client_id] : [];

        $domains = [];
        $khatha_nos = [];
        $domain_providers = [];
        $hosting_providers = [];
        $statuses = [];
        $reviews = [];

        foreach($services as $srv){
            $domains[] = '<a href="https://'.esc_html($srv->post_title).'" target="_blank">'.esc_html($srv->post_title).'</a>';
            $khatha_nos[] = esc_html(get_field('khatha_no', $srv->ID));
            $domain_providers[] = esc_html(get_field('domain_provider', $srv->ID));
            $hosting_providers[] = esc_html(get_field('hosting_provider', $srv->ID));
            $statuses[] = esc_html(get_field('status', $srv->ID));
            $reviews[] = esc_html(get_field('review', $srv->ID));
        }

        $data[] = [
            'sl' => $sl++,
            'name' => $client_name_link,
            'phone' => $phone ?: '-',
            'email' => $email ?: '-',
            'khatha_no' => !empty($khatha_nos) ? implode('<br>', $khatha_nos) : '-',
            'domains' => !empty($domains) ? implode('<br>', $domains) : '<span class="text-muted">No Domains</span>',
            'domain_provider' => !empty($domain_providers) ? implode('<br>', $domain_providers) : '-',
            'hosting_provider' => !empty($hosting_providers) ? implode('<br>', $hosting_providers) : '-',
            'address' => $address ?: '-',
            'status' => !empty($statuses) ? implode('<br>', $statuses) : '-',
            'review' => !empty($reviews) ? implode('<br>', $reviews) : '-'
        ];
    }

    wp_send_json(['data'=>$data]);
}
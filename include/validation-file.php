<?php

/**
 * Clients Post Type: Unique Title + Unique ACF Fields (phone, khata_no)
 */

// =====================
// 1️⃣ UNIQUE TITLE
// =====================
add_action('save_post', function ($post_id, $post, $update) {

    if ($post->post_type != 'clients') return;
    if (wp_is_post_autosave($post_id) || wp_is_post_revision($post_id)) return;

    $original_title = $post->post_title;
    $title = $original_title;
    $suffix = 1;

    while (true) {
        $existing = get_page_by_title($title, OBJECT, $post->post_type);
        if (!$existing || $existing->ID == $post_id) break;

        $title = $original_title . '-' . $suffix;
        $suffix++;
    }

    if ($title != $post->post_title) {
        remove_action('save_post', __FUNCTION__, 10);
        wp_update_post(array(
            'ID' => $post_id,
            'post_title' => $title
        ));
        add_action('save_post', __FUNCTION__, 10, 3);
    }
}, 10, 3);


// =====================
// 2️⃣ UNIQUE ACF FIELDS VALIDATION
// =====================
function acf_unique_field_validation($valid, $value, $field, $input)
{

    if ($valid !== true) return $valid; // আগের validation fail হলে skip

    if (empty($value)) return $valid; // empty value skip

    global $wpdb;

    // current post ID
    $post_id = isset($_POST['post_ID']) ? intval($_POST['post_ID']) : 0;

    // check duplicates in postmeta
    $exists = $wpdb->get_var($wpdb->prepare(
        "SELECT post_id FROM $wpdb->postmeta
         WHERE meta_key = %s
         AND meta_value = %s
         AND post_id != %d
         LIMIT 1",
        $field['name'],
        $value,
        $post_id
    ));

    if ($exists) {
        $valid = "⚠️ এই \"{$field['label']}\" ইতিমধ্যেই অন্য ক্লায়েন্টে ব্যবহার হয়েছে!";
    }

    return $valid;
}

// Apply to phone and khata_no
add_filter('acf/validate_value/name=phone', 'acf_unique_field_validation', 10, 4);
add_filter('acf/validate_value/name=khata_no', 'acf_unique_field_validation', 10, 4);

<?php
/* Visit Counter For WordPress by Talkofweb.com */

// Get the number of views for a post
function getPostViews($postID)
{
    $count_key = 'post_views_count';
    $count = get_post_meta($postID, $count_key, true);
    if ($count === '') {
        // Initialize if not set
        delete_post_meta($postID, $count_key);
        add_post_meta($postID, $count_key, '0');
        return "0";
    }
    return $count;
}

// Increment the number of views for a post
function setPostViews($postID)
{
    $count_key = 'post_views_count';
    $count = get_post_meta($postID, $count_key, true);
    if ($count === '') {
        $count = 0;
        delete_post_meta($postID, $count_key);
        add_post_meta($postID, $count_key, '1'); // set initial count to 1 because it's viewed now
    } else {
        $count++;
        update_post_meta($postID, $count_key, $count);
    }
}

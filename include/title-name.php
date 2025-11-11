<?php
function title_name_client($title)
{
    $screen = get_current_screen();

    //for clients post type
    if ('clients' == $screen->post_type) {
        $title = "Client's Name";
    }
    //for service
    if ('services' == $screen->post_type) {
        $title = "Domain's or Project's Name";
    }
    return $title;
}
add_filter('enter_title_here', 'title_name_client');

<?php
function theme_customize_register($wp_customize)
{
    // 🔹 Customizer Section
    $wp_customize->add_section('latest_news_section', array(
        'title'    => __('পেইজ সেটিংস', 'portfolio'),
        'priority' => 30,
    ));

    // 🔸 থিম পেইজ সিলেক্টর (ড্রপডাউন)
    $wp_customize->add_setting('select_themes_page', array(
        'default'   => 'থিম হবে',
        'transport' => 'refresh',
    ));

    $wp_customize->add_control('select_themes_page', array(
        'label'    => __('থিম পেইজ সিলেক্ট করুন', 'portfolio'),
        'section'  => 'latest_news_section',
        'settings' => 'select_themes_page',
        'type'     => 'dropdown-pages', // ✅ All pages listed here
    ));

    // 🔸 ব্লগ পেইজ সিলেক্টর (ড্রপডাউন)
    $wp_customize->add_setting('blog_themes_page', array(
        'default'   => 'Blog হবে',
        'transport' => 'refresh',
    ));

    $wp_customize->add_control('blog_themes_page', array(
        'label'    => __('ব্লগ পেইজ সিলেক্ট করুন', 'portfolio'),
        'section'  => 'latest_news_section',
        'settings' => 'blog_themes_page',
        'type'     => 'dropdown-pages', // ✅ All pages listed here
    ));
}
add_action('customize_register', 'theme_customize_register');

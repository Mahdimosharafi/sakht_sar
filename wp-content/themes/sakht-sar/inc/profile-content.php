<?php
/** Sakht Sar — Profile video content type. */
if (!defined('ABSPATH')) exit;

function sakhtsar_register_profile_video_cpt() {
    register_post_type('video', array(
        'labels' => array(
            'name' => 'ویدیوها',
            'singular_name' => 'ویدیو',
            'add_new' => 'افزودن ویدیو',
            'add_new_item' => 'افزودن ویدیو جدید',
            'edit_item' => 'ویرایش ویدیو',
            'new_item' => 'ویدیو جدید',
            'view_item' => 'مشاهده ویدیو',
            'search_items' => 'جستجوی ویدیوها',
            'not_found' => 'ویدیویی پیدا نشد',
            'menu_name' => 'ویدیوها',
        ),
        'public' => true,
        'show_in_rest' => true,
        'has_archive' => true,
        'rewrite' => array('slug' => 'videos'),
        'menu_icon' => 'dashicons-video-alt3',
        'supports' => array('title', 'editor', 'thumbnail', 'excerpt', 'revisions', 'author'),
    ));

    register_taxonomy('video_category', 'video', array(
        'labels' => array(
            'name' => 'دسته‌بندی ویدیو',
            'singular_name' => 'دسته ویدیو',
        ),
        'public' => true,
        'show_in_rest' => true,
        'hierarchical' => true,
        'rewrite' => array('slug' => 'video-category'),
    ));
}
add_action('init', 'sakhtsar_register_profile_video_cpt');

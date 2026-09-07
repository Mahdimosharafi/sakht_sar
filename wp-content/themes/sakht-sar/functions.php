<?php
/**
 * Sakht Sar theme bootstrap.
 */
if (!defined('ABSPATH')) exit;

define('SAKHTSAR_VERSION', '1.0.0');

defunction_exists('sakhtsar_setup') && sakhtsar_setup();
function sakhtsar_setup() {
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('html5', ['search-form','comment-form','comment-list','gallery','caption','style','script']);
    add_theme_support('custom-logo', ['height'=>80,'width'=>180,'flex-height'=>true,'flex-width'=>true]);
    register_nav_menus(['primary'=>'منوی اصلی']);
}
add_action('after_setup_theme','sakhtsar_setup');

function sakhtsar_assets() {
    wp_enqueue_style('sakhtsar-style', get_stylesheet_uri(), [], SAKHTSAR_VERSION);
    wp_enqueue_script('sakhtsar-main', get_template_directory_uri().'/assets/js/main.js', [], SAKHTSAR_VERSION, true);
}
add_action('wp_enqueue_scripts','sakhtsar_assets');

function sakhtsar_customize($wp_customize) {
    $wp_customize->add_section('sakhtsar_home', ['title'=>'سخت‌سر | صفحه اصلی','priority'=>30]);
    $fields = [
        'hero_title'=>['عنوان Hero','رامسر','text'],
        'hero_subtitle'=>['توضیح Hero','بهشت همیشه سبز','text'],
        'hero_image'=>['تصویر Hero','','url'],
        'weather_temp'=>['دمای فعلی','18°','text'],
        'weather_state'=>['وضعیت هوا','نیمه ابری','text'],
        'footer_description'=>['توضیح Footer','سخت‌سر، راهنمای جامع گردشگری، فرهنگ و زندگی رامسر','textarea'],
    ];
    foreach($fields as $id=>$f){
        $wp_customize->add_setting('sakhtsar_'.$id,['default'=>$f[1],'sanitize_callback'=>$f[2]==='url'?'esc_url_raw':'sanitize_text_field']);
        $wp_customize->add_control('sakhtsar_'.$id,['section'=>'sakhtsar_home','label'=>$f[0],'type'=>$f[2]==='textarea'?'textarea':'text']);
    }
}
add_action('customize_register','sakhtsar_customize');

function sakhtsar_get($key,$fallback=''){ return get_theme_mod('sakhtsar_'.$key,$fallback); }
function sakhtsar_img($url){ return esc_url($url); }

<?php
/**
 * Sakht Sar theme bootstrap and global Customizer settings.
 */
if (!defined('ABSPATH')) exit;

define('SAKHTSAR_VERSION', '2.0.0');

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
    $rtl = get_template_directory_uri().'/assets/css/rtl-overrides.css';
    wp_enqueue_style('sakhtsar-rtl-overrides', $rtl, ['sakhtsar-style'], SAKHTSAR_VERSION);
    wp_enqueue_script('sakhtsar-main', get_template_directory_uri().'/assets/js/main.js', [], SAKHTSAR_VERSION, true);
}
add_action('wp_enqueue_scripts','sakhtsar_assets');

function sakhtsar_customize($wp_customize) {
    $wp_customize->add_section('sakhtsar_site', [
        'title'=>'سخت‌سر | تنظیمات سایت',
        'description'=>'تنظیمات سراسری هدر، صفحه اصلی و فوتر',
        'priority'=>25,
    ]);

    $fields = [
        'hero_title'=>['عنوان اصلی','رامسر','text','sanitize_text_field'],
        'hero_subtitle'=>['زیرعنوان','بهشت همیشه سبز','text','sanitize_text_field'],
        'hero_kicker'=>['متن بالای عنوان','سخت سر، راهنمای جامع شما برای کشف طبیعت، فرهنگ و تاریخ','text','sanitize_text_field'],
        'hero_description'=>['توضیح Hero','سخت سر، راهنمای جامع شما برای کشف طبیعت، فرهنگ، تاریخ و زیبایی‌های بی‌نظیر رامسر','textarea','sanitize_textarea_field'],
        'weather_temp'=>['دمای فعلی','18°','text','sanitize_text_field'],
        'weather_state'=>['وضعیت هوا','نیمه ابری','text','sanitize_text_field'],
        'footer_description'=>['توضیح Footer','سخت‌سر، راهنمای جامع گردشگری، فرهنگ و زندگی رامسر','textarea','sanitize_textarea_field'],
        'footer_phone'=>['شماره تماس','011-552xxxxx','text','sanitize_text_field'],
        'footer_email'=>['ایمیل','info@sakhtsar.ir','text','sanitize_email'],
        'footer_address'=>['آدرس','رامسر، میدان شهرداری','text','sanitize_text_field'],
    ];
    foreach ($fields as $id=>$f) {
        $wp_customize->add_setting('sakhtsar_'.$id,['default'=>$f[1],'sanitize_callback'=>$f[3]]);
        $wp_customize->add_control('sakhtsar_'.$id,['section'=>'sakhtsar_site','label'=>$f[0],'type'=>$f[2]]);
    }

    $wp_customize->add_setting('sakhtsar_hero_image',['default'=>'','sanitize_callback'=>'esc_url_raw']);
    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize,'sakhtsar_hero_image',[
        'section'=>'sakhtsar_site','label'=>'تصویر اصلی Hero','description'=>'تصویر Hero را از کتابخانه رسانه انتخاب کنید.'
    ]));

    $wp_customize->add_setting('sakhtsar_footer_logo',['default'=>'','sanitize_callback'=>'esc_url_raw']);
    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize,'sakhtsar_footer_logo',[
        'section'=>'sakhtsar_site','label'=>'لوگوی Footer','description'=>'لوگوی فوتر را از کتابخانه رسانه انتخاب کنید.'
    ]));
}
add_action('customize_register','sakhtsar_customize');

function sakhtsar_get($key,$fallback='') { return get_theme_mod('sakhtsar_'.$key,$fallback); }
function sakhtsar_img($url) { return esc_url($url); }

function sakhtsar_featured_image($post_id,$fallback='') {
    $url = get_the_post_thumbnail_url($post_id,'large');
    return $url ?: $fallback;
}

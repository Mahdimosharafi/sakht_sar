<?php
/** Sakht Sar installable WordPress theme. */
if (!defined('ABSPATH')) exit;
define('SAKHTSAR_VERSION','1.1.0');
function sakhtsar_setup(){add_theme_support('title-tag');add_theme_support('post-thumbnails');add_theme_support('html5',['search-form','comment-form','comment-list','gallery','caption','style','script']);add_theme_support('custom-logo',['height'=>80,'width'=>180,'flex-height'=>true,'flex-width'=>true]);register_nav_menus(['primary'=>'منوی اصلی']);}
add_action('after_setup_theme','sakhtsar_setup');
function sakhtsar_assets(){wp_enqueue_style('sakhtsar-style',get_stylesheet_uri(),[],SAKHTSAR_VERSION);wp_enqueue_style('sakhtsar-rtl',get_template_directory_uri().'/assets/css/rtl-overrides.css',['sakhtsar-style'],SAKHTSAR_VERSION);wp_enqueue_script('sakhtsar-main',get_template_directory_uri().'/assets/js/main.js',[],SAKHTSAR_VERSION,true);}
add_action('wp_enqueue_scripts','sakhtsar_assets');
function sakhtsar_customize($wp_customize){$wp_customize->add_section('sakhtsar_home',['title'=>'سخت‌سر | صفحه اصلی','description'=>'تنظیمات اصلی Homepage سخت‌سر','priority'=>30]);$fields=['hero_title'=>['عنوان Hero','رامسر'],'hero_subtitle'=>['زیرعنوان Hero','بهشت همیشه سبز'],'weather_temp'=>['دمای فعلی','18°'],'weather_state'=>['وضعیت هوا','نیمه ابری'],'footer_description'=>['توضیح Footer','سخت‌سر، راهنمای جامع گردشگری، فرهنگ و زندگی رامسر']];foreach($fields as $id=>$f){$area=$id==='footer_description';$wp_customize->add_setting('sakhtsar_'.$id,['default'=>$f[1],'sanitize_callback'=>$area?'sanitize_textarea_field':'sanitize_text_field']);$wp_customize->add_control('sakhtsar_'.$id,['section'=>'sakhtsar_home','label'=>$f[0],'type'=>$area?'textarea':'text']);}$wp_customize->add_setting('sakhtsar_hero_image',['default'=>'','sanitize_callback'=>'esc_url_raw']);$wp_customize->add_control(new WP_Customize_Image_Control($wp_customize,'sakhtsar_hero_image',['section'=>'sakhtsar_home','label'=>'تصویر اصلی Hero']));}
add_action('customize_register','sakhtsar_customize');
function sakhtsar_get($key,$fallback=''){return get_theme_mod('sakhtsar_'.$key,$fallback);}
function sakhtsar_img($url){return esc_url($url);}

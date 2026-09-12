<?php
/**
 * Plugin Name: Sakht Sar Core
 * Description: Core content types and shared functionality for Sakht Sar.
 * Version: 1.0.1
 * Author: Mahdi Mosharafi
 * Text Domain: sakht-sar-core
 */
if (!defined('ABSPATH')) exit;

function sakhtsar_register_content_types() {
    $types = [
        'ss_place'   => ['مکان‌ها','مکان','مکان'],
        'ss_trip'    => ['مسیرهای گردشگری','مسیر گردشگری','مسیر گردشگری'],
        'ss_event'   => ['رویدادها','رویداد','رویداد'],
        'ss_magazine'=> ['مجله سخت‌سر','مطلب مجله','مطالب مجله'],
        'ss_gallery' => ['گالری','تصویر گالری','تصاویر گالری'],
        'ss_video'   => ['ویدئوها','ویدئو','ویدئوها'],
    ];
    foreach($types as $type=>$labels){
        register_post_type($type,[
            'labels'=>[
                'name'=>$labels[0],'singular_name'=>$labels[1],'add_new'=>'افزودن','add_new_item'=>'افزودن '.$labels[1],
                'edit_item'=>'ویرایش '.$labels[1],'new_item'=>'مورد جدید','view_item'=>'مشاهده','search_items'=>'جستجو','not_found'=>'موردی یافت نشد'
            ],
            'public'=>true,'show_in_rest'=>true,'menu_icon'=>'dashicons-location-alt','supports'=>['title','editor','thumbnail','excerpt','custom-fields'],'has_archive'=>true,'rewrite'=>['slug'=>sanitize_title($labels[2])]
        ]);
    }
    register_taxonomy('ss_place_category',['ss_place'],['labels'=>['name'=>'دسته‌بندی مکان‌ها','singular_name'=>'دسته‌بندی مکان'],'public'=>true,'show_in_rest'=>true,'hierarchical'=>true,'rewrite'=>['slug'=>'place-category']]);
    register_taxonomy('ss_trip_category',['ss_trip'],['labels'=>['name'=>'دسته‌بندی مسیرها','singular_name'=>'دسته‌بندی مسیر'],'public'=>true,'show_in_rest'=>true,'hierarchical'=>true,'rewrite'=>['slug'=>'trip-category']]);
}
add_action('init','sakhtsar_register_content_types');

function sakhtsar_register_meta() {
    $common=['address','latitude','longitude','phone','website','rating'];
    foreach($common as $key){register_post_meta('ss_place','_ss_'.$key,['type'=>$key==='rating'?'number':'string','single'=>true,'show_in_rest'=>true,'sanitize_callback'=>$key==='rating'?'floatval':'sanitize_text_field']);}
    register_post_meta('ss_place','_ss_gallery',['type'=>'array','single'=>true,'show_in_rest'=>true]);
    register_post_meta('ss_place','_ss_opening_hours',['type'=>'string','single'=>true,'show_in_rest'=>true]);
    foreach(['distance','duration','locations'] as $key) register_post_meta('ss_trip','_ss_'.$key,['type'=>'string','single'=>true,'show_in_rest'=>true,'sanitize_callback'=>'sanitize_text_field']);
    register_post_meta('ss_event','_ss_event_date',['type'=>'string','single'=>true,'show_in_rest'=>true,'sanitize_callback'=>'sanitize_text_field']);
    register_post_meta('ss_event','_ss_event_location',['type'=>'string','single'=>true,'show_in_rest'=>true,'sanitize_callback'=>'sanitize_text_field']);
    register_post_meta('ss_video','_ss_video_url',['type'=>'string','single'=>true,'show_in_rest'=>true,'sanitize_callback'=>'esc_url_raw']);
}
add_action('init','sakhtsar_register_meta');

function sakhtsar_register_footer_widgets() {
    $sidebars = [
        'footer_contact' => ['تماس با ما', 'اطلاعات تماس فوتر سخت‌سر'],
        'footer_about'   => ['درباره سخت‌سر', 'محتوای ستون درباره سخت‌سر'],
        'footer_quick'   => ['دسترسی سریع', 'لینک‌ها و دسترسی‌های سریع فوتر'],
        'footer_brand'   => ['برند و شبکه‌های اجتماعی', 'لوگو، معرفی و شبکه‌های اجتماعی فوتر'],
    ];

    foreach ($sidebars as $id => $data) {
        register_sidebar([
            'name'          => $data[0],
            'id'            => $id,
            'description'   => $data[1],
            'before_widget' => '<div id="%1$s" class="footer-widget %2$s">',
            'after_widget'  => '</div>',
            'before_title'  => '<h3 class="footer-widget-title">',
            'after_title'   => '</h3>',
        ]);
    }
}
add_action('widgets_init', 'sakhtsar_register_footer_widgets');

function sakhtsar_flush_rewrite(){sakhtsar_register_content_types();flush_rewrite_rules();}
register_activation_hook(__FILE__,'sakhtsar_flush_rewrite');
register_deactivation_hook(__FILE__,'flush_rewrite_rules');

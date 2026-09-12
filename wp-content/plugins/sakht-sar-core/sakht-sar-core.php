<?php
/**
 * Plugin Name: Sakht Sar Core
 * Description: Core content types and shared functionality for Sakht Sar.
 * Version: 1.0.2
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

/**
 * Editable social media item for the footer.
 * Each added widget instance represents one social network icon + link.
 */
class SakhtSar_Social_Widget extends WP_Widget {
    public function __construct() {
        parent::__construct(
            'sakhtsar_social_item',
            'سخت‌سر — شبکه اجتماعی',
            ['description' => 'یک آیکون شبکه اجتماعی با لینک قابل ویرایش برای فوتر.']
        );
    }

    public function form($instance) {
        $title = isset($instance['title']) ? $instance['title'] : '';
        $icon  = isset($instance['icon']) ? $instance['icon'] : 'instagram';
        $url   = isset($instance['url']) ? $instance['url'] : '';
        ?>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('title')); ?>">عنوان (اختیاری)</label>
            <input class="widefat" type="text" name="<?php echo esc_attr($this->get_field_name('title')); ?>" id="<?php echo esc_attr($this->get_field_id('title')); ?>" value="<?php echo esc_attr($title); ?>">
        </p>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('icon')); ?>">آیکون شبکه اجتماعی</label>
            <select class="widefat" name="<?php echo esc_attr($this->get_field_name('icon')); ?>" id="<?php echo esc_attr($this->get_field_id('icon')); ?>">
                <option value="instagram" <?php selected($icon, 'instagram'); ?>>Instagram</option>
                <option value="telegram" <?php selected($icon, 'telegram'); ?>>Telegram</option>
                <option value="whatsapp" <?php selected($icon, 'whatsapp'); ?>>WhatsApp</option>
                <option value="youtube" <?php selected($icon, 'youtube'); ?>>YouTube</option>
                <option value="facebook" <?php selected($icon, 'facebook'); ?>>Facebook</option>
                <option value="x" <?php selected($icon, 'x'); ?>>X / Twitter</option>
                <option value="linkedin" <?php selected($icon, 'linkedin'); ?>>LinkedIn</option>
                <option value="link" <?php selected($icon, 'link'); ?>>لینک عمومی</option>
            </select>
        </p>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('url')); ?>">لینک</label>
            <input class="widefat" type="url" dir="ltr" placeholder="https://..." name="<?php echo esc_attr($this->get_field_name('url')); ?>" id="<?php echo esc_attr($this->get_field_id('url')); ?>" value="<?php echo esc_attr($url); ?>">
        </p>
        <?php
    }

    public function update($new_instance, $old_instance) {
        return [
            'title' => sanitize_text_field($new_instance['title'] ?? ''),
            'icon'  => sanitize_key($new_instance['icon'] ?? 'link'),
            'url'   => esc_url_raw($new_instance['url'] ?? ''),
        ];
    }

    private function icon_svg($icon) {
        $icons = [
            'instagram' => '<svg viewBox="0 0 24 24" aria-hidden="true"><rect x="3" y="3" width="18" height="18" rx="5"></rect><circle cx="12" cy="12" r="4"></circle><circle cx="17.5" cy="6.5" r="1"></circle></svg>',
            'telegram'  => '<svg viewBox="0 0 24 24" aria-hidden="true"><path d="M21 3 3.7 9.7c-.9.4-.9 1.1-.2 1.4l4.5 1.4 1.7 5.2c.2.6.1.9.7.9.5 0 .7-.2 1-.5l2.2-2.1 4.6 3.4c.8.4 1.4.1 1.6-.8L21.9 4c.2-1-.4-1.4-.9-1Z"></path><path d="m8.7 12.2 9.8-6.1-7.6 7.2-.3 2.5-1.4-3.6Z"></path></svg>',
            'whatsapp'  => '<svg viewBox="0 0 24 24" aria-hidden="true"><path d="M20.5 3.5A11 11 0 0 0 3.3 17.2L2 22l4.9-1.3A11 11 0 1 0 20.5 3.5Z"></path><path d="M8.2 7.3c.3-.3.6-.3.9-.1l1.2 1.8c.2.3.2.6 0 .8l-.7.8c.7 1.4 1.8 2.5 3.2 3.2l.8-.7c.2-.2.5-.2.8 0l1.8 1.2c.3.2.3.6.1.9-.5.7-1.2 1.2-2.1 1.1-4.6-.5-7.7-3.6-8.2-8.2-.1-.9.4-1.6 1.1-2.1Z"></path></svg>',
            'youtube'   => '<svg viewBox="0 0 24 24" aria-hidden="true"><path d="M21 7.2a2.8 2.8 0 0 0-2-2C17.2 4.8 12 4.8 12 4.8s-5.2 0-7 .4a2.8 2.8 0 0 0-2 2C2.6 9 2.6 12 2.6 12s0 3 .4 4.8a2.8 2.8 0 0 0 2 2c1.8.4 7 .4 7 .4s5.2 0 7-.4a2.8 2.8 0 0 0 2-2c.4-1.8.4-4.8.4-4.8s0-3-.4-4.8Z"></path><path d="m10.2 15.5 5.1-3.5-5.1-3.5v7Z"></path></svg>',
            'facebook'  => '<svg viewBox="0 0 24 24" aria-hidden="true"><path d="M14 21v-8h2.7l.4-3H14V8.1c0-.9.3-1.6 1.7-1.6h1.8V3.8c-.3 0-1.3-.1-2.5-.1-2.5 0-4.2 1.5-4.2 4.3V10H8v3h2.8v8H14Z"></path></svg>',
            'x'         => '<svg viewBox="0 0 24 24" aria-hidden="true"><path d="M5 4h3.7l3.7 5 4.4-5H19l-5.2 6 5.8 8H16l-4-5.5L7.2 18H5l5.5-6.4L5 4Zm3.1 1.7H7.2l8.9 10.6h.9L8.1 5.7Z"></path></svg>',
            'linkedin'  => '<svg viewBox="0 0 24 24" aria-hidden="true"><path d="M5.2 8.7A1.7 1.7 0 1 0 5.2 5a1.7 1.7 0 0 0 0 3.7ZM3.7 10h3v10h-3V10Zm5 0h2.9v1.4h.1c.4-.8 1.4-1.7 3-1.7 3.2 0 3.8 2.1 3.8 4.9V20h-3v-4.8c0-1.1 0-2.5-1.5-2.5s-1.7 1.2-1.7 2.4V20h-3V10Z"></path></svg>',
            'link'      => '<svg viewBox="0 0 24 24" aria-hidden="true"><path d="M10 13.8a4 4 0 0 0 5.7 0l2-2a4 4 0 0 0-5.7-5.7l-1.1 1.1"></path><path d="M14 10.2a4 4 0 0 0-5.7 0l-2 2A4 4 0 0 0 12 17.9l1.1-1.1"></path></svg>',
        ];
        return $icons[$icon] ?? $icons['link'];
    }

    public function widget($args, $instance) {
        $url   = !empty($instance['url']) ? esc_url($instance['url']) : '';
        $icon  = sanitize_key($instance['icon'] ?? 'link');
        $title = sanitize_text_field($instance['title'] ?? '');
        if (!$url) return;

        echo $args['before_widget'];
        $label = $title ?: ucfirst($icon);
        echo '<a class="sakhtsar-social-item sakhtsar-social-' . esc_attr($icon) . '" href="' . $url . '" target="_blank" rel="noopener noreferrer" aria-label="' . esc_attr($label) . '" title="' . esc_attr($label) . '">';
        echo $this->icon_svg($icon);
        echo '</a>';
        echo $args['after_widget'];
    }
}

function sakhtsar_register_social_widget() {
    register_widget('SakhtSar_Social_Widget');
}
add_action('widgets_init', 'sakhtsar_register_social_widget');

function sakhtsar_flush_rewrite(){sakhtsar_register_content_types();flush_rewrite_rules();}
register_activation_hook(__FILE__,'sakhtsar_flush_rewrite');
register_deactivation_hook(__FILE__,'flush_rewrite_rules');

<?php
/** Sakht Sar — Logged-in user profile page. */
if (!defined('ABSPATH')) exit;
if (!is_user_logged_in()) { wp_safe_redirect(wp_login_url(home_url('/profile/'))); exit; }

$user = wp_get_current_user();
$user_id = (int)$user->ID;

/* Same-page profile editor: no trip to wp-admin. */
$profile_saved = false;
if ('POST' === $_SERVER['REQUEST_METHOD'] && isset($_POST['sakhtsar_profile_save'])) {
    if (!isset($_POST['sakhtsar_profile_nonce']) || !wp_verify_nonce(sanitize_text_field(wp_unslash($_POST['sakhtsar_profile_nonce'])),'sakhtsar_profile_save')) {
        wp_die('درخواست نامعتبر است.');
    }
    if (current_user_can('edit_user',$user_id)) {
        $first = isset($_POST['first_name']) ? sanitize_text_field(wp_unslash($_POST['first_name'])) : '';
        $last = isset($_POST['last_name']) ? sanitize_text_field(wp_unslash($_POST['last_name'])) : '';
        $email = isset($_POST['user_email']) ? sanitize_email(wp_unslash($_POST['user_email'])) : $user->user_email;
        $bio = isset($_POST['description']) ? sanitize_textarea_field(wp_unslash($_POST['description'])) : '';
        $phone = isset($_POST['sakhtsar_phone']) ? sanitize_text_field(wp_unslash($_POST['sakhtsar_phone'])) : '';
        $location = isset($_POST['sakhtsar_location']) ? sanitize_text_field(wp_unslash($_POST['sakhtsar_location'])) : '';
        $birthdate = isset($_POST['sakhtsar_birthdate']) ? sanitize_text_field(wp_unslash($_POST['sakhtsar_birthdate'])) : '';
        $data = array('ID'=>$user_id,'first_name'=>$first,'last_name'=>$last,'display_name'=>trim($first.' '.$last) ?: $user->user_login,'user_email'=>$email,'description'=>$bio);
        $result = wp_update_user($data);
        if (!is_wp_error($result)) {
            update_user_meta($user_id,'sakhtsar_phone',$phone); update_user_meta($user_id,'sakhtsar_location',$location); update_user_meta($user_id,'sakhtsar_birthdate',$birthdate);
            $profile_saved = true; $user = wp_get_current_user();
        }
    }
}

get_header();
$display_name = $user->display_name ?: $user->user_login;
$description = get_user_meta($user_id,'description',true);
$phone = get_user_meta($user_id,'sakhtsar_phone',true);
$location = get_user_meta($user_id,'sakhtsar_location',true);
$birthdate = get_user_meta($user_id,'sakhtsar_birthdate',true);
$registered = !empty($user->user_registered) ? wp_date('Y/m/d',strtotime($user->user_registered)) : '—';
$avatar = get_avatar_url($user_id,array('size'=>220));
$cover = sakhtsar_get('profile_cover_image','https://images.unsplash.com/photo-1500534623283-312aade485b7?auto=format&fit=crop&w=1800&q=84');
$cover_position = sakhtsar_get('profile_cover_position','center center');

$place_count = (int)count_user_posts($user_id,'place');
$trip_count = (int)count_user_posts($user_id,'trip');
$magazine_count = (int)count_user_posts($user_id,'magazine');
$event_count = (int)count_user_posts($user_id,'event');
$recent_places = get_posts(array('post_type'=>'place','author'=>$user_id,'posts_per_page'=>4,'post_status'=>'publish'));
$recent_trips = get_posts(array('post_type'=>'trip','author'=>$user_id,'posts_per_page'=>3,'post_status'=>'publish'));
$recent_comments = get_comments(array('user_id'=>$user_id,'status'=>'approve','number'=>3,'orderby'=>'comment_date_gmt','order'=>'DESC'));
$favorite_ids = array_filter(array_map('absint',preg_split('/\s*,\s*/',get_user_meta($user_id,'sakhtsar_favorite_places',true),-1,PREG_SPLIT_NO_EMPTY)));
$favorites = $favorite_ids ? get_posts(array('post_type'=>'place','post__in'=>$favorite_ids,'orderby'=>'post__in','posts_per_page'=>4,'post_status'=>'publish')) : $recent_places;

function sakhtsar_profile_icon($name){
$paths=array(
'user'=>'<circle cx="12" cy="8" r="3.5"/><path d="M5 20c.7-3.3 3-5 7-5s6.3 1.7 7 5"/>','video'=>'<rect x="4" y="5" width="16" height="14" rx="2"/><path d="m10 9 5 3-5 3z"/>','article'=>'<path d="M6 3h8l4 4v14H6z"/><path d="M14 3v5h5M9 12h6M9 16h6"/>','place'=>'<path d="M12 21s6-5.1 6-11a6 6 0 0 0-12 0c0 5.9 6 11 6 11z"/><circle cx="12" cy="10" r="2"/>','trip'=>'<circle cx="6" cy="7" r="2"/><circle cx="18" cy="17" r="2"/><circle cx="17" cy="6" r="2"/><path d="m8 8 7 8M8 7h7"/>','calendar'=>'<rect x="4" y="5" width="16" height="15" rx="2"/><path d="M8 3v4M16 3v4M4 10h16"/>','heart'=>'<path d="M20 8.7C20 14 12 20 12 20S4 14 4 8.7A4.7 4.7 0 0 1 12 6a4.7 4.7 0 0 1 8 2.7z"/>','clock'=>'<circle cx="12" cy="12" r="8"/><path d="M12 7v5l3 2"/>','comment'=>'<path d="M20 11.5a7.5 7.5 0 0 1-8 7.5 8 8 0 0 1-4-.9L4 20l1.2-3A7.5 7.5 0 1 1 20 11.5z"/><path d="M8 11h8M8 14h5"/>','settings'=>'<circle cx="12" cy="12" r="3"/><path d="M19 13.5v-3l-2-.7-.8-1.8.9-1.9-2.1-2.1-1.9.9-1.8-.8-.7-2h-3l-.7 2-1.8.8-1.9-.9L2.9 6.1l.9 1.9-.8 1.8-2 .7v3l2 .7.8 1.8-.9 1.9 2.1 2.1 1.9-.9 1.8.8.7 2h3l.7-2 1.8-.8 1.9.9 2.1-2.1-.9-1.9.8-1.8z"/>','logout'=>'<path d="M10 5H5v14h5M14 8l4 4-4 4M9 12h9"/>');
$p=isset($paths[$name])?$paths[$name]:$paths['user']; return '<svg viewBox="0 0 24 24" aria-hidden="true">'.$p.'</svg>';
}
?>
<main class="sakhtsar-profile-page">
<section class="profile-cover"><div class="profile-cover-bg" style="background-image:linear-gradient(90deg,rgba(4,35,20,.48),rgba(4,48,25,.10)),url('<?php echo esc_url($cover); ?>');background-position:<?php echo esc_attr($cover_position); ?>"></div><div class="container profile-cover-inner"><div><span class="profile-breadcrumb"><?php echo esc_html(sakhtsar_get('profile_breadcrumb','خانه  ‹  پروفایل کاربری')); ?></span><h1><?php echo esc_html(sakhtsar_get('profile_title','پروفایل کاربری')); ?></h1></div></div></section>
<div class="container profile-container">
<?php if($profile_saved): ?><div class="profile-save-notice">اطلاعات پروفایل با موفقیت ذخیره شد.</div><?php endif; ?>
<section class="profile-main-card">
<div class="profile-identity"><img class="profile-avatar" src="<?php echo esc_url($avatar); ?>" alt="<?php echo esc_attr($display_name); ?>"><div class="profile-identity-text"><h2><?php echo esc_html($display_name); ?> <span class="profile-verified">✓</span></h2><p><?php echo esc_html($description ?: 'عاشق سفر و طبیعت‌گردی'); ?></p><div class="profile-meta-row"><span><?php echo sakhtsar_profile_icon('place'); ?> <?php echo esc_html($location ?: 'رامسر، مازندران'); ?></span><span><?php echo sakhtsar_profile_icon('calendar'); ?> عضو از <?php echo esc_html($registered); ?></span></div></div></div>
<div class="profile-actions"><button class="profile-edit-btn" type="button" data-profile-edit><?php echo sakhtsar_profile_icon('user'); ?> ویرایش پروفایل <span>✎</span></button><button class="profile-more" type="button" aria-label="گزینه‌های بیشتر">•••</button></div>
<div class="profile-stats"><div><?php echo sakhtsar_profile_icon('trip'); ?><strong><?php echo esc_html($trip_count); ?></strong><span><?php echo esc_html(sakhtsar_get('profile_stat_trips','مسیرهای سفر')); ?></span></div><div><?php echo sakhtsar_profile_icon('place'); ?><strong><?php echo esc_html($place_count); ?></strong><span><?php echo esc_html(sakhtsar_get('profile_stat_places','جاهای دیدنی')); ?></span></div><div><?php echo sakhtsar_profile_icon('article'); ?><strong><?php echo esc_html($magazine_count); ?></strong><span><?php echo esc_html(sakhtsar_get('profile_stat_articles','مقالات')); ?></span></div><div><?php echo sakhtsar_profile_icon('video'); ?><strong><?php echo esc_html($event_count); ?></strong><span><?php echo esc_html(sakhtsar_get('profile_stat_events','رویدادها')); ?></span></div></div>
</section>

<section class="profile-edit-panel profile-panel" data-profile-editor hidden><form method="post"><div class="profile-panel-head"><h3>ویرایش سریع پروفایل</h3><button type="button" class="profile-close" data-profile-close>×</button></div><?php wp_nonce_field('sakhtsar_profile_save','sakhtsar_profile_nonce'); ?><div class="profile-edit-grid"><label>نام<input name="first_name" value="<?php echo esc_attr($user->first_name); ?>"></label><label>نام خانوادگی<input name="last_name" value="<?php echo esc_attr($user->last_name); ?>"></label><label>ایمیل<input type="email" name="user_email" value="<?php echo esc_attr($user->user_email); ?>"></label><label>شماره موبایل<input name="sakhtsar_phone" value="<?php echo esc_attr($phone); ?>"></label><label>محل زندگی<input name="sakhtsar_location" value="<?php echo esc_attr($location); ?>"></label><label>تاریخ تولد<input name="sakhtsar_birthdate" value="<?php echo esc_attr($birthdate); ?>" placeholder="مثلاً 1388/01/20"></label><label class="profile-edit-full">معرفی من<textarea name="description" rows="4"><?php echo esc_textarea($description); ?></textarea></label></div><div class="profile-edit-actions"><button class="profile-save-btn" name="sakhtsar_profile_save" value="1">ذخیره تغییرات</button><button type="button" class="profile-cancel-btn" data-profile-close>انصراف</button></div></form></section>

<div class="profile-layout"><aside class="profile-sidebar profile-panel"><a class="profile-side-link active" href="#profile-info"><?php echo sakhtsar_profile_icon('user'); ?> پروفایل من</a><a class="profile-side-link" href="#favorites"><?php echo sakhtsar_profile_icon('heart'); ?> علاقه‌مندی‌های من</a><a class="profile-side-link" href="#trips"><?php echo sakhtsar_profile_icon('trip'); ?> مسیرهای من</a><a class="profile-side-link" href="#history"><?php echo sakhtsar_profile_icon('clock'); ?> تاریخچه بازدید</a><a class="profile-side-link" href="#comments"><?php echo sakhtsar_profile_icon('comment'); ?> نظرات من</a><button class="profile-side-link profile-side-edit" type="button" data-profile-edit><?php echo sakhtsar_profile_icon('settings'); ?> تنظیمات حساب</button><a class="profile-side-link" href="<?php echo esc_url(wp_logout_url(home_url('/'))); ?>"><?php echo sakhtsar_profile_icon('logout'); ?> خروج از حساب</a></aside>
<div class="profile-content">
<div class="profile-two-col"><section class="profile-panel about-panel" id="profile-info"><div class="profile-panel-head"><h3><?php echo esc_html(sakhtsar_get('profile_about_title','درباره من')); ?></h3><?php echo sakhtsar_profile_icon('user'); ?></div><p><?php echo esc_html($description ?: sakhtsar_get('profile_default_bio','سلام! من عاشق سفر، طبیعت و کشف مکان‌های جدید هستم. همیشه سعی می‌کنم بهترین تجربه‌هایم را با دیگران به اشتراک بگذارم.')); ?></p><button type="button" class="profile-text-link" data-profile-edit>ویرایش معرفی <b>←</b></button></section>
<section class="profile-panel personal-panel"><div class="profile-panel-head"><h3><?php echo esc_html(sakhtsar_get('profile_personal_title','اطلاعات شخصی')); ?></h3><?php echo sakhtsar_profile_icon('user'); ?></div><div class="personal-list"><div><span>نام و نام خانوادگی</span><strong><?php echo esc_html($display_name); ?></strong></div><div><span>ایمیل</span><strong><?php echo esc_html($user->user_email); ?></strong></div><div><span>شماره موبایل</span><strong><?php echo esc_html($phone ?: '—'); ?></strong></div><div><span>محل زندگی</span><strong><?php echo esc_html($location ?: '—'); ?></strong></div><div><span>تاریخ تولد</span><strong><?php echo esc_html($birthdate ?: '—'); ?></strong></div></div></section></div>
<section class="profile-panel collection-panel" id="favorites"><div class="profile-panel-head"><h3><?php echo esc_html(sakhtsar_get('profile_favorites_title','علاقه‌مندی‌های من')); ?></h3><a href="<?php echo esc_url(home_url('/places/')); ?>">مشاهده همه</a></div><div class="profile-place-grid"><?php if($favorites): foreach($favorites as $place): $img=get_the_post_thumbnail_url($place->ID,'medium'); ?><a class="profile-place-card" href="<?php echo esc_url(get_permalink($place)); ?>"><div class="profile-place-img" style="background-image:url('<?php echo esc_url($img ?: get_template_directory_uri().'/assets/images/placeholder.svg'); ?>')"><span class="favorite-heart"><?php echo sakhtsar_profile_icon('heart'); ?></span></div><div><strong><?php echo esc_html(get_the_title($place)); ?></strong><small><?php $terms=get_the_terms($place->ID,'place_type'); echo esc_html(($terms&&!is_wp_error($terms))?$terms[0]->name:'جاذبه طبیعی'); ?></small></div></a><?php endforeach; else: ?><div class="profile-empty">هنوز علاقه‌مندی‌ای ثبت نشده است.</div><?php endif; ?></div><div class="profile-carousel-arrows"><button type="button">‹</button><button type="button">›</button></div></section>
<div class="profile-bottom-grid"><section class="profile-panel" id="history"><div class="profile-panel-head"><h3><?php echo esc_html(sakhtsar_get('profile_history_title','تاریخچه بازدیدها')); ?></h3><a href="<?php echo esc_url(home_url('/places/')); ?>">مشاهده همه</a></div><div class="profile-list"><?php if($recent_places): foreach(array_slice($recent_places,0,3) as $place): ?><a href="<?php echo esc_url(get_permalink($place)); ?>"><span class="mini-thumb" style="background-image:url('<?php echo esc_url(get_the_post_thumbnail_url($place->ID,'thumbnail')); ?>')"></span><span><strong><?php echo esc_html(get_the_title($place)); ?></strong><small><?php $terms=get_the_terms($place->ID,'place_type'); echo esc_html(($terms&&!is_wp_error($terms))?$terms[0]->name:'جاذبه طبیعی'); ?></small></span><time>اخیر</time></a><?php endforeach; else: ?><div class="profile-empty">تاریخچه‌ای برای نمایش وجود ندارد.</div><?php endif; ?></div></section>
<section class="profile-panel" id="comments"><div class="profile-panel-head"><h3><?php echo esc_html(sakhtsar_get('profile_comments_title','آخرین نظرات من')); ?></h3><?php echo sakhtsar_profile_icon('comment'); ?></div><div class="profile-comments"><?php if($recent_comments): foreach($recent_comments as $comment): ?><article><p><?php echo esc_html(wp_trim_words($comment->comment_content,18)); ?></p><div><span>★★★★★</span><small><?php echo esc_html(human_time_diff(strtotime($comment->comment_date),current_time('timestamp')).' پیش'); ?></small></div></article><?php endforeach; else: ?><div class="profile-empty">هنوز نظری ثبت نکرده‌اید.</div><?php endif; ?></div></section>
<section class="profile-panel achievements-panel"><div class="profile-panel-head"><h3><?php echo esc_html(sakhtsar_get('profile_badges_title','نشان‌ها و دستاوردها')); ?></h3><span class="profile-head-icon">♕</span></div><div class="achievement-grid"><div><b>♨</b><strong><?php echo esc_html(sakhtsar_get('badge_one','سفرهای زیاد')); ?></strong><small><?php echo esc_html(sakhtsar_get('badge_one_desc','۱۰ سفر')); ?></small></div><div><b>♧</b><strong><?php echo esc_html(sakhtsar_get('badge_two','کشف‌گر طبیعت')); ?></strong><small><?php echo esc_html(sakhtsar_get('badge_two_desc','۲۰ جاذبه')); ?></small></div><div><b>✦</b><strong><?php echo esc_html(sakhtsar_get('badge_three','عضو ویژه')); ?></strong><small><?php echo esc_html(sakhtsar_get('badge_three_desc','۱ سال')); ?></small></div><div><b>✎</b><strong><?php echo esc_html(sakhtsar_get('badge_four','نویسنده برتر')); ?></strong><small><?php echo esc_html(sakhtsar_get('badge_four_desc','۵ مقاله')); ?></small></div></div></section></div>
<section class="profile-panel profile-trips" id="trips"><div class="profile-panel-head"><h3><?php echo esc_html(sakhtsar_get('profile_trips_title','مسیرهای من')); ?></h3><a href="<?php echo esc_url(home_url('/trips/')); ?>">مشاهده همه</a></div><?php if($recent_trips): ?><div class="profile-trip-list"><?php foreach($recent_trips as $trip): ?><a href="<?php echo esc_url(get_permalink($trip)); ?>"><?php echo sakhtsar_profile_icon('trip'); ?><strong><?php echo esc_html(get_the_title($trip)); ?></strong><span><?php echo esc_html(get_post_meta($trip->ID,'sakhtsar_distance',true) ?: 'مسیر گردشگری'); ?></span><b>←</b></a><?php endforeach; ?></div><?php else: ?><div class="profile-empty">هنوز مسیری توسط این کاربر ثبت نشده است.</div><?php endif; ?></section>
</div></div></div></div></main>
<?php get_footer(); ?>
<?php
/**
 * Sakht Sar — Logged-in user profile page.
 */
if (!defined('ABSPATH')) exit;

if (!is_user_logged_in()) {
    wp_safe_redirect(wp_login_url(home_url('/profile/')));
    exit;
}

get_header();
$user = wp_get_current_user();
$user_id = (int) $user->ID;
$display_name = $user->display_name ?: $user->user_login;
$description = get_user_meta($user_id, 'description', true);
$registered = !empty($user->user_registered) ? wp_date('Y/m/d', strtotime($user->user_registered)) : '—';
$avatar = get_avatar_url($user_id, array('size' => 220));

$place_count = (int) count_user_posts($user_id, 'place');
$trip_count = (int) count_user_posts($user_id, 'trip');
$magazine_count = (int) count_user_posts($user_id, 'magazine');
$event_count = (int) count_user_posts($user_id, 'event');
$comment_count = (int) get_comments(array('user_id' => $user_id, 'count' => true, 'status' => 'approve'));

$recent_places = get_posts(array('post_type'=>'place','author'=>$user_id,'posts_per_page'=>4,'post_status'=>'publish'));
$recent_trips = get_posts(array('post_type'=>'trip','author'=>$user_id,'posts_per_page'=>3,'post_status'=>'publish'));
$recent_comments = get_comments(array('user_id'=>$user_id,'status'=>'approve','number'=>3,'orderby'=>'comment_date_gmt','order'=>'DESC'));
?>

<main class="sakhtsar-profile-page">
    <section class="profile-cover">
        <div class="profile-cover-bg" aria-hidden="true"></div>
        <div class="container profile-cover-inner">
            <div>
                <span class="profile-breadcrumb">خانه <b>‹</b> پروفایل کاربری</span>
                <h1>پروفایل کاربری</h1>
            </div>
        </div>
    </section>

    <div class="container profile-container">
        <section class="profile-main-card">
            <div class="profile-identity">
                <img class="profile-avatar" src="<?php echo esc_url($avatar); ?>" alt="<?php echo esc_attr($display_name); ?>">
                <div class="profile-identity-text">
                    <h2><?php echo esc_html($display_name); ?></h2>
                    <p><?php echo esc_html($description ?: 'عاشق سفر و طبیعت گردی'); ?></p>
                    <div class="profile-meta-row">
                        <span>⌖ <?php echo esc_html($user->user_login); ?></span>
                        <span>▣ عضو از <?php echo esc_html($registered); ?></span>
                    </div>
                </div>
            </div>
            <div class="profile-actions">
                <a class="profile-edit-btn" href="<?php echo esc_url(admin_url('profile.php')); ?>">ویرایش پروفایل <span>↗</span></a>
                <button class="profile-more" type="button" aria-label="گزینه‌های بیشتر">•••</button>
            </div>
            <div class="profile-stats">
                <div><strong><?php echo esc_html($trip_count); ?></strong><span>مسیرهای سفر</span></div>
                <div><strong><?php echo esc_html($place_count); ?></strong><span>جاهای دیدنی</span></div>
                <div><strong><?php echo esc_html($magazine_count); ?></strong><span>مقالات</span></div>
                <div><strong><?php echo esc_html($event_count); ?></strong><span>رویدادها</span></div>
            </div>
        </section>

        <div class="profile-layout">
            <aside class="profile-sidebar profile-panel">
                <a class="profile-side-link active" href="#profile-info"><span>♙</span> پروفایل من</a>
                <a class="profile-side-link" href="#favorites"><span>♡</span> علاقه‌مندی‌های من</a>
                <a class="profile-side-link" href="#trips"><span>♧</span> مسیرهای من</a>
                <a class="profile-side-link" href="#history"><span>◷</span> تاریخچه بازدید</a>
                <a class="profile-side-link" href="#comments"><span>◌</span> نظرات من</a>
                <a class="profile-side-link" href="<?php echo esc_url(admin_url('profile.php')); ?>"><span>⚙</span> تنظیمات حساب</a>
                <a class="profile-side-link" href="<?php echo esc_url(wp_logout_url(home_url('/'))); ?>"><span>↪</span> خروج از حساب</a>
            </aside>

            <div class="profile-content">
                <div class="profile-two-col">
                    <section class="profile-panel about-panel" id="profile-info">
                        <div class="profile-panel-head"><h3>درباره من</h3><span>♙</span></div>
                        <p><?php echo esc_html($description ?: 'سلام! من عاشق سفر، طبیعت و کشف مکان‌های جدید هستم. همیشه سعی می‌کنم بهترین تجربه‌هایم را با دیگران به اشتراک بگذارم.'); ?></p>
                        <a href="<?php echo esc_url(admin_url('profile.php')); ?>">ویرایش معرفی <b>←</b></a>
                    </section>

                    <section class="profile-panel personal-panel">
                        <div class="profile-panel-head"><h3>اطلاعات شخصی</h3><span>♙</span></div>
                        <div class="personal-list">
                            <div><span>نام و نام خانوادگی</span><strong><?php echo esc_html($display_name); ?></strong></div>
                            <div><span>ایمیل</span><strong><?php echo esc_html($user->user_email); ?></strong></div>
                            <div><span>نام کاربری</span><strong><?php echo esc_html($user->user_login); ?></strong></div>
                            <div><span>تاریخ عضویت</span><strong><?php echo esc_html($registered); ?></strong></div>
                        </div>
                    </section>
                </div>

                <section class="profile-panel collection-panel" id="favorites">
                    <div class="profile-panel-head"><h3>علاقه‌مندی‌های من</h3><a href="<?php echo esc_url(home_url('/places/')); ?>">مشاهده همه</a></div>
                    <div class="profile-place-grid">
                        <?php if ($recent_places) : foreach ($recent_places as $place) : $img = get_the_post_thumbnail_url($place->ID,'medium'); ?>
                            <a class="profile-place-card" href="<?php echo esc_url(get_permalink($place)); ?>">
                                <div class="profile-place-img" style="background-image:url('<?php echo esc_url($img ?: get_template_directory_uri().'/assets/images/placeholder.svg'); ?>')"></div>
                                <div><strong><?php echo esc_html(get_the_title($place)); ?></strong><small>جاذبه طبیعی</small></div>
                            </a>
                        <?php endforeach; else : ?>
                            <div class="profile-empty">هنوز محتوایی توسط این کاربر ثبت نشده است.</div>
                        <?php endif; ?>
                    </div>
                </section>

                <div class="profile-bottom-grid">
                    <section class="profile-panel" id="history">
                        <div class="profile-panel-head"><h3>تاریخچه بازدیدها</h3><a href="<?php echo esc_url(home_url('/places/')); ?>">مشاهده همه</a></div>
                        <div class="profile-list">
                            <?php if ($recent_places) : foreach (array_slice($recent_places,0,3) as $place) : ?>
                                <a href="<?php echo esc_url(get_permalink($place)); ?>"><span class="mini-thumb" style="background-image:url('<?php echo esc_url(get_the_post_thumbnail_url($place->ID,'thumbnail')); ?>')"></span><span><strong><?php echo esc_html(get_the_title($place)); ?></strong><small>مکان گردشگری</small></span><time>اخیر</time></a>
                            <?php endforeach; else : ?><div class="profile-empty">تاریخچه‌ای برای نمایش وجود ندارد.</div><?php endif; ?>
                        </div>
                    </section>

                    <section class="profile-panel" id="comments">
                        <div class="profile-panel-head"><h3>آخرین نظرات من</h3><span>◌</span></div>
                        <div class="profile-comments">
                            <?php if ($recent_comments) : foreach ($recent_comments as $comment) : ?>
                                <article><p><?php echo esc_html(wp_trim_words($comment->comment_content,18)); ?></p><div><span>★★★★★</span><small><?php echo esc_html(human_time_diff(strtotime($comment->comment_date),current_time('timestamp')).' پیش'); ?></small></div></article>
                            <?php endforeach; else : ?><div class="profile-empty">هنوز نظری ثبت نکرده‌اید.</div><?php endif; ?>
                        </div>
                    </section>

                    <section class="profile-panel achievements-panel">
                        <div class="profile-panel-head"><h3>نشان‌ها و دستاوردها</h3><span>♕</span></div>
                        <div class="achievement-grid">
                            <div><b>♨</b><strong>سفرهای زیاد</strong><small><?php echo esc_html($trip_count); ?> سفر</small></div>
                            <div><b>♧</b><strong>کشف‌گر طبیعت</strong><small><?php echo esc_html($place_count); ?> مکان</small></div>
                            <div><b>✦</b><strong>عضو ویژه</strong><small><?php echo esc_html(wp_date('Y') - (int)wp_date('Y',strtotime($user->user_registered)) + 1); ?> سال</small></div>
                            <div><b>✎</b><strong>نویسنده برتر</strong><small><?php echo esc_html($magazine_count); ?> مقاله</small></div>
                        </div>
                    </section>
                </div>

                <section class="profile-panel profile-trips" id="trips">
                    <div class="profile-panel-head"><h3>مسیرهای من</h3><a href="<?php echo esc_url(home_url('/trips/')); ?>">مشاهده همه</a></div>
                    <?php if ($recent_trips) : ?><div class="profile-trip-list"><?php foreach($recent_trips as $trip) : ?><a href="<?php echo esc_url(get_permalink($trip)); ?>"><strong><?php echo esc_html(get_the_title($trip)); ?></strong><span><?php echo esc_html(get_post_meta($trip->ID,'sakhtsar_distance',true) ?: 'مسیر گردشگری'); ?></span><b>←</b></a><?php endforeach; ?></div><?php else : ?><div class="profile-empty">هنوز مسیری توسط این کاربر ثبت نشده است.</div><?php endif; ?>
                </section>
            </div>
        </div>
    </div>
</main>

<?php get_footer(); ?>

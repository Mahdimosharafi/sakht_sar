<?php
if (!defined('ABSPATH')) { exit; }

$hero = sakhtsar_get('hero_image', 'https://images.unsplash.com/photo-1500534623283-312aade485b7?auto=format&fit=crop&w=2200&q=86');

$place_fallbacks = array(
 array('تله کابین رامسر','طبیعی','4.8','https://images.unsplash.com/photo-1520962922320-2038eebab146?auto=format&fit=crop&w=700&q=80'),
 array('آبشار صفارود','طبیعی','4.7','https://images.unsplash.com/photo-1432405972618-c60b0225b8f9?auto=format&fit=crop&w=700&q=80'),
 array('قلعه مارکوه','تاریخی','4.7','https://images.unsplash.com/photo-1539650116574-75c0c6d73f6e?auto=format&fit=crop&w=700&q=80'),
 array('ساحل رامسر','طبیعی','4.6','https://images.unsplash.com/photo-1507525428034-b723cf961d3e?auto=format&fit=crop&w=700&q=80'),
 array('پارک جنگلی صفارود','طبیعی','4.6','https://images.unsplash.com/photo-1448375240586-882707db888b?auto=format&fit=crop&w=700&q=80')
);
$places = array();
$place_posts = get_posts(array('post_type'=>'ss_place','post_status'=>'publish','posts_per_page'=>5));
foreach ($place_posts as $i => $post) {
 $terms = get_the_terms($post->ID,'ss_place_category');
 $category = ($terms && !is_wp_error($terms)) ? $terms[0]->name : 'دیدنی';
 $rating = get_post_meta($post->ID,'_ss_rating',true);
 $fallback = isset($place_fallbacks[$i][3]) ? $place_fallbacks[$i][3] : $place_fallbacks[0][3];
 $places[] = array($post->post_title,$category,$rating ? $rating : '4.8',sakhtsar_featured_image($post->ID,$fallback),get_permalink($post->ID));
}
if (!$places) foreach ($place_fallbacks as $p) $places[] = array($p[0],$p[1],$p[2],$p[3],'#places');

$trip_fallbacks = array(
 array('طبیعت و آبشارها','طبیعت‌گردی','۵ مکان','۵۰ کیلومتر','۴ ساعت','https://images.unsplash.com/photo-1432405972618-c60b0225b8f9?auto=format&fit=crop&w=1000&q=80'),
 array('رامسر در یک روز','ترکیبی','۶ مکان','۷۰ کیلومتر','۶ ساعت','https://images.unsplash.com/photo-1507525428034-b723cf961d3e?auto=format&fit=crop&w=1000&q=80'),
 array('جواهرده و ییلاق‌ها','طبیعت‌گردی','۵ مکان','۶۰ کیلومتر','۵ ساعت','https://images.unsplash.com/photo-1500534623283-312aade485b7?auto=format&fit=crop&w=1000&q=80')
);
$trips = array();
$trip_posts = get_posts(array('post_type'=>'ss_trip','post_status'=>'publish','posts_per_page'=>3));
foreach ($trip_posts as $i => $post) {
 $fb = isset($trip_fallbacks[$i]) ? $trip_fallbacks[$i] : $trip_fallbacks[0];
 $trips[] = array($post->post_title,'مسیر گردشگری',get_post_meta($post->ID,'_ss_locations',true) ?: '۵ مکان',get_post_meta($post->ID,'_ss_distance',true) ?: '۵۰ کیلومتر',get_post_meta($post->ID,'_ss_duration',true) ?: '۴ ساعت',sakhtsar_featured_image($post->ID,$fb[5]),get_permalink($post->ID));
}
if (!$trips) foreach ($trip_fallbacks as $t) $trips[] = array($t[0],$t[1],$t[2],$t[3],$t[4],$t[5],'#trips');

$event_fallbacks = array(
 array('24','جشنواره بهار نارنج','رامسر · بلوار معلم','https://images.unsplash.com/photo-1490750967868-88aa4486c946?auto=format&fit=crop&w=500&q=80','#events'),
 array('10','جشنواره غذاهای محلی','رامسر · مرکز شهر','https://images.unsplash.com/photo-1504674900247-0877df9cc836?auto=format&fit=crop&w=500&q=80','#events'),
 array('18','جشنواره تابستان رامسر','رامسر · ساحل','https://images.unsplash.com/photo-1500530855697-b586d89ba3ee?auto=format&fit=crop&w=500&q=80','#events')
);
$events = array();
$event_posts = get_posts(array('post_type'=>'ss_event','post_status'=>'publish','posts_per_page'=>3));
foreach ($event_posts as $post) {
 $date = get_post_meta($post->ID,'_ss_event_date',true);
 $day = $date ? date_i18n('j',strtotime($date)) : '24';
 $events[] = array($day,$post->post_title,get_post_meta($post->ID,'_ss_event_location',true) ?: 'رامسر',sakhtsar_featured_image($post->ID,$event_fallbacks[0][3]),get_permalink($post->ID));
}
if (!$events) $events = $event_fallbacks;

$mag_fallbacks = array(
 array('بهترین زمان سفر به رامسر','راهنمای کامل فصل‌ها','https://images.unsplash.com/photo-1500534623283-312aade485b7?auto=format&fit=crop&w=500&q=80','#magazine'),
 array('راهنمای سفر به جواهرده','هر آنچه باید بدانید','https://images.unsplash.com/photo-1441974231531-c6227db76b6e?auto=format&fit=crop&w=500&q=80','#magazine'),
 array('غذاهای محلی رامسر','طعم‌های فراموش‌نشدنی','https://images.unsplash.com/photo-1540189549336-e6e99c3679fe?auto=format&fit=crop&w=500&q=80','#magazine')
);
$mag = array();
$mag_posts = get_posts(array('post_type'=>'ss_magazine','post_status'=>'publish','posts_per_page'=>3));
foreach ($mag_posts as $post) {
 $excerpt = wp_trim_words(wp_strip_all_tags($post->post_content),7,'…');
 $mag[] = array($post->post_title,$excerpt ?: 'راهنمای سفر و گردشگری رامسر',sakhtsar_featured_image($post->ID,$mag_fallbacks[0][2]),get_permalink($post->ID));
}
if (!$mag) $mag = $mag_fallbacks;

$gallery = array();
$gallery_posts = get_posts(array('post_type'=>'ss_gallery','post_status'=>'publish','posts_per_page'=>6));
foreach ($gallery_posts as $post) { $image = sakhtsar_featured_image($post->ID,''); if ($image) $gallery[] = $image; }
if (!$gallery) $gallery = array_column($places,3);

get_header();
?>
<main class="sakhtsar-home">
<section class="hero" style="background-image:url('<?php echo esc_url($hero); ?>')">
 <button class="hero-arrow hero-arrow-next" type="button" aria-label="اسلاید قبلی">‹</button>
 <button class="hero-arrow hero-arrow-prev" type="button" aria-label="اسلاید بعدی">›</button>
 <div class="container hero-inner">
  <aside class="weather-card"><div class="weather-head">هوای امروز رامسر</div><div class="temperature"><span class="weather-icon">🌤️</span><strong><?php echo esc_html(sakhtsar_get('weather_temp','18°')); ?></strong></div><div class="weather-state"><?php echo esc_html(sakhtsar_get('weather_state','نیمه ابری')); ?></div><div class="weather-minmax"><div>☼<br><strong>16°</strong><br>کمینه</div><div>☼<br><strong>24°</strong><br>بیشینه</div></div><div class="weather-note">🌿 مناسب برای طبیعت‌گردی</div></aside>
  <div class="hero-copy"><div class="hero-kicker"><?php echo esc_html(sakhtsar_get('hero_kicker','سخت سر، راهنمای جامع شما برای کشف طبیعت، فرهنگ و تاریخ')); ?></div><h1 class="hero-title"><?php echo esc_html(sakhtsar_get('hero_title','رامسر')); ?><br><span><?php echo esc_html(sakhtsar_get('hero_subtitle','بهشت همیشه سبز')); ?></span></h1><p class="hero-subtitle"><?php echo esc_html(sakhtsar_get('hero_description','سخت سر، راهنمای جامع شما برای کشف طبیعت، فرهنگ، تاریخ و زیبایی‌های بی‌نظیر رامسر')); ?></p>
   <form class="hero-search" role="search" method="get" action="<?php echo esc_url(home_url('/')); ?>"><button class="search-icon" type="submit" aria-label="جستجو">⌕</button><input name="s" type="search" placeholder="دنبال چه چیزی در رامسر هستید؟" aria-label="جستجو در سخت سر"><div class="search-category">همه دسته‌بندی‌ها⌄</div></form>
   <div class="quick-tags"><a href="#places">تله کابین رامسر</a><a href="#places">آبشار صفارود</a><a href="#places">قلعه مارکوه</a><a href="#places">ساحل رامسر</a><a href="#trips">جواهرده</a></div>
  </div>
 </div>
</section>
<section class="quick-services"><div class="container service-grid"><?php foreach(array(array('🍲','فرهنگ و غذا','غذاهای محلی و فرهنگ رامسر','#'),array('🎒','راهنمای سفر','هر آنچه برای سفر نیاز دارید','#'),array('▦','رویدادها','جشنواره‌ها و رویدادهای ویژه','#events'),array('🧭','مسیرهای گردشگری','بهترین مسیرها برای سفر','#trips'),array('🗺','نقشه رامسر','مشاهده نقشه تعاملی','#')) as $s): ?><a class="service-card" href="<?php echo esc_url($s[3]); ?>"><span class="service-icon"><?php echo esc_html($s[0]); ?></span><span><strong class="service-title"><?php echo esc_html($s[1]); ?></strong><small class="service-desc"><?php echo esc_html($s[2]); ?></small></span></a><?php endforeach; ?></div></section>
<section class="section" id="places"><div class="container"><div class="section-head"><h2 class="section-title">جاهای رامسر</h2><a class="section-link" href="<?php echo esc_url(get_post_type_archive_link('ss_place') ?: '#places'); ?>">مشاهده همه ←</a></div><div class="places-wrap"><button class="carousel-btn carousel-btn-right" type="button" aria-label="قبلی">‹</button><div class="places-grid"><?php foreach($places as $p): ?><a class="place-card" href="<?php echo esc_url($p[4]); ?>"><div class="place-img" style="background-image:url('<?php echo esc_url($p[3]); ?>')"></div><div class="place-body"><h3 class="place-name"><?php echo esc_html($p[0]); ?></h3><div class="place-meta"><span class="rating">★ <?php echo esc_html($p[2]); ?></span><span><?php echo esc_html($p[1]); ?></span></div></div></a><?php endforeach; ?></div><button class="carousel-btn carousel-btn-left" type="button" aria-label="بعدی">›</button></div></div></section>
<section class="container section" id="trips"><div class="trip-section"><div class="section-head"><h2 class="section-title">مسیرهای گردشگری پیشنهادی</h2><a class="section-link" href="<?php echo esc_url(get_post_type_archive_link('ss_trip') ?: '#trips'); ?>">🌿 مشاهده مسیرها</a></div><div class="trip-grid"><?php foreach($trips as $t): ?><article class="trip-card"><div class="trip-img" style="background-image:url('<?php echo esc_url($t[5]); ?>')"></div><div class="trip-body"><h3 class="trip-title"><?php echo esc_html($t[0]); ?></h3><div class="trip-type"><?php echo esc_html($t[1]); ?></div><div class="trip-info"><span>◷ <?php echo esc_html($t[4]); ?></span><span>⌁ <?php echo esc_html($t[3]); ?></span><span>⌖ <?php echo esc_html($t[2]); ?></span></div><a class="trip-btn" href="<?php echo esc_url($t[6]); ?>">مشاهده مسیر</a></div></article><?php endforeach; ?></div></div></section>
<section class="container section" id="events"><div class="lower-grid"><div class="panel"><div class="section-head"><h2 class="panel-title">رویدادهای پیش رو</h2><a class="section-link" href="<?php echo esc_url(get_post_type_archive_link('ss_event') ?: '#events'); ?>">مشاهده همه</a></div><?php foreach($events as $e): ?><a class="event-item" href="<?php echo esc_url($e[4]); ?>"><div class="date-box"><strong><?php echo esc_html($e[0]); ?></strong><small>خرداد</small></div><div class="item-text"><h3 class="item-title"><?php echo esc_html($e[1]); ?></h3><div class="item-sub"><?php echo esc_html($e[2]); ?></div></div><div class="thumb" style="background-image:url('<?php echo esc_url($e[3]); ?>')"></div></a><?php endforeach; ?></div><div class="panel"><div class="section-head"><h2 class="panel-title">گالری زیبایی‌های رامسر</h2><a class="section-link" href="<?php echo esc_url(get_post_type_archive_link('ss_gallery') ?: '#'); ?>">همه</a></div><div class="gallery-grid"><?php foreach($gallery as $g): ?><div class="gallery-img" style="background-image:url('<?php echo esc_url($g); ?>')"></div><?php endforeach; ?></div></div><div class="panel" id="magazine"><div class="section-head"><h2 class="panel-title">مجله سخت سر</h2><a class="section-link" href="<?php echo esc_url(get_post_type_archive_link('ss_magazine') ?: '#magazine'); ?>">مشاهده همه</a></div><?php foreach($mag as $m): ?><a class="mag-item" href="<?php echo esc_url($m[3]); ?>"><div class="item-text"><h3 class="item-title"><?php echo esc_html($m[0]); ?></h3><div class="item-sub"><?php echo esc_html($m[1]); ?></div></div><div class="thumb" style="background-image:url('<?php echo esc_url($m[2]); ?>')"></div></a><?php endforeach; ?></div></div></section>
<section class="container video-section"><div class="video-banner"><div class="play">▶</div><div class="video-copy"><strong>رامسر را بهتر بشناسید</strong><span>طبیعت، فرهنگ و جاذبه‌های شهر سبز را در یک نگاه ببینید</span><a href="#">تماشای ویدئو</a></div></div></section>
</main>
<?php get_footer(); ?>

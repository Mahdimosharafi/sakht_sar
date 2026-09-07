<?php
if (!defined('ABSPATH')) exit;
$hero = sakhtsar_get('hero_image','https://images.unsplash.com/photo-1500534623283-312aade485b7?auto=format&fit=crop&w=2200&q=86');
$places = [
 ['تله کابین رامسر','طبیعی','4.8','https://images.unsplash.com/photo-1520962922320-2038eebab146?auto=format&fit=crop&w=700&q=80'],
 ['آبشار صفارود','طبیعی','4.7','https://images.unsplash.com/photo-1432405972618-c60b0225b8f9?auto=format&fit=crop&w=700&q=80'],
 ['قلعه مارکوه','تاریخی','4.7','https://images.unsplash.com/photo-1539650116574-75c0c6d73f6e?auto=format&fit=crop&w=700&q=80'],
 ['ساحل رامسر','طبیعی','4.6','https://images.unsplash.com/photo-1507525428034-b723cf961d3e?auto=format&fit=crop&w=700&q=80'],
 ['پارک جنگلی صفارود','طبیعی','4.6','https://images.unsplash.com/photo-1448375240586-882707db888b?auto=format&fit=crop&w=700&q=80'],
];
$trips = [
 ['طبیعت و آبشارها','طبیعت‌گردی','۵ مکان','۵۰ کیلومتر','۴ ساعت','https://images.unsplash.com/photo-1432405972618-c60b0225b8f9?auto=format&fit=crop&w=1000&q=80'],
 ['رامسر در یک روز','ترکیبی','۶ مکان','۷۰ کیلومتر','۶ ساعت','https://images.unsplash.com/photo-1507525428034-b723cf961d3e?auto=format&fit=crop&w=1000&q=80'],
 ['جواهرده و ییلاق‌ها','طبیعت‌گردی','۵ مکان','۶۰ کیلومتر','۵ ساعت','https://images.unsplash.com/photo-1500534623283-312aade485b7?auto=format&fit=crop&w=1000&q=80'],
];
$events=[['24','جشنواره بهار نارنج','رامسر · بلوار معلم','https://images.unsplash.com/photo-1490750967868-88aa4486c946?auto=format&fit=crop&w=500&q=80'],['10','جشنواره غذاهای محلی','رامسر · مرکز شهر','https://images.unsplash.com/photo-1504674900247-0877df9cc836?auto=format&fit=crop&w=500&q=80'],['18','جشنواره تابستان رامسر','رامسر · ساحل','https://images.unsplash.com/photo-1500530855697-b586d89ba3ee?auto=format&fit=crop&w=500&q=80']];
$mag=[['بهترین زمان سفر به رامسر','راهنمای کامل فصل‌ها','https://images.unsplash.com/photo-1500534623283-312aade485b7?auto=format&fit=crop&w=500&q=80'],['راهنمای سفر به جواهرده','هر آنچه باید بدانید','https://images.unsplash.com/photo-1441974231531-c6227db76b6e?auto=format&fit=crop&w=500&q=80'],['غذاهای محلی رامسر','طعم‌های فراموش‌نشدنی','https://images.unsplash.com/photo-1540189549336-e6e99c3679fe?auto=format&fit=crop&w=500&q=80']];
$gallery=array_column($places,3); $gallery=array_merge($gallery,['https://images.unsplash.com/photo-1441974231531-c6227db76b6e?auto=format&fit=crop&w=500&q=80']);
get_header();
?>
<main>
<section class="hero" style="background-image:url('<?php echo esc_url($hero); ?>')">
  <button class="hero-arrow next" aria-label="قبلی">‹</button><button class="hero-arrow prev" aria-label="بعدی">›</button>
  <div class="container hero-inner">
    <aside class="weather-card"><div class="weather-head">هوای امروز رامسر</div><div class="temperature"><span class="weather-icon">🌤️</span><span><?php echo esc_html(sakhtsar_get('weather_temp','18°')); ?></span></div><div class="weather-state"><?php echo esc_html(sakhtsar_get('weather_state','نیمه ابری')); ?></div><div class="weather-minmax"><div>☼<br><strong>16°</strong><br>کمینه</div><div>☼<br><strong>24°</strong><br>بیشینه</div></div><div class="weather-note">🌿 مناسب برای طبیعت‌گردی</div></aside>
    <div class="hero-copy"><div class="hero-kicker">سخت سر، راهنمای جامع شما برای کشف طبیعت، فرهنگ، تاریخ</div><h1 class="hero-title"><?php echo esc_html(sakhtsar_get('hero_title','رامسر')); ?><br><span><?php echo esc_html(sakhtsar_get('hero_subtitle','بهشت همیشه سبز')); ?></span></h1><p class="hero-subtitle">سخت سر، راهنمای جامع شما برای کشف طبیعت، فرهنگ، تاریخ و زیبایی‌های بی‌نظیر رامسر</p>
      <form class="hero-search" role="search" method="get" action="<?php echo esc_url(home_url('/')); ?>"><button class="search-icon" aria-label="جستجو">⌕</button><input name="s" placeholder="دنبال چه چیزی در رامسر هستید؟" aria-label="جستجو در سخت سر"><div class="search-category">همه دسته‌بندی‌ها⌄</div></form>
      <div class="quick-tags"><a href="#places">تله کابین رامسر</a><a href="#places">آبشار صفارود</a><a href="#places">قلعه مارکوه</a><a href="#places">ساحل رامسر</a><a href="#trips">جواهرده</a></div>
    </div>
  </div>
</section>

<section class="quick-services"><div class="container service-grid">
<?php foreach([['🍲','فرهنگ و غذا','غذاهای محلی و فرهنگ رامسر'],['🎒','راهنمای سفر','هر آنچه برای سفر نیاز دارید'],['▦','رویدادها','جشنواره‌ها و رویدادهای ویژه'],['🧭','مسیرهای گردشگری','بهترین مسیرها برای سفر'],['🗺','نقشه رامسر','مشاهده نقشه تعاملی'] ] as $s): ?><a class="service-card" href="#"><div class="service-icon"><?php echo $s[0]; ?></div><div><div class="service-title"><?php echo $s[1]; ?></div><div class="service-desc"><?php echo $s[2]; ?></div></div></a><?php endforeach; ?></div></section>

<section class="section" id="places"><div class="container"><div class="section-head"><h2 class="section-title">جاهای رامسر</h2><a class="section-link" href="#">مشاهده همه ←</a></div><div class="places-wrap"><button class="carousel-btn right">‹</button><div class="places-grid"><?php foreach($places as $p): ?><article class="place-card"><div class="place-img" style="background-image:url('<?php echo esc_url($p[3]); ?>')"></div><div class="place-body"><h3 class="place-name"><?php echo esc_html($p[0]); ?></h3><div class="place-meta"><span class="rating">★ <?php echo esc_html($p[2]); ?></span><span><?php echo esc_html($p[1]); ?></span></div></div></article><?php endforeach; ?></div><button class="carousel-btn left">›</button></div></div></section>

<section class="container section" id="trips"><div class="trip-section"><div class="section-head"><h2 class="section-title">مسیرهای گردشگری پیشنهادی</h2><a class="section-link" href="#">🌿 مشاهده مسیرها</a></div><div class="trip-grid"><?php foreach($trips as $t): ?><article class="trip-card"><div class="trip-img" style="background-image:url('<?php echo esc_url($t[5]); ?>')"></div><div class="trip-body"><h3 class="trip-title"><?php echo esc_html($t[0]); ?></h3><div class="trip-type"><?php echo esc_html($t[1]); ?></div><div class="trip-info"><span>◷ <?php echo esc_html($t[4]); ?></span><span>⌁ <?php echo esc_html($t[3]); ?></span><span>⌖ <?php echo esc_html($t[2]); ?></span></div><a class="trip-btn" href="#">مشاهده مسیر</a></div></article><?php endforeach; ?></div></div></section>

<section class="container section"><div class="lower-grid">
<div class="panel"><div class="section-head"><h2 class="panel-title">رویدادهای پیش رو</h2><a class="section-link" href="#">مشاهده همه</a></div><?php foreach($events as $e): ?><div class="event-item"><div class="date-box"><strong><?php echo $e[0]; ?></strong><small>خرداد</small></div><div class="item-text"><h3 class="item-title"><?php echo esc_html($e[1]); ?></h3><div class="item-sub"><?php echo esc_html($e[2]); ?></div></div><div class="thumb" style="background-image:url('<?php echo esc_url($e[3]); ?>')"></div></div><?php endforeach; ?></div>
<div class="panel"><div class="section-head"><h2 class="panel-title">گالری زیبایی‌های رامسر</h2><a class="section-link" href="#">همه</a></div><div class="gallery-grid"><?php foreach($gallery as $g): ?><div class="gallery-img" style="background-image:url('<?php echo esc_url($g); ?>')"></div><?php endforeach; ?></div></div>
<div class="panel"><div class="section-head"><h2 class="panel-title">مجله سخت سر</h2><a class="section-link" href="#">مشاهده همه</a></div><?php foreach($mag as $m): ?><article class="mag-item"><div class="item-text"><h3 class="item-title"><?php echo esc_html($m[0]); ?></h3><div class="item-sub"><?php echo esc_html($m[1]); ?></div></div><div class="thumb" style="background-image:url('<?php echo esc_url($m[2]); ?>')"></div></article><?php endforeach; ?></div>
</div></section>

<section class="container"><div class="video-banner"><div class="play">▶</div><div class="video-copy"><strong>رامسر را بهتر بشناسید</strong><span>ویدیوهای معرفی جاذبه‌ها، فرهنگ و طبیعت رامسر</span><br><a href="#">مشاهده ویدیوها</a></div></div></section>
</main>
<?php get_footer(); ?>

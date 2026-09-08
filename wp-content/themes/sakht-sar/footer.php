<?php if (!defined('ABSPATH')) exit; ?>
<footer class="site-footer">
  <div class="container">
    <div class="footer-grid">
      <section class="footer-brand-block">
        <a class="footer-brand" href="<?php echo esc_url(home_url('/')); ?>" aria-label="<?php echo esc_attr(get_bloginfo('name')); ?>">
          <?php $footer_logo = sakhtsar_get('footer_logo', ''); ?>
          <?php if ($footer_logo) : ?>
            <img class="footer-logo-image" src="<?php echo esc_url($footer_logo); ?>" alt="<?php echo esc_attr(get_bloginfo('name')); ?>">
          <?php elseif (has_custom_logo()) : ?>
            <?php echo wp_get_attachment_image(get_theme_mod('custom_logo'), 'full', false, array('class'=>'footer-logo-image','alt'=>get_bloginfo('name'))); ?>
          <?php else : ?>
            <span class="footer-brand-fallback">
              <span class="footer-brand-wordmark">سخت سر</span>
              <svg class="footer-brand-mountain" viewBox="0 0 80 44" aria-hidden="true" focusable="false">
                <path d="M4 38 25 15l9 10 10-17 32 30" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round"/>
                <path d="m13 38 15-15 9 9 8-10 18 16" fill="none" stroke="currentColor" stroke-width="1.35" stroke-linecap="round" stroke-linejoin="round" opacity=".72"/>
              </svg>
            </span>
          <?php endif; ?>
        </a>
        <p class="footer-copy"><?php echo esc_html(sakhtsar_get('footer_description','هدف ما معرفی زیبایی‌ها، فرهنگ و ظرفیت‌های گردشگری رامسر به شماست.')); ?></p>
        <div class="footer-socials" aria-label="شبکه‌های اجتماعی">
          <a href="#" aria-label="اینستاگرام"><span>◎</span></a>
          <a href="#" aria-label="تلگرام"><span>➤</span></a>
          <a href="#" aria-label="یوتیوب"><span>▶</span></a>
          <a href="#" aria-label="آپارات"><span>◈</span></a>
          <a href="#" aria-label="شبکه اجتماعی"><span>◉</span></a>
        </div>
      </section>

      <nav class="footer-col" aria-label="دسترسی سریع">
        <h3>دسترسی سریع</h3>
        <a href="<?php echo esc_url(home_url('/')); ?>">خانه</a>
        <a href="<?php echo esc_url(home_url('/places/')); ?>">جاهای دیدنی</a>
        <a href="<?php echo esc_url(home_url('/trips/')); ?>">مسیرهای گردشگری</a>
        <a href="<?php echo esc_url(home_url('/events/')); ?>">رویدادها</a>
        <a href="<?php echo esc_url(home_url('/magazine/')); ?>">راهنمای سفر</a>
      </nav>

      <nav class="footer-col" aria-label="دسته‌بندی‌ها">
        <h3>دسته‌بندی‌ها</h3>
        <a href="<?php echo esc_url(home_url('/place-type/nature/')); ?>">طبیعت</a>
        <a href="<?php echo esc_url(home_url('/place-type/historical/')); ?>">تاریخی</a>
        <a href="<?php echo esc_url(home_url('/place-type/entertainment/')); ?>">تفریحی</a>
        <a href="<?php echo esc_url(home_url('/place-type/cultural/')); ?>">فرهنگی</a>
        <a href="<?php echo esc_url(home_url('/place-type/food/')); ?>">غذا و رستوران</a>
      </nav>

      <nav class="footer-col" aria-label="درباره سخت سر">
        <h3>درباره سخت سر</h3>
        <a href="#about">درباره ما</a>
        <a href="#contact">تماس با ما</a>
        <a href="#privacy">قوانین و حریم خصوصی</a>
        <a href="#faq">سوالات متداول</a>
      </nav>

      <section class="footer-col footer-contact-col" id="contact">
        <h3>تماس با ما</h3>
        <div class="footer-contact"><span class="contact-icon" aria-hidden="true">⌕</span><?php echo esc_html(sakhtsar_get('footer_phone','011-552xxxxx')); ?></div>
        <div class="footer-contact"><span class="contact-icon" aria-hidden="true">✉</span><?php echo esc_html(sakhtsar_get('footer_email','info@sakhtsar.ir')); ?></div>
        <div class="footer-contact"><span class="contact-icon" aria-hidden="true">⌖</span><?php echo esc_html(sakhtsar_get('footer_address','رامسر، میدان شهرداری')); ?></div>
      </section>
    </div>

    <div class="footer-bottom">© <?php echo esc_html(wp_date('Y')); ?> سخت‌سر <span aria-hidden="true">·</span> تمامی حقوق این وب‌سایت محفوظ است.</div>
  </div>
</footer>
<?php wp_footer(); ?>
</body>
</html>

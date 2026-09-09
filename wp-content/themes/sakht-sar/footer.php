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
              <svg class="footer-brand-mountain" viewBox="0 0 80 44" aria-hidden="true" focusable="false"><path d="M4 38 25 15l9 10 10-17 32 30" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round"/><path d="m13 38 15-15 9 9 8-10 18 16" fill="none" stroke="currentColor" stroke-width="1.35" stroke-linecap="round" stroke-linejoin="round" opacity=".72"/></svg>
            </span>
          <?php endif; ?>
        </a>
        <p class="footer-copy"><?php echo esc_html(sakhtsar_get('footer_description','هدف ما معرفی زیبایی‌ها، فرهنگ و ظرفیت‌های گردشگری رامسر به شماست.')); ?></p>
        <div class="footer-socials" aria-label="شبکه‌های اجتماعی">
          <a href="#" aria-label="اینستاگرام" title="اینستاگرام"><svg viewBox="0 0 24 24" aria-hidden="true"><rect x="3" y="3" width="18" height="18" rx="5" fill="none" stroke="currentColor" stroke-width="2"/><circle cx="12" cy="12" r="4.2" fill="none" stroke="currentColor" stroke-width="2"/><circle cx="17.4" cy="6.7" r="1.2"/></svg></a>
          <a href="#" aria-label="تلگرام" title="تلگرام"><svg viewBox="0 0 24 24" aria-hidden="true"><path d="M21 4 3.8 10.7c-.8.3-.8 1.4 0 1.7l4.3 1.5 1.6 4.8c.2.7 1.1.9 1.6.4l2.4-2.3 4.5 3.3c.6.4 1.4.1 1.6-.6L23 5.2c.2-.8-1.1-1.5-2-.9Z" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linejoin="round"/><path d="m8.2 13.9 9.6-6.1-7.1 7.8" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg></a>
          <a href="#" aria-label="یوتیوب" title="یوتیوب"><svg viewBox="0 0 24 24" aria-hidden="true"><rect x="2.5" y="5.5" width="19" height="13" rx="4" fill="none" stroke="currentColor" stroke-width="1.8"/><path d="m10 9 5 3-5 3Z" fill="currentColor" stroke="none"/></svg></a>
          <a href="#" aria-label="آپارات" title="آپارات"><svg viewBox="0 0 24 24" aria-hidden="true"><path d="M12 3.2a8.8 8.8 0 1 0 8.8 8.8A8.8 8.8 0 0 0 12 3.2Z" fill="none" stroke="currentColor" stroke-width="1.7"/><path d="M9 9.2h.1M15 9.2h.1M8.5 14.3c1.1 1.1 2 1.5 3.5 1.5s2.4-.4 3.5-1.5" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/></svg></a>
          <a href="#" aria-label="شبکه اجتماعی" title="شبکه اجتماعی"><svg viewBox="0 0 24 24" aria-hidden="true"><circle cx="12" cy="12" r="9" fill="none" stroke="currentColor" stroke-width="1.8"/><path d="M8 12h8M12 8v8" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/></svg></a>
        </div>
      </section>
      <nav class="footer-col" aria-label="دسترسی سریع"><h3>دسترسی سریع</h3><a href="<?php echo esc_url(home_url('/')); ?>">خانه</a><a href="<?php echo esc_url(home_url('/places/')); ?>">جاهای دیدنی</a><a href="<?php echo esc_url(home_url('/trips/')); ?>">مسیرهای گردشگری</a><a href="<?php echo esc_url(home_url('/events/')); ?>">رویدادها</a><a href="<?php echo esc_url(home_url('/magazine/')); ?>">راهنمای سفر</a></nav>
      <nav class="footer-col" aria-label="دسته‌بندی‌ها"><h3>دسته‌بندی‌ها</h3><a href="<?php echo esc_url(home_url('/place-type/nature/')); ?>">طبیعت</a><a href="<?php echo esc_url(home_url('/place-type/historical/')); ?>">تاریخی</a><a href="<?php echo esc_url(home_url('/place-type/entertainment/')); ?>">تفریحی</a><a href="<?php echo esc_url(home_url('/place-type/cultural/')); ?>">فرهنگی</a><a href="<?php echo esc_url(home_url('/place-type/food/')); ?>">غذا و رستوران</a></nav>
      <nav class="footer-col" aria-label="درباره سخت سر"><h3>درباره سخت سر</h3><a href="#about">درباره ما</a><a href="#contact">تماس با ما</a><a href="#privacy">قوانین و حریم خصوصی</a><a href="#faq">سوالات متداول</a></nav>
      <section class="footer-col footer-contact-col" id="contact"><h3>تماس با ما</h3><div class="footer-contact"><span class="contact-icon" aria-hidden="true"><svg viewBox="0 0 24 24"><path d="M6.6 3.8 9.2 3c.6-.2 1.2.1 1.5.7l1.3 3.1c.2.5.1 1-.3 1.4l-1.5 1.2a14.8 14.8 0 0 0 4.4 4.4l1.2-1.5c.4-.4.9-.5 1.4-.3l3.1 1.3c.6.3.9.9.7 1.5l-.8 2.6c-.2.7-.9 1.1-1.6 1A15.8 15.8 0 0 1 5.6 5.4c-.1-.7.3-1.4 1-1.6Z"/></svg></span><?php echo esc_html(sakhtsar_get('footer_phone','011-552xxxxx')); ?></div><div class="footer-contact"><span class="contact-icon" aria-hidden="true"><svg viewBox="0 0 24 24"><rect x="3" y="5" width="18" height="14" rx="2"/><path d="m4 7 8 6 8-6"/></svg></span><?php echo esc_html(sakhtsar_get('footer_email','info@sakhtsar.ir')); ?></div><div class="footer-contact"><span class="contact-icon" aria-hidden="true"><svg viewBox="0 0 24 24"><path d="M12 21s7-6.2 7-12a7 7 0 1 0-14 0c0 5.8 7 12 7 12Z"/><circle cx="12" cy="9" r="2.3"/></svg></span><?php echo esc_html(sakhtsar_get('footer_address','رامسر، میدان شهرداری')); ?></div></section>
    </div>
    <div class="footer-bottom">© <?php echo esc_html(wp_date('Y')); ?> سخت‌سر <span aria-hidden="true">·</span> تمامی حقوق این وب‌سایت محفوظ است.</div>
  </div>
</footer>
<?php wp_footer(); ?>
</body>
</html>

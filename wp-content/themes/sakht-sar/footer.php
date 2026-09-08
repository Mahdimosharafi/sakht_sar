<?php if (!defined('ABSPATH')) exit; ?>
<footer class="site-footer">
  <div class="container">
    <div class="footer-grid">
      <section class="footer-brand-block">
        <a class="footer-brand" href="<?php echo esc_url(home_url('/')); ?>" aria-label="<?php echo esc_attr(get_bloginfo('name')); ?>">
          <?php if (has_custom_logo()) : ?>
            <span class="footer-logo-image"><?php the_custom_logo(); ?></span>
          <?php else : ?>
            <span class="footer-brand-wordmark">سخت سر</span>
            <span class="footer-brand-mark" aria-hidden="true">⌁</span>
          <?php endif; ?>
        </a>
        <p class="footer-copy"><?php echo esc_html(sakhtsar_get('footer_description','هدف ما معرفی زیبایی‌ها، فرهنگ و ظرفیت‌های گردشگری رامسر به شماست.')); ?></p>
        <div class="footer-socials" aria-label="شبکه‌های اجتماعی">
          <a href="#" aria-label="اینستاگرام">◎</a>
          <a href="#" aria-label="تلگرام">➤</a>
          <a href="#" aria-label="یوتیوب">▶</a>
          <a href="#" aria-label="آپارات">◈</a>
          <a href="#" aria-label="شبکه اجتماعی">◉</a>
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
        <div class="footer-contact"><span aria-hidden="true">⌕</span><?php echo esc_html(sakhtsar_get('footer_phone','011-552xxxxx')); ?></div>
        <div class="footer-contact"><span aria-hidden="true">✉</span><?php echo esc_html(sakhtsar_get('footer_email','info@sakhtsar.ir')); ?></div>
        <div class="footer-contact"><span aria-hidden="true">⌖</span><?php echo esc_html(sakhtsar_get('footer_address','رامسر، میدان شهرداری')); ?></div>
      </section>
    </div>

    <div class="footer-bottom">
      <span>© <?php echo esc_html(wp_date('Y')); ?> سخت‌سر</span>
      <span>تمامی حقوق این وب‌سایت محفوظ است.</span>
    </div>
  </div>
</footer>
<?php wp_footer(); ?>
</body>
</html>
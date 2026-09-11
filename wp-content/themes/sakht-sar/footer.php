<?php if (!defined('ABSPATH')) exit; ?>
<footer class="site-footer">
  <div class="container">
    <div class="footer-grid">
      <section class="footer-col footer-contact-col" id="contact">
        <h3>تماس با ما</h3>
        <div class="footer-contact"><span class="contact-icon" aria-hidden="true"><svg viewBox="0 0 24 24"><path d="M6.6 3.8 9.2 3c.6-.2 1.2.1 1.5.7l1.3 3.1c.2.5.1 1-.3 1.4l-1.5 1.2a14.8 14.8 0 0 0 4.4 4.4l1.2-1.5c.4-.4.9-.5 1.4-.3l3.1 1.3c.6.3.9.9.7 1.5l-.8 2.6c-.2.7-.9 1.1-1.6 1A15.8 15.8 0 0 1 5.6 5.4c-.1-.7.3-1.4 1-1.6Z"/></svg></span><?php echo esc_html(sakhtsar_get('footer_phone','011-552xxxxx')); ?></div>
        <div class="footer-contact"><span class="contact-icon" aria-hidden="true"><svg viewBox="0 0 24 24"><rect x="3" y="5" width="18" height="14" rx="2"/><path d="m4 7 8 6 8-6"/></svg></span><?php echo esc_html(sakhtsar_get('footer_email','info@sakhtsar.ir')); ?></div>
        <div class="footer-contact"><span class="contact-icon" aria-hidden="true"><svg viewBox="0 0 24 24"><path d="M12 21s7-6.2 7-12a7 7 0 1 0-14 0c0 5.8 7 12 7 12Z"/><circle cx="12" cy="9" r="2.3"/></svg></span><?php echo esc_html(sakhtsar_get('footer_address','رامسر، میدان شهرداری')); ?></div>
      </section>
      <nav class="footer-col" aria-label="درباره سخت‌سر"><h3>درباره سخت‌سر</h3><?php wp_nav_menu(array('theme_location'=>'footer_about','container'=>false,'fallback_cb'=>false,'depth'=>1)); ?></nav>
      <nav class="footer-col" aria-label="دسترسی سریع"><h3>دسترسی سریع</h3><?php wp_nav_menu(array('theme_location'=>'footer_quick','container'=>false,'fallback_cb'=>false,'depth'=>1)); ?></nav>
      <section class="footer-brand-block">
        <a class="footer-brand" href="<?php echo esc_url(home_url('/')); ?>" aria-label="<?php echo esc_attr(get_bloginfo('name')); ?>">
          <?php $footer_logo=sakhtsar_get('footer_logo',''); ?>
          <?php if($footer_logo): ?><img class="footer-logo-image" src="<?php echo esc_url($footer_logo); ?>" alt="<?php echo esc_attr(get_bloginfo('name')); ?>">
          <?php elseif(has_custom_logo()): ?><?php echo wp_get_attachment_image(get_theme_mod('custom_logo'),'full',false,array('class'=>'footer-logo-image','alt'=>get_bloginfo('name'))); ?>
          <?php else: ?><span class="footer-brand-fallback"><span class="footer-brand-wordmark">سخت سر</span><svg class="footer-brand-mountain" viewBox="0 0 80 44" aria-hidden="true"><path d="M4 38 25 15l9 10 10-17 32 30" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round"/><path d="m13 38 15-15 9 9 8-10 18 16" fill="none" stroke="currentColor" stroke-width="1.35" stroke-linecap="round" stroke-linejoin="round" opacity=".72"/></svg></span><?php endif; ?>
        </a>
        <p class="footer-copy"><?php echo esc_html(sakhtsar_get('footer_description','هدف ما معرفی زیبایی‌ها، فرهنگ و ظرفیت‌های گردشگری رامسر به شماست.')); ?></p>
        <div class="footer-socials" aria-label="شبکه‌های اجتماعی"><?php sakhtsar_footer_socials(); ?></div>
      </section>
    </div>
    <div class="footer-bottom">© <?php echo esc_html(wp_date('Y')); ?> سخت‌سر <span aria-hidden="true">·</span> تمامی حقوق این وب‌سایت محفوظ است.</div>
  </div>
</footer>
<?php wp_footer(); ?></body></html>

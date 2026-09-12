<?php if (!defined('ABSPATH')) exit; ?>
<footer class="site-footer">
  <div class="container">
    <div class="footer-grid">
      <section class="footer-col footer-contact-col" id="contact">
        <?php if (is_active_sidebar('footer_contact')) : ?>
          <?php dynamic_sidebar('footer_contact'); ?>
        <?php endif; ?>
      </section>

      <section class="footer-col footer-about-col">
        <?php if (is_active_sidebar('footer_about')) : ?>
          <?php dynamic_sidebar('footer_about'); ?>
        <?php endif; ?>
      </section>

      <section class="footer-col footer-quick-col">
        <?php if (is_active_sidebar('footer_quick')) : ?>
          <?php dynamic_sidebar('footer_quick'); ?>
        <?php endif; ?>
      </section>

      <section class="footer-brand-block">
        <?php if (is_active_sidebar('footer_brand')) : ?>
          <?php dynamic_sidebar('footer_brand'); ?>
        <?php endif; ?>
      </section>
    </div>
    <div class="footer-bottom">© <?php echo esc_html(wp_date('Y')); ?> سخت‌سر <span aria-hidden="true">·</span> تمامی حقوق این وب‌سایت محفوظ است.</div>
  </div>
</footer>
<?php wp_footer(); ?></body></html>

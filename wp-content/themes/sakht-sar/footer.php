<?php if (!defined('ABSPATH')) exit; ?>
<style id="sakhtsar-footer-revamp">
.site-footer{padding:38px 0 15px;background:linear-gradient(135deg,#06391d,#084b27);color:#fff}
.site-footer .footer-grid{direction:rtl;grid-template-columns:1.55fr repeat(3,1fr);gap:35px;align-items:start}
.site-footer .footer-grid > *{border:0 !important}
.site-footer .footer-grid > .footer-col:nth-child(3),
.site-footer .footer-grid > .footer-col:nth-child(4),
.site-footer .footer-grid > .footer-col:nth-child(5){border-left:1px solid rgba(255,255,255,.2) !important}
.site-footer .footer-brand-block{grid-column:1}
.site-footer .footer-contact-col{grid-column:5}
.site-footer .footer-brand-block,.site-footer .footer-col{min-width:0;text-align:right}
.site-footer .footer-brand{display:inline-flex;align-items:center}
.site-footer .footer-logo-image{max-width:190px;height:auto;display:block}
.site-footer .footer-brand-fallback{display:flex;align-items:center;gap:8px}
.site-footer .footer-brand-wordmark{font-size:20px;font-weight:900}
.site-footer .footer-brand-mountain{width:65px;height:38px}
.site-footer .footer-copy{max-width:280px;margin:8px 0 0;color:#c7d9cb;font-size:9px;line-height:2}
.site-footer .footer-socials{display:flex;gap:8px;margin-top:12px}
.site-footer .footer-socials a{width:25px;height:25px;border:1px solid rgba(255,255,255,.35);border-radius:50%;display:inline-flex;align-items:center;justify-content:center;color:#d8e9dc;font-size:13px;transition:.2s}
.site-footer .footer-socials a:hover{background:rgba(255,255,255,.12);border-color:#fff;color:#fff;transform:translateY(-2px)}
.site-footer .footer-col h3{margin:0 0 10px;font-size:11px;font-weight:900;color:#fff}
.site-footer .footer-col a,.site-footer .footer-contact{display:block;margin:5px 0;color:#c6d8ca;font-size:8px;transition:color .2s ease}
.site-footer .footer-col a:hover{color:#fff}
.site-footer .footer-contact{display:flex;align-items:center;gap:8px;direction:rtl}
.site-footer .contact-icon{width:18px;text-align:center;font-size:16px;color:#d8e9dc}
.site-footer .footer-bottom{margin-top:25px;padding-top:11px;border-top:1px solid rgba(255,255,255,.14);color:#9fb9a5;text-align:center;font-size:7.5px}
@media(max-width:1050px){.site-footer .footer-grid{grid-template-columns:repeat(2,1fr);gap:25px}.site-footer .footer-brand-block,.site-footer .footer-contact-col{grid-column:auto}.site-footer .footer-grid > .footer-col:nth-child(3),.site-footer .footer-grid > .footer-col:nth-child(4),.site-footer .footer-grid > .footer-col:nth-child(5){border-left:1px solid rgba(255,255,255,.2) !important}}
@media(max-width:700px){.site-footer{padding:30px 0 14px}.site-footer .footer-grid{grid-template-columns:1fr 1fr;gap:24px 18px}.site-footer .footer-brand-block,.site-footer .footer-contact-col{grid-column:1/-1}.site-footer .footer-brand-block{text-align:center}.site-footer .footer-copy{max-width:100%;margin-inline:auto}.site-footer .footer-socials{justify-content:center}.site-footer .footer-col{text-align:right}.site-footer .footer-logo-image{max-width:170px}.site-footer .footer-bottom{margin-top:20px;font-size:7px}}
</style>
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
            <span class="footer-brand-fallback"><span class="footer-brand-wordmark">سخت سر</span><svg class="footer-brand-mountain" viewBox="0 0 80 44" aria-hidden="true" focusable="false"><path d="M4 38 25 15l9 9 10-17 32 30" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round"/><path d="m13 38 15-15 9 9 8-10 18 16" fill="none" stroke="currentColor" stroke-width="1.35" stroke-linecap="round" stroke-linejoin="round" opacity=".72"/></svg></span>
          <?php endif; ?>
        </a>
        <p class="footer-copy"><?php echo esc_html(sakhtsar_get('footer_description','هدف ما معرفی زیبایی‌ها، فرهنگ و ظرفیت‌های گردشگری رامسر به شماست.')); ?></p>
        <div class="footer-socials" aria-label="شبکه‌های اجتماعی"><a href="#" aria-label="اینستاگرام"><span>◎</span></a><a href="#" aria-label="تلگرام"><span>➤</span></a><a href="#" aria-label="یوتیوب"><span>▶</span></a><a href="#" aria-label="آپارات"><span>◈</span></a><a href="#" aria-label="شبکه اجتماعی"><span>◉</span></a></div>
      </section>
      <nav class="footer-col" aria-label="دسترسی سریع"><h3>دسترسی سریع</h3><a href="<?php echo esc_url(home_url('/')); ?>">خانه</a><a href="<?php echo esc_url(home_url('/places/')); ?>">جاهای دیدنی</a><a href="<?php echo esc_url(home_url('/trips/')); ?>">مسیرهای گردشگری</a><a href="<?php echo esc_url(home_url('/events/')); ?>">رویدادها</a><a href="<?php echo esc_url(home_url('/magazine/')); ?>">راهنمای سفر</a></nav>
      <nav class="footer-col" aria-label="دسته‌بندی‌ها"><h3>دسته‌بندی‌ها</h3><a href="<?php echo esc_url(home_url('/place-type/nature/')); ?>">طبیعت</a><a href="<?php echo esc_url(home_url('/place-type/historical/')); ?>">تاریخی</a><a href="<?php echo esc_url(home_url('/place-type/entertainment/')); ?>">تفریحی</a><a href="<?php echo esc_url(home_url('/place-type/cultural/')); ?>">فرهنگی</a><a href="<?php echo esc_url(home_url('/place-type/food/')); ?>">غذا و رستوران</a></nav>
      <nav class="footer-col" aria-label="درباره سخت سر"><h3>درباره سخت سر</h3><a href="#about">درباره ما</a><a href="#contact">تماس با ما</a><a href="#privacy">قوانین و حریم خصوصی</a><a href="#faq">سوالات متداول</a></nav>
      <section class="footer-col footer-contact-col" id="contact"><h3>تماس با ما</h3><div class="footer-contact"><span class="contact-icon" aria-hidden="true">⌕</span><?php echo esc_html(sakhtsar_get('footer_phone','011-552xxxxx')); ?></div><div class="footer-contact"><span class="contact-icon" aria-hidden="true">✉</span><?php echo esc_html(sakhtsar_get('footer_email','info@sakhtsar.ir')); ?></div><div class="footer-contact"><span class="contact-icon" aria-hidden="true">⌖</span><?php echo esc_html(sakhtsar_get('footer_address','رامسر، میدان شهرداری')); ?></div></section>
    </div>
    <div class="footer-bottom">© <?php echo esc_html(wp_date('Y')); ?> سخت‌سر <span aria-hidden="true">·</span> تمامی حقوق این وب‌سایت محفوظ است.</div>
  </div>
</footer>
<?php wp_footer(); ?>
</body>
</html>

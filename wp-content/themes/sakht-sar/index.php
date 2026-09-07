<?php
if (!defined('ABSPATH')) exit;
get_header();
?><main class="container section"><div class="panel"><h1 class="section-title"><?php esc_html_e('سخت‌سر','sakht-sar'); ?></h1><?php if(have_posts()): while(have_posts()): the_post(); ?><article><h2><?php the_title(); ?></h2><?php the_content(); ?></article><?php endwhile; else: ?><p>محتوایی پیدا نشد.</p><?php endif; ?></div></main><?php get_footer(); ?>
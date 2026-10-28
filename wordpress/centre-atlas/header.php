<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo('charset'); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<script>document.documentElement.classList.add('js');setTimeout(function(){document.documentElement.classList.add('js-late')},3000)</script>
<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<!-- Sprite d'icônes -->
<svg width="0" height="0" style="position:absolute" aria-hidden="true">
  <symbol id="i-calendar" viewBox="0 0 24 24"><rect x="3" y="5" width="18" height="16" rx="2"/><path d="M3 10h18M8 3v4M16 3v4"/></symbol>
  <symbol id="i-phone" viewBox="0 0 24 24"><path d="M5 4h4l2 5-2.5 1.5a11 11 0 0 0 5 5L15 13l5 2v4a2 2 0 0 1-2 2A16 16 0 0 1 3 6a2 2 0 0 1 2-2z"/></symbol>
  <symbol id="i-chat" viewBox="0 0 24 24"><path d="M4 5h16v11H9l-5 4z"/></symbol>
  <symbol id="i-stetho" viewBox="0 0 24 24"><path d="M6 3v6a4 4 0 0 0 8 0V3M10 13v3a4 4 0 0 0 8 0v-2"/><circle cx="18" cy="12" r="2"/></symbol>
  <symbol id="i-scan" viewBox="0 0 24 24"><path d="M4 8V5a1 1 0 0 1 1-1h3M16 4h3a1 1 0 0 1 1 1v3M20 16v3a1 1 0 0 1-1 1h-3M8 20H5a1 1 0 0 1-1-1v-3M4 12h16"/></symbol>
  <symbol id="i-tube" viewBox="0 0 24 24"><path d="M4 20c3 0 5-2 8-5s5-5 7-8M14 4l6 6M17 7l-3 3"/><circle cx="4" cy="20" r="1"/></symbol>
  <symbol id="i-target" viewBox="0 0 24 24"><circle cx="12" cy="12" r="8"/><circle cx="12" cy="12" r="3"/><path d="M12 2v3M12 19v3M2 12h3M19 12h3"/></symbol>
  <symbol id="i-arrow" viewBox="0 0 24 24"><path d="M5 12h14M13 6l6 6-6 6"/></symbol>
  <symbol id="i-pin" viewBox="0 0 24 24"><path d="M12 21s7-6.2 7-11a7 7 0 0 0-14 0c0 4.8 7 11 7 11z"/><circle cx="12" cy="10" r="2.5"/></symbol>
  <symbol id="i-mail" viewBox="0 0 24 24"><rect x="3" y="5" width="18" height="14" rx="2"/><path d="M3 7l9 6 9-6"/></symbol>
  <symbol id="i-shield" viewBox="0 0 24 24"><path d="M12 3l7 3v5c0 5-3.5 8-7 10-3.5-2-7-5-7-10V6z"/><path d="M9 12l2 2 4-4"/></symbol>
  <symbol id="i-heart" viewBox="0 0 24 24"><path d="M12 20s-7-4.6-7-10a4 4 0 0 1 7-2.5A4 4 0 0 1 19 10c0 5.4-7 10-7 10z"/></symbol>
  <symbol id="i-bulb" viewBox="0 0 24 24"><path d="M9 18h6M10 21h4M12 3a6 6 0 0 0-4 10.5c.7.7 1 1.5 1 2.5h6c0-1 .3-1.8 1-2.5A6 6 0 0 0 12 3z"/></symbol>
  <symbol id="i-users" viewBox="0 0 24 24"><circle cx="9" cy="8" r="3"/><path d="M3 20c0-3.3 2.7-6 6-6s6 2.7 6 6"/><circle cx="17" cy="9" r="2.5"/><path d="M17 14c2.5 0 4.5 2 4.5 4.5"/></symbol>
  <symbol id="i-clock" viewBox="0 0 24 24"><circle cx="12" cy="12" r="9"/><path d="M12 7v5l3 2"/></symbol>
  <symbol id="i-check" viewBox="0 0 24 24"><path d="M5 12.5l4.5 4.5L19 7.5"/></symbol>
  <symbol id="i-fb" viewBox="0 0 24 24"><path d="M14 8h3V4h-3a4 4 0 0 0-4 4v2H7v4h3v6h4v-6h3l1-4h-4V8z"/></symbol>
  <symbol id="i-ig" viewBox="0 0 24 24"><rect x="4" y="4" width="16" height="16" rx="5"/><circle cx="12" cy="12" r="3.5"/><circle cx="17" cy="7" r=".6"/></symbol>
  <symbol id="i-wa" viewBox="0 0 24 24"><path d="M3 21l1.6-5A8.5 8.5 0 1 1 8 19.4z"/><path d="M9 9c0 3 3 6 6 6l1-2-2-1-1 .8c-1-.4-2-1.4-2.4-2.4l.8-1-1-2z"/></symbol>
  <symbol id="i-play" viewBox="0 0 24 24"><path d="M8 5l11 7-11 7z"/></symbol>
  <symbol id="i-quote" viewBox="0 0 24 24"><path d="M9 7H5v6h3c0 2-1 3-3 3v2c4 0 6-3 6-7V7zm10 0h-4v6h3c0 2-1 3-3 3v2c4 0 6-3 6-7V7z"/></symbol>
</svg>
<div class="page-wrapper">

  <!-- ===== Header ===== -->
  <header class="nav_component">
    <div class="padding-global">
      <div class="container-large">
        <div class="nav_top">
          <a href="<?php echo esc_url(home_url('/')); ?>" class="nav_logo" aria-label="Centre Médical Atlas, accueil">
            <img src="<?php echo esc_url(get_theme_file_uri('assets/logo-icon.svg')); ?>" alt="" class="nav_logo-icon">
            <span class="nav_logo-text"><small><?php atlas_t('t9e6fc50a'); ?></small><strong><?php atlas_t('t96fd73b0'); ?></strong></span>
          </a>
          <div class="nav_contacts">
            <a href="mailto:<?php echo esc_attr(atlas_opt('email')); ?>" class="nav_contact"><svg><use href="#i-mail"/></svg><span><b><?php atlas_t('t5ded1a4d'); ?></b><small><?php atlas_t('t12a6d4d0'); ?></small></span></a>
            <a href="tel:<?php echo esc_attr(atlas_tel('tel_fixe')); ?>" class="nav_contact"><svg><use href="#i-phone"/></svg><span><b><?php atlas_t('t6f4dbb3f'); ?></b><small><?php atlas_t('t83ca4101'); ?></small></span></a>
            <a href="<?php echo esc_url(home_url('/rendez-vous/')); ?>" class="button is-dark"><?php atlas_t('tda31472f'); ?></a>
          </div>
          <button type="button" class="nav_toggle" data-nav-toggle aria-label="Ouvrir le menu" aria-expanded="false"><span class="nav_toggle-bars"><i></i><i></i><i></i></span><span class="nav_toggle-label" data-nav-label>Menu</span></button>
        </div>
        <div class="nav_bar">
        <nav class="nav_menu" data-nav-menu>
          <?php atlas_menu(); ?>
          <a href="<?php echo esc_url(home_url('/rendez-vous/')); ?>" class="button is-primary"><?php atlas_t('tda31472f'); ?></a>
        </nav>
        <div class="nav_social">
          <?php if (atlas_opt('facebook')) : ?><a href="<?php echo esc_url(atlas_opt('facebook')); ?>" aria-label="Facebook" target="_blank" rel="noopener"><svg><use href="#i-fb"/></svg></a><?php endif; ?>
          <?php if (atlas_opt('instagram')) : ?><a href="<?php echo esc_url(atlas_opt('instagram')); ?>" aria-label="Instagram" target="_blank" rel="noopener"><svg><use href="#i-ig"/></svg></a><?php endif; ?>
          <a href="https://wa.me/<?php echo esc_attr(atlas_wa()); ?>" aria-label="WhatsApp"><svg><use href="#i-wa"/></svg></a>
        </div>
        </div>
      </div>
    </div>
  </header>

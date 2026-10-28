<?php if (!defined('ABSPATH')) exit; ?>
  <section class="call2">
    <div class="call2_photo photo-placeholder<?php echo atlas_photo_class('cta-photo-accueil-du-centre-atlas'); ?>"<?php echo atlas_photo_attr('cta-photo-accueil-du-centre-atlas', 'Photo : accueil du Centre Atlas'); ?>><?php atlas_photo_label('cta-photo-accueil-du-centre-atlas', 'Photo : accueil du Centre Atlas'); ?></div>
    <div class="call2_shape"></div>
    <div class="padding-global call2_inner">
      <div class="container-large">
        <div class="call2_card">
          <span class="call2_icon"><svg><use href="#i-calendar"/></svg></span>
          <h2 class="heading-style-h2"><?php atlas_t('tc4465117'); ?></h2>
          <p class="text-style-muted"><?php atlas_t('ta8f106d2'); ?></p>
          <a href="tel:<?php echo esc_attr(atlas_tel('tel_fixe')); ?>" class="call2_phone"><svg><use href="#i-phone"/></svg><?php atlas_t('t83ca4101'); ?></a>
          <div class="button-group"><a href="<?php echo esc_url(home_url('/rendez-vous/')); ?>" class="button is-primary"><?php atlas_t('tda31472f'); ?></a><a href="https://wa.me/<?php echo esc_attr(atlas_wa()); ?>" class="button is-whatsapp"><?php atlas_t('tc6aaa3de'); ?></a></div>
        </div>
      </div>
    </div>
  </section>

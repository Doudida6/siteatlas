<?php get_header(); ?>

  <section class="banner_component">
    <div class="padding-global"><div class="container-large banner_container">
      <h1 class="heading-style-h1" style="font-size:clamp(2rem,4vw,3.2rem)"><?php atlas_t('tbbaff128'); ?></h1>
      <div class="breadcrumb"><a href="<?php echo esc_url(home_url('/')); ?>"><?php atlas_t('t74fe31b5'); ?></a><span>›</span><span><?php atlas_t('tbbaff128'); ?></span></div>
    </div></div>
  </section>

  <section class="padding-section-large">
    <div class="padding-global"><div class="container-large contact_grid">
      <div>
        <span class="text-style-eyebrow"><?php atlas_t('tc552303a'); ?></span>
        <h2 class="heading-style-h2"><?php atlas_t('tffc10c57'); ?></h2>
        <div class="contact_cards">
          <div class="contact_card"><span class="value_icon"><svg viewBox="0 0 24 24"><use href="#i-pin"/></svg></span><div><small><?php atlas_t('t50d46c2f'); ?></small>Centre Médical Atlas, <?php echo esc_html(atlas_addr()); ?></div></div>
          <div class="contact_card"><span class="value_icon"><svg viewBox="0 0 24 24"><use href="#i-phone"/></svg></span><div><small><?php atlas_t('t301dc874'); ?></small><a href="tel:<?php echo esc_attr(atlas_tel('tel_fixe')); ?>"><?php atlas_t('t83ca4101'); ?></a> · <a href="tel:<?php echo esc_attr(atlas_tel('tel_mobile')); ?>"><?php atlas_t('t3046a572'); ?></a></div></div>
          <div class="contact_card"><span class="value_icon"><svg viewBox="0 0 24 24"><use href="#i-chat"/></svg></span><div><small><?php atlas_t('ta57fd34d'); ?></small><a href="mailto:<?php echo esc_attr(atlas_opt('email')); ?>"><?php atlas_t('t12a6d4d0'); ?></a></div></div>
          <div class="contact_card"><span class="value_icon"><svg viewBox="0 0 24 24"><use href="#i-calendar"/></svg></span><div><small><?php atlas_t('t990e1f56'); ?></small><span class="hours"><?php echo atlas_hours(); ?></span></div></div>
        </div>
        <div class="button-group">
          <a href="tel:<?php echo esc_attr(atlas_tel('tel_mobile')); ?>" class="button is-primary"><?php atlas_t('t55c40bf7'); ?></a>
          <a href="https://wa.me/<?php echo esc_attr(atlas_wa()); ?>" class="button is-whatsapp"><?php atlas_t('t8b777ebc'); ?></a>
          <a href="<?php echo esc_url('https://www.google.com/maps/dir/?api=1&destination=' . rawurlencode(atlas_map_query())); ?>" class="button is-secondary" target="_blank" rel="noopener"><?php atlas_t('t11e6a39b'); ?></a>
        </div>
      </div>
      <div class="form_card">
        <form method="post" action="<?php echo esc_url(admin_url('admin-post.php')); ?>" class="form_grid"<?php echo atlas_sent_hidden(); ?>><input type="hidden" name="action" value="atlas_form"><input type="hidden" name="form_type" value="Message de contact"><?php wp_nonce_field('atlas_form', 'atlas_nonce'); ?><input type="text" name="website" class="hp" tabindex="-1" autocomplete="off" aria-hidden="true">
          <div class="form_field is-full"><label for="c-nom"><?php atlas_t('t46eb4bf5'); ?></label><input class="form_input" id="c-nom" name="c-nom" required autocomplete="name"></div>
          <div class="form_field"><label for="c-tel"><?php atlas_t('t301dc874'); ?></label><input class="form_input" id="c-tel" name="c-tel" type="tel" autocomplete="tel"></div>
          <div class="form_field"><label for="c-email"><?php atlas_t('tce8ae9da'); ?></label><input class="form_input" id="c-email" name="c-email" type="email" autocomplete="email"></div>
          <div class="form_field is-full"><label for="c-msg"><?php atlas_t('t4c2a8fe7'); ?></label><textarea class="form_input" id="c-msg" name="c-msg" required></textarea></div>
          <div class="form_field is-full"><button type="submit" class="button is-primary" style="justify-content:center"><?php atlas_t('ta627d7c0'); ?></button></div>
        </form>
        <div class="form_success<?php echo atlas_sent_class(); ?>" role="status"><span class="value_icon"><svg viewBox="0 0 24 24"><path d="M5 12.5l4.5 4.5L19 7.5"/></svg></span><h3 class="heading-style-h4"><?php atlas_t('t2ac9db98'); ?></h3><p class="text-style-muted"><?php atlas_t('t5767f134'); ?></p></div>
      </div>
    </div></div>
  </section>
  <section class="padding-section-medium" style="padding-top:0">
    <div class="padding-global"><div class="container-large">
      <!-- Carte : remplacer "Dakar" par l'adresse exacte du centre -->
      <iframe class="map_frame" title="Carte du Centre Médical Atlas" loading="lazy" src="<?php echo esc_url('https://www.google.com/maps?q=' . rawurlencode(atlas_map_query()) . '&output=embed'); ?>"></iframe>
    </div></div>
  </section>

<?php get_footer(); ?>

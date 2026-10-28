<?php get_header(); ?>

  <section class="banner_component">
    <div class="padding-global"><div class="container-large banner_container">
      <h1 class="heading-style-h1" style="font-size:clamp(2rem,4vw,3.2rem)"><?php atlas_t('tda31472f'); ?></h1>
      <div class="breadcrumb"><a href="<?php echo esc_url(home_url('/')); ?>"><?php atlas_t('t74fe31b5'); ?></a><span>›</span><span><?php atlas_t('tda31472f'); ?></span></div>
    </div></div>
  </section>

  <section class="padding-section-large background-color-light">
    <div class="padding-global"><div class="container-large" style="max-width:820px">
      <div class="text-align-center margin-bottom-large">
        <span class="text-style-eyebrow"><?php atlas_t('ta90546cf'); ?></span>
        <h2 class="heading-style-h2"><?php atlas_t('t33765310'); ?></h2>
        <p class="text-style-muted text-size-medium" style="margin-top:1rem"><?php atlas_t('t1d46b1f2'); ?></p>
      </div>
      <div class="form_card">
        <form method="post" action="<?php echo esc_url(admin_url('admin-post.php')); ?>" class="form_grid"<?php echo atlas_sent_hidden(); ?>><input type="hidden" name="action" value="atlas_form"><input type="hidden" name="form_type" value="Demande de rendez-vous"><?php wp_nonce_field('atlas_form', 'atlas_nonce'); ?><input type="text" name="website" class="hp" tabindex="-1" autocomplete="off" aria-hidden="true">
          <div class="form_field is-full"><label for="nom"><?php atlas_t('t46eb4bf5'); ?></label><input class="form_input" id="nom" name="nom" required autocomplete="name"></div>
          <div class="form_field"><label for="tel"><?php atlas_t('t301dc874'); ?></label><input class="form_input" id="tel" name="tel" type="tel" required autocomplete="tel"></div>
          <div class="form_field"><label for="email"><?php atlas_t('tce8ae9da'); ?> <span><?php atlas_t('t092fbd67'); ?></span></label><input class="form_input" id="email" name="email" type="email" autocomplete="email"></div>
          <div class="form_field"><label for="type"><?php atlas_t('t70e2d9aa'); ?></label><select class="form_input" id="type" name="type" required><option value="">Choisir…</option><option>Consultation</option><option>Échographie</option><option>Radiographie</option><option disabled>Scanner (bientôt disponible)</option><option>Endoscopie</option><option>Biopsie</option><option>Autre</option></select></div>
          <div class="form_field"><label for="medecin"><?php atlas_t('t0d82b5e0'); ?></label><select class="form_input" id="medecin" name="medecin"><?php atlas_medecin_options(); ?></select></div>
          <div class="form_field is-full"><label for="date"><?php atlas_t('t446ff7f0'); ?></label><input class="form_input" id="date" name="date" type="date"></div>
          <div class="form_field is-full"><label for="message"><?php atlas_t('t4c2a8fe7'); ?> <span><?php atlas_t('t092fbd67'); ?></span></label><textarea class="form_input" id="message" name="message"></textarea></div>
          <div class="form_field is-full"><button type="submit" class="button is-primary" style="justify-content:center"><?php atlas_t('ta5ed6ce0'); ?></button>
            <p class="form_disclaimer"><?php atlas_t('t5c2f1898'); ?></p></div>
        </form>
        <div class="form_success<?php echo atlas_sent_class(); ?>" role="status"><span class="value_icon"><svg viewBox="0 0 24 24"><path d="M5 12.5l4.5 4.5L19 7.5"/></svg></span><h3 class="heading-style-h4"><?php atlas_t('tef6bc2b7'); ?></h3><p class="text-style-muted"><?php atlas_t('t7023ff4a'); ?></p></div>
      </div>
      <p class="text-align-center text-style-muted" style="margin-top:2rem"><?php atlas_t('t6b01b773'); ?> <a class="text-color-accent" href="tel:<?php echo esc_attr(atlas_tel('tel_fixe')); ?>"><strong><?php atlas_t('t83ca4101'); ?></strong></a> <?php atlas_t('t221f3f5f'); ?> <a class="text-color-accent" href="https://wa.me/<?php echo esc_attr(atlas_wa()); ?>"><strong><?php atlas_t('t8b777ebc'); ?></strong></a>.</p>
    </div></div>
  </section>

<?php get_footer(); ?>

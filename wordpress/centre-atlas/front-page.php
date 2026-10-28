<?php get_header(); ?>

  <!-- ===== Hero ===== -->
  <section class="hero2">
    <div class="hero2_photo photo-placeholder is-dark<?php echo atlas_photo_class('accueil-photo-accueil-espace-architectural-du-ce'); ?>"<?php echo atlas_photo_attr('accueil-photo-accueil-espace-architectural-du-ce', 'Photo : accueil / espace architectural du Centre Atlas'); ?>><?php atlas_photo_label('accueil-photo-accueil-espace-architectural-du-ce', 'Photo : accueil / espace architectural du Centre Atlas'); ?></div>
    <div class="hero2_shape"></div>
    <a href="<?php echo esc_url(home_url('/le-centre/')); ?>" class="hero2_play" aria-label="Découvrir le centre"><svg fill="currentColor" stroke="none"><use href="#i-play"/></svg></a>
    <div class="padding-global hero2_inner">
      <div class="container-large">
        <div class="hero2_card">
          <h1 class="heading-style-h1"><?php atlas_t('t96e86b77'); ?></h1>
          <p class="text-size-medium"><strong><?php atlas_t('t11418554'); ?></strong> <?php atlas_t('t0d86eeca'); ?></p>
          <div class="button-group">
            <a href="<?php echo esc_url(home_url('/rendez-vous/')); ?>" class="button is-primary"><?php atlas_t('tda31472f'); ?></a>
            <a href="<?php echo esc_url(home_url('/le-centre/')); ?>" class="button is-dark"><?php atlas_t('t982f9591'); ?></a>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- ===== Accès rapide ===== -->
  <section class="quick2">
    <div class="padding-global">
      <div class="container-large quick2_grid">
        <a href="<?php echo esc_url(home_url('/nos-medecins/')); ?>" class="quick2_card reveal">
          <svg class="quick2_icon"><use href="#i-calendar"/></svg>
          <h3 class="heading-style-h4"><?php atlas_t('ta1fa080d'); ?></h3>
          <p class="text-size-small"><?php atlas_t('t27ea0fb7'); ?></p>
          <span class="quick2_link"><?php atlas_t('t87da0b59'); ?> <svg width="16" height="16"><use href="#i-arrow"/></svg></span>
        </a>
        <a href="tel:<?php echo esc_attr(atlas_tel('tel_mobile')); ?>" class="quick2_card is-dark reveal">
          <svg class="quick2_icon"><use href="#i-phone"/></svg>
          <h3 class="heading-style-h4"><?php atlas_t('t41955e6f'); ?></h3>
          <p class="text-size-small"><?php atlas_t('tb78dd5da'); ?></p>
          <span class="quick2_pill"><?php atlas_t('t3046a572'); ?></span>
        </a>
        <a href="<?php echo esc_url(home_url('/rendez-vous/')); ?>" class="quick2_card is-accent reveal">
          <svg class="quick2_icon"><use href="#i-chat"/></svg>
          <h3 class="heading-style-h4"><?php atlas_t('t7eda0bd5'); ?></h3>
          <p class="text-size-small"><?php atlas_t('t88912c31'); ?></p>
          <span class="quick2_link"><?php atlas_t('t7c7fd123'); ?> <svg width="16" height="16"><use href="#i-arrow"/></svg></span>
        </a>
      </div>
    </div>
  </section>

  <!-- ===== À propos ===== -->
  <section class="padding-section-large">
    <div class="padding-global">
      <div class="container-large about_grid">
        <div class="collage reveal">
          <div class="collage_main photo-placeholder<?php echo atlas_photo_class('accueil-photo-reception-salle-d-attente-atlas'); ?>"<?php echo atlas_photo_attr('accueil-photo-reception-salle-d-attente-atlas', 'Photo : réception / salle d\'attente Atlas'); ?>><?php atlas_photo_label('accueil-photo-reception-salle-d-attente-atlas', 'Photo : réception / salle d\'attente Atlas'); ?></div>
          <div class="collage_small photo-placeholder<?php echo atlas_photo_class('accueil-photo-equipe'); ?>"<?php echo atlas_photo_attr('accueil-photo-equipe', 'Photo : équipe'); ?>><?php atlas_photo_label('accueil-photo-equipe', 'Photo : équipe'); ?></div>
        </div>
        <div class="about_content reveal">
          <span class="eyebrow2"><?php atlas_t('t28fe14a2'); ?></span>
          <h2 class="heading-style-h2"><?php atlas_t('tda65f0d1'); ?></h2>
          <p class="text-style-muted"><?php atlas_t('tfb53ebbf'); ?></p>
          <div class="feat_grid">
            <div class="feat"><svg class="feat_icon"><use href="#i-heart"/></svg><div><strong><?php atlas_t('t3ba2ef8c'); ?></strong><p class="text-size-small text-style-muted"><?php atlas_t('tc4d7dff9'); ?></p></div></div>
            <div class="feat"><svg class="feat_icon"><use href="#i-stetho"/></svg><div><strong><?php atlas_t('t57b0eaaf'); ?></strong><p class="text-size-small text-style-muted"><?php atlas_t('t69c825dc'); ?></p></div></div>
            <div class="feat"><svg class="feat_icon"><use href="#i-shield"/></svg><div><strong><?php atlas_t('t3db25c95'); ?></strong><p class="text-size-small text-style-muted"><?php atlas_t('t5d4e59d9'); ?></p></div></div>
            <div class="feat"><svg class="feat_icon"><use href="#i-bulb"/></svg><div><strong><?php atlas_t('t32f28a2c'); ?></strong><p class="text-size-small text-style-muted"><?php atlas_t('tdcb52705'); ?></p></div></div>
          </div>
          <ul class="check2">
            <li><?php atlas_t('t188bdb39'); ?></li>
            <li><?php atlas_t('t62c6fd0b'); ?></li>
            <li><?php atlas_t('ta54c9cda'); ?></li>
          </ul>
          <div><a href="<?php echo esc_url(home_url('/le-centre/')); ?>" class="button is-primary"><?php atlas_t('t8a50c4f5'); ?></a></div>
        </div>
      </div>
    </div>
  </section>

  <!-- ===== Services ===== -->
  <section class="padding-section-large background-color-tint">
    <div class="padding-global">
      <div class="container-large">
        <div class="text-align-center max-width-medium margin-auto margin-bottom-large">
          <span class="eyebrow2"><?php atlas_t('t4e66ec9a'); ?></span>
          <h2 class="heading-style-h2"><?php atlas_t('t2abaea39'); ?></h2>
          <p class="text-style-muted" style="margin-top:.8rem"><?php atlas_t('tc69ca3b3'); ?></p>
        </div>
        <div class="svc_grid">
          <a href="<?php echo esc_url(home_url('/specialites/')); ?>" class="svc_card reveal"><svg class="svc_icon"><use href="#i-stetho"/></svg><h3 class="heading-style-h4"><?php atlas_t('te64629de'); ?></h3><p class="text-size-small"><?php atlas_t('te7807a1a'); ?></p><span class="svc_link"><?php atlas_t('tcec0cd69'); ?> <svg width="14" height="14"><use href="#i-arrow"/></svg></span></a>
          <a href="<?php echo esc_url(home_url('/imagerie/')); ?>" class="svc_card reveal"><svg class="svc_icon"><use href="#i-scan"/></svg><h3 class="heading-style-h4"><?php atlas_t('t70e91475'); ?></h3><p class="text-size-small"><?php atlas_t('t79767f0b'); ?></p><span class="svc_link"><?php atlas_t('tcec0cd69'); ?> <svg width="14" height="14"><use href="#i-arrow"/></svg></span></a>
          <a href="<?php echo esc_url(home_url('/biologie/')); ?>" class="svc_card reveal"><svg class="svc_icon"><use href="#i-target"/></svg><h3 class="heading-style-h4"><?php atlas_t('t2785781c'); ?></h3><p class="text-size-small"><?php atlas_t('t32d84ba5'); ?></p><span class="svc_link"><?php atlas_t('tcec0cd69'); ?> <svg width="14" height="14"><use href="#i-arrow"/></svg></span></a>
          <a href="<?php echo esc_url(home_url('/endoscopie/')); ?>" class="svc_card reveal"><svg class="svc_icon"><use href="#i-tube"/></svg><h3 class="heading-style-h4"><?php atlas_t('te8e111ee'); ?></h3><p class="text-size-small"><?php atlas_t('t649e3a7b'); ?></p><span class="svc_link"><?php atlas_t('tcec0cd69'); ?> <svg width="14" height="14"><use href="#i-arrow"/></svg></span></a>
          <a href="<?php echo esc_url(home_url('/biopsie/')); ?>" class="svc_card is-dark reveal"><svg class="svc_icon"><use href="#i-target"/></svg><h3 class="heading-style-h4"><?php atlas_t('tc09a8fd2'); ?></h3><p class="text-size-small"><?php atlas_t('t5347da47'); ?></p><span class="svc_link"><?php atlas_t('tcec0cd69'); ?> <svg width="14" height="14"><use href="#i-arrow"/></svg></span></a>
          <a href="<?php echo esc_url(home_url('/imagerie/')); ?>#scanner" class="svc_card reveal"><svg class="svc_icon"><use href="#i-scan"/></svg><h3 class="heading-style-h4"><?php atlas_t('t948505fb'); ?></h3><p class="text-size-small"><?php atlas_t('t8f4a2087'); ?></p><span class="svc_link"><?php atlas_t('te78645cc'); ?> <svg width="14" height="14"><use href="#i-clock"/></svg></span></a>
        </div>
        <div class="chips_row">
          <strong><?php atlas_t('tc401b0ca'); ?></strong>
          <a href="<?php echo esc_url(home_url('/specialites-medecine-generale/')); ?>" class="chip2"><?php atlas_t('t49b96814'); ?></a>
          <a href="<?php echo esc_url(home_url('/specialites-cardiologie/')); ?>" class="chip2"><?php atlas_t('t0641fc0a'); ?></a>
          <a href="<?php echo esc_url(home_url('/specialites-gynecologie/')); ?>" class="chip2"><?php atlas_t('tfa4c9926'); ?></a>
          <a href="<?php echo esc_url(home_url('/specialites-gastro-enterologie/')); ?>" class="chip2"><?php atlas_t('tc62a5df5'); ?></a>
          <a href="<?php echo esc_url(home_url('/specialites-diabetologie/')); ?>" class="chip2"><?php atlas_t('t0311621e'); ?></a>
          <a href="<?php echo esc_url(home_url('/specialites-rhumatologie/')); ?>" class="chip2"><?php atlas_t('td6bc365e'); ?></a>
        </div>
        <div class="strip">
          <svg class="strip_icon"><use href="#i-calendar"/></svg>
          <div><strong><?php atlas_t('t26ddc36b'); ?></strong><p class="text-size-small text-style-muted"><?php atlas_t('t0bdc8802'); ?></p></div>
          <a href="<?php echo esc_url(home_url('/rendez-vous/')); ?>" class="button is-primary"><?php atlas_t('tda31472f'); ?></a>
          <a href="<?php echo esc_url(home_url('/specialites/')); ?>" class="strip_link"><?php atlas_t('t61170408'); ?></a>
        </div>
      </div>
    </div>
  </section>

  <!-- ===== Comment ça se passe ===== -->
  <section class="padding-section-large">
    <div class="padding-global">
      <div class="container-large about_grid">
        <div class="reveal">
          <span class="eyebrow2"><?php atlas_t('t72703758'); ?></span>
          <h2 class="heading-style-h2 margin-bottom-medium"><?php atlas_t('tde6d9b19'); ?></h2>
          <p class="text-style-muted margin-bottom-medium"><?php atlas_t('tef55a034'); ?></p>
          <ol class="steps2">
            <li><span class="step_icon"><svg><use href="#i-calendar"/></svg></span><div><strong><?php atlas_t('td5b4dc2b'); ?></strong><p class="text-size-small text-style-muted"><?php atlas_t('t649b4159'); ?></p></div></li>
            <li><span class="step_icon"><svg><use href="#i-phone"/></svg></span><div><strong><?php atlas_t('t29d1f91e'); ?></strong><p class="text-size-small text-style-muted"><?php atlas_t('tfe84ae5d'); ?></p></div></li>
            <li><span class="step_icon"><svg><use href="#i-stetho"/></svg></span><div><strong><?php atlas_t('t5d59c22e'); ?></strong><p class="text-size-small text-style-muted"><?php atlas_t('t4744294e'); ?></p></div></li>
            <li><span class="step_icon"><svg><use href="#i-check"/></svg></span><div><strong><?php atlas_t('t3d0480e4'); ?></strong><p class="text-size-small text-style-muted"><?php atlas_t('t168dfcf4'); ?></p></div></li>
          </ol>
        </div>
        <div class="collage is-right reveal">
          <div class="collage_main photo-placeholder<?php echo atlas_photo_class('accueil-photo-cabinet-de-consultation'); ?>"<?php echo atlas_photo_attr('accueil-photo-cabinet-de-consultation', 'Photo : cabinet de consultation'); ?>><?php atlas_photo_label('accueil-photo-cabinet-de-consultation', 'Photo : cabinet de consultation'); ?></div>
          <div class="collage_small photo-placeholder<?php echo atlas_photo_class('accueil-photo-echographie'); ?>"<?php echo atlas_photo_attr('accueil-photo-echographie', 'Photo : échographie'); ?>><?php atlas_photo_label('accueil-photo-echographie', 'Photo : échographie'); ?></div>
        </div>
      </div>
    </div>
  </section>

  <!-- ===== Pourquoi Atlas ===== -->
  <section class="trust2">
    <div class="padding-global">
      <div class="container-large trust2_grid">
        <div class="reveal">
          <span class="eyebrow2"><?php atlas_t('te740fe3a'); ?></span>
          <h2 class="heading-style-h2"><?php atlas_t('t718562c0'); ?></h2>
          <p style="color:#cfd5da;margin:1rem 0 1.5rem"><?php atlas_t('teaeffb24'); ?></p>
          <a href="<?php echo esc_url(home_url('/le-centre/')); ?>" class="button is-primary"><?php atlas_t('t982f9591'); ?></a>
        </div>
        <div class="trust2_cards">
          <div class="trust2_card is-light reveal"><svg><use href="#i-users"/></svg><strong><?php atlas_t('t26dded54'); ?></strong><span><?php atlas_t('t69c825dc'); ?></span></div>
          <div class="trust2_card reveal"><svg><use href="#i-scan"/></svg><strong><?php atlas_t('tbff775e6'); ?></strong><span><?php atlas_t('td888a5ca'); ?></span></div>
          <div class="trust2_card reveal"><svg><use href="#i-target"/></svg><strong><?php atlas_t('tb215e10a'); ?></strong><span><?php atlas_t('t4c898ae9'); ?></span></div>
          <div class="trust2_card is-accent reveal"><svg><use href="#i-heart"/></svg><strong><?php atlas_t('t33548224'); ?></strong><span><?php atlas_t('ta8078ca5'); ?></span></div>
        </div>
      </div>
    </div>
  </section>

  <!-- ===== Rendez-vous ===== -->
  <section class="apt">
    <div class="padding-global">
      <div class="container-large">
        <div class="apt_card reveal">
          <div class="apt_side photo-placeholder is-dark<?php echo atlas_photo_class('accueil-apt-side'); ?>"<?php echo atlas_photo_attr('accueil-apt-side', ""); ?>>
            <div class="apt_side-text"><span class="apt_side-icon"><svg><use href="#i-calendar"/></svg></span><h2 class="heading-style-h2"><?php atlas_t('t221f7a31'); ?></h2><p><?php atlas_t('t3d835516'); ?></p></div>
          </div>
          <div class="apt_form">
            <form method="post" action="<?php echo esc_url(admin_url('admin-post.php')); ?>" class="form_grid"<?php echo atlas_sent_hidden(); ?>><input type="hidden" name="action" value="atlas_form"><input type="hidden" name="form_type" value="Demande de rendez-vous (accueil)"><?php wp_nonce_field('atlas_form', 'atlas_nonce'); ?><input type="text" name="website" class="hp" tabindex="-1" autocomplete="off" aria-hidden="true">
              <div class="form_field"><label for="h-nom"><?php atlas_t('t46eb4bf5'); ?></label><input class="form_input" id="h-nom" name="h-nom" required autocomplete="name"></div>
              <div class="form_field"><label for="h-tel"><?php atlas_t('t301dc874'); ?></label><input class="form_input" id="h-tel" name="h-tel" type="tel" required autocomplete="tel"></div>
              <div class="form_field"><label for="h-type"><?php atlas_t('t70e2d9aa'); ?></label><select class="form_input" id="h-type" name="h-type" required><option value="">Choisir…</option><option>Consultation</option><option>Échographie</option><option>Radiographie</option><option disabled>Scanner (bientôt disponible)</option><option>Endoscopie</option><option>Biopsie</option><option>Biologie (analyses)</option><option>Autre</option></select></div>
              <div class="form_field"><label for="h-date"><?php atlas_t('t446ff7f0'); ?></label><input class="form_input" id="h-date" name="h-date" type="date"></div>
              <div class="form_field is-full"><label for="h-msg"><?php atlas_t('t4c2a8fe7'); ?> <span><?php atlas_t('t092fbd67'); ?></span></label><textarea class="form_input" id="h-msg" name="h-msg" style="min-height:90px"></textarea></div>
              <div class="form_field is-full"><button type="submit" class="button is-primary" style="justify-self:start"><?php atlas_t('ta5ed6ce0'); ?></button></div>
            </form>
            <div class="form_success<?php echo atlas_sent_class(); ?>" role="status"><span class="value_icon"><svg viewBox="0 0 24 24"><use href="#i-check"/></svg></span><h3 class="heading-style-h4"><?php atlas_t('tef6bc2b7'); ?></h3><p class="text-style-muted"><?php atlas_t('t7023ff4a'); ?></p></div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- ===== Équipe ===== -->
  <section class="padding-section-large">
    <div class="padding-global">
      <div class="container-large">
        <div class="text-align-center max-width-medium margin-auto margin-bottom-large">
          <span class="eyebrow2"><?php atlas_t('t75ccefd9'); ?></span>
          <h2 class="heading-style-h2"><?php atlas_t('tddf1a701'); ?></h2>
        </div>
        <div class="team_grid">
<?php atlas_team_cards(3); ?>
</div>
        <div class="text-align-center" style="margin-top:2.5rem"><a href="<?php echo esc_url(home_url('/nos-medecins/')); ?>" class="button is-dark"><?php atlas_t('t673f4a26'); ?></a></div>
      </div>
    </div>
  </section>

  <!-- ===== Témoignage (emplacement) ===== -->
  <section class="quote2">
    <div class="padding-global">
      <div class="container-large quote2_inner reveal">
        <svg class="quote2_mark" fill="currentColor" stroke="none"><use href="#i-quote"/></svg>
        <span class="eyebrow2"><?php atlas_t('t8cc8053a'); ?></span>
        <h2 class="heading-style-h2"><?php atlas_t('t4be0e41c'); ?></h2>
        <!-- Emplacement : remplacer par un vrai témoignage, publié avec l'accord du patient -->
        <p class="quote2_text"><?php atlas_t('t9945f676'); ?></p>
        <div class="quote2_author"><span class="quote2_avatar photo-placeholder<?php echo atlas_photo_class('accueil-quote2-avatar'); ?>"<?php echo atlas_photo_attr('accueil-quote2-avatar', ''); ?>></span><strong><?php atlas_t('tfb94663a'); ?></strong></div>
      </div>
    </div>
  </section>

  <!-- ===== Conseils santé ===== -->
  <section class="padding-section-large">
    <div class="padding-global">
      <div class="container-large">
        <div class="text-align-center max-width-medium margin-auto margin-bottom-large">
          <span class="eyebrow2"><?php atlas_t('t59fcfbf5'); ?></span>
          <h2 class="heading-style-h2"><?php atlas_t('t523e81a5'); ?></h2>
        </div>
        <div class="blog_grid">
<?php $q = new WP_Query(['posts_per_page' => 3, 'ignore_sticky_posts' => true]); while ($q->have_posts()) : $q->the_post(); ?>
<a href="<?php the_permalink(); ?>" class="blog_card reveal"><?php atlas_thumb(); ?><div class="blog_card-body"><div class="blog_meta"><span class="chip"><?php echo esc_html(atlas_cat_name()); ?></span><span><?php echo esc_html(get_the_date('j F Y')); ?></span></div><h3 class="heading-style-h4"><?php the_title(); ?></h3><span class="quick_link text-color-accent"><?php atlas_t('t42ada6a3'); ?> <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2"><use href="#i-arrow"/></svg></span></div></a>
<?php endwhile; wp_reset_postdata(); ?>
</div>
      </div>
    </div>
  </section>

  <!-- ===== Appel à l'action ===== -->
<?php get_template_part('parts/cta'); ?>

<?php get_footer(); ?>

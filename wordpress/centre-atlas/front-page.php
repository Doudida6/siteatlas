<?php get_header(); ?>

  <!-- ===== Hero ===== -->
  <section class="hero2">
    <div class="hero2_photo photo-placeholder is-dark">Photo : accueil / espace architectural du Centre Atlas</div>
    <div class="hero2_shape"></div>
    <a href="<?php echo esc_url(home_url('/le-centre/')); ?>" class="hero2_play" aria-label="Découvrir le centre"><svg fill="currentColor" stroke="none"><use href="#i-play"/></svg></a>
    <div class="padding-global hero2_inner">
      <div class="container-large">
        <div class="hero2_card">
          <h1 class="heading-style-h1">Centre Médical Atlas</h1>
          <p class="text-size-medium"><strong>Médecine, imagerie et explorations médicales au même endroit.</strong> Une prise en charge moderne, humaine et coordonnée à Dakar.</p>
          <div class="button-group">
            <a href="<?php echo esc_url(home_url('/rendez-vous/')); ?>" class="button is-primary">Prendre rendez-vous</a>
            <a href="<?php echo esc_url(home_url('/le-centre/')); ?>" class="button is-dark">Découvrir le centre</a>
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
          <h3 class="heading-style-h4">Jours de consultation</h3>
          <p class="text-size-small">Retrouvez les jours de présence de chaque médecin de l'équipe.</p>
          <span class="quick2_link">Voir l'équipe <svg width="16" height="16"><use href="#i-arrow"/></svg></span>
        </a>
        <a href="tel:+221338678646" class="quick2_card is-dark reveal">
          <svg class="quick2_icon"><use href="#i-phone"/></svg>
          <h3 class="heading-style-h4">Nous appeler</h3>
          <p class="text-size-small">Secrétariat : 33 867 86 46<br>Mobile / WhatsApp : 78 831 60 60</p>
          <span class="quick2_pill">33 867 86 46</span>
        </a>
        <a href="<?php echo esc_url(home_url('/rendez-vous/')); ?>" class="quick2_card is-accent reveal">
          <svg class="quick2_icon"><use href="#i-chat"/></svg>
          <h3 class="heading-style-h4">Demander un rendez-vous</h3>
          <p class="text-size-small">Un formulaire simple. Notre équipe vous rappelle pour confirmer le créneau.</p>
          <span class="quick2_link">Faire une demande <svg width="16" height="16"><use href="#i-arrow"/></svg></span>
        </a>
      </div>
    </div>
  </section>

  <!-- ===== À propos ===== -->
  <section class="padding-section-large">
    <div class="padding-global">
      <div class="container-large about_grid">
        <div class="collage reveal">
          <div class="collage_main photo-placeholder">Photo : réception / salle d'attente Atlas</div>
          <div class="collage_small photo-placeholder">Photo : équipe</div>
        </div>
        <div class="about_content reveal">
          <span class="eyebrow2">À propos d'Atlas</span>
          <h2 class="heading-style-h2">Un centre pensé autour du patient</h2>
          <p class="text-style-muted">Le Centre Médical Atlas réunit plusieurs compétences médicales et explorations diagnostiques au sein d'un même environnement. Notre objectif est de proposer une prise en charge accessible, professionnelle et personnalisée, en accordant une attention particulière à l'écoute et au confort du patient.</p>
          <div class="feat_grid">
            <div class="feat"><svg class="feat_icon"><use href="#i-heart"/></svg><div><strong>Écoute</strong><p class="text-size-small text-style-muted">Chaque patient est entendu.</p></div></div>
            <div class="feat"><svg class="feat_icon"><use href="#i-stetho"/></svg><div><strong>Expertise</strong><p class="text-size-small text-style-muted">Une équipe pluridisciplinaire.</p></div></div>
            <div class="feat"><svg class="feat_icon"><use href="#i-shield"/></svg><div><strong>Confidentialité</strong><p class="text-size-small text-style-muted">Vos données sont protégées.</p></div></div>
            <div class="feat"><svg class="feat_icon"><use href="#i-bulb"/></svg><div><strong>Innovation</strong><p class="text-size-small text-style-muted">Un plateau technique moderne.</p></div></div>
          </div>
          <ul class="check2">
            <li>Consultations et examens au même endroit</li>
            <li>Des explications claires à chaque étape</li>
            <li>Un accompagnement du rendez-vous jusqu'aux résultats</li>
          </ul>
          <div><a href="<?php echo esc_url(home_url('/le-centre/')); ?>" class="button is-primary">Découvrir Atlas</a></div>
        </div>
      </div>
    </div>
  </section>

  <!-- ===== Services ===== -->
  <section class="padding-section-large background-color-tint">
    <div class="padding-global">
      <div class="container-large">
        <div class="text-align-center max-width-medium margin-auto margin-bottom-large">
          <span class="eyebrow2">Nos services</span>
          <h2 class="heading-style-h2">Consultations, imagerie et explorations</h2>
          <p class="text-style-muted" style="margin-top:.8rem">Tout votre parcours de soins, sous un même toit.</p>
        </div>
        <div class="svc_grid">
          <a href="<?php echo esc_url(home_url('/specialites/')); ?>" class="svc_card reveal"><svg class="svc_icon"><use href="#i-stetho"/></svg><h3 class="heading-style-h4">Consultations</h3><p class="text-size-small">Médecine générale et spécialités médicales.</p><span class="svc_link">En savoir plus <svg width="14" height="14"><use href="#i-arrow"/></svg></span></a>
          <a href="<?php echo esc_url(home_url('/imagerie/')); ?>" class="svc_card reveal"><svg class="svc_icon"><use href="#i-scan"/></svg><h3 class="heading-style-h4">Échographie &amp; Doppler</h3><p class="text-size-small">Des images pour explorer organes et vaisseaux.</p><span class="svc_link">En savoir plus <svg width="14" height="14"><use href="#i-arrow"/></svg></span></a>
          <a href="<?php echo esc_url(home_url('/imagerie/')); ?>" class="svc_card reveal"><svg class="svc_icon"><use href="#i-target"/></svg><h3 class="heading-style-h4">Radiographie numérique</h3><p class="text-size-small">Os, articulations et thorax, rapidement.</p><span class="svc_link">En savoir plus <svg width="14" height="14"><use href="#i-arrow"/></svg></span></a>
          <a href="<?php echo esc_url(home_url('/endoscopie/')); ?>" class="svc_card reveal"><svg class="svc_icon"><use href="#i-tube"/></svg><h3 class="heading-style-h4">Endoscopie digestive</h3><p class="text-size-small">Fibroscopie et coloscopie dans un environnement adapté.</p><span class="svc_link">En savoir plus <svg width="14" height="14"><use href="#i-arrow"/></svg></span></a>
          <a href="<?php echo esc_url(home_url('/biopsie/')); ?>" class="svc_card is-dark reveal"><svg class="svc_icon"><use href="#i-target"/></svg><h3 class="heading-style-h4">Biopsies guidées</h3><p class="text-size-small">Prélèvements guidés par l'imagerie, expliqués pas à pas.</p><span class="svc_link">En savoir plus <svg width="14" height="14"><use href="#i-arrow"/></svg></span></a>
          <a href="<?php echo esc_url(home_url('/imagerie/')); ?>#scanner" class="svc_card reveal"><svg class="svc_icon"><use href="#i-scan"/></svg><h3 class="heading-style-h4">Scanner</h3><p class="text-size-small">Prochainement disponible au Centre Atlas.</p><span class="svc_link">Bientôt <svg width="14" height="14"><use href="#i-clock"/></svg></span></a>
        </div>
        <div class="chips_row">
          <strong>Nos expertises médicales</strong>
          <a href="<?php echo esc_url(home_url('/specialites-medecine-generale/')); ?>" class="chip2">Médecine générale</a>
          <a href="<?php echo esc_url(home_url('/specialites-cardiologie/')); ?>" class="chip2">Cardiologie</a>
          <a href="<?php echo esc_url(home_url('/specialites-gynecologie/')); ?>" class="chip2">Gynécologie</a>
          <a href="<?php echo esc_url(home_url('/specialites-gastro-enterologie/')); ?>" class="chip2">Gastro-entérologie</a>
          <a href="<?php echo esc_url(home_url('/specialites-neurologie/')); ?>" class="chip2">Neurologie</a>
          <a href="<?php echo esc_url(home_url('/specialites-rhumatologie/')); ?>" class="chip2">Rhumatologie</a>
        </div>
        <div class="strip">
          <svg class="strip_icon"><use href="#i-calendar"/></svg>
          <div><strong>Ouvert sur rendez-vous</strong><p class="text-size-small text-style-muted">Notre équipe vous contacte pour confirmer votre créneau.</p></div>
          <a href="<?php echo esc_url(home_url('/rendez-vous/')); ?>" class="button is-primary">Prendre rendez-vous</a>
          <a href="<?php echo esc_url(home_url('/specialites/')); ?>" class="strip_link">Toutes les spécialités →</a>
        </div>
      </div>
    </div>
  </section>

  <!-- ===== Comment ça se passe ===== -->
  <section class="padding-section-large">
    <div class="padding-global">
      <div class="container-large about_grid">
        <div class="reveal">
          <span class="eyebrow2">Votre parcours</span>
          <h2 class="heading-style-h2 margin-bottom-medium">Un parcours simple, de la demande aux résultats</h2>
          <p class="text-style-muted margin-bottom-medium">Consultation et examens se font au même endroit. Vous savez toujours où vous en êtes.</p>
          <ol class="steps2">
            <li><span class="step_icon"><svg><use href="#i-calendar"/></svg></span><div><strong>Je demande un rendez-vous</strong><p class="text-size-small text-style-muted">Par le site, par téléphone ou sur WhatsApp.</p></div></li>
            <li><span class="step_icon"><svg><use href="#i-phone"/></svg></span><div><strong>L'équipe me rappelle</strong><p class="text-size-small text-style-muted">Pour confirmer le créneau et me donner les consignes.</p></div></li>
            <li><span class="step_icon"><svg><use href="#i-stetho"/></svg></span><div><strong>Je suis reçu(e) et examiné(e)</strong><p class="text-size-small text-style-muted">Consultation et examens sur place.</p></div></li>
            <li><span class="step_icon"><svg><use href="#i-check"/></svg></span><div><strong>Je comprends mes résultats</strong><p class="text-size-small text-style-muted">Le médecin m'explique et m'oriente.</p></div></li>
          </ol>
        </div>
        <div class="collage is-right reveal">
          <div class="collage_main photo-placeholder">Photo : cabinet de consultation</div>
          <div class="collage_small photo-placeholder">Photo : échographie</div>
        </div>
      </div>
    </div>
  </section>

  <!-- ===== Pourquoi Atlas ===== -->
  <section class="trust2">
    <div class="padding-global">
      <div class="container-large trust2_grid">
        <div class="reveal">
          <span class="eyebrow2">Pourquoi Atlas ?</span>
          <h2 class="heading-style-h2">Une équipe et un plateau technique à votre service</h2>
          <p style="color:#cfd5da;margin:1rem 0 1.5rem">La technologie et l'expertise sont visibles, mais toujours au service du patient.</p>
          <a href="<?php echo esc_url(home_url('/le-centre/')); ?>" class="button is-primary">Découvrir le centre</a>
        </div>
        <div class="trust2_cards">
          <div class="trust2_card is-light reveal"><svg><use href="#i-users"/></svg><strong>Expertise médicale</strong><span>Une équipe pluridisciplinaire.</span></div>
          <div class="trust2_card reveal"><svg><use href="#i-scan"/></svg><strong>Plateau technique moderne</strong><span>Des examens fiables, sur place.</span></div>
          <div class="trust2_card reveal"><svg><use href="#i-target"/></svg><strong>Parcours simplifié</strong><span>Consultations et explorations au même endroit.</span></div>
          <div class="trust2_card is-accent reveal"><svg><use href="#i-heart"/></svg><strong>Écoute et bienveillance</strong><span>Attention portée à chaque patient.</span></div>
        </div>
      </div>
    </div>
  </section>

  <!-- ===== Rendez-vous ===== -->
  <section class="apt">
    <div class="padding-global">
      <div class="container-large">
        <div class="apt_card reveal">
          <div class="apt_side photo-placeholder is-dark">
            <div class="apt_side-text"><span class="apt_side-icon"><svg><use href="#i-calendar"/></svg></span><h2 class="heading-style-h2">Prenez rendez-vous et prenez soin de votre santé</h2><p>Notre équipe vous contactera pour confirmer votre rendez-vous.</p></div>
          </div>
          <div class="apt_form">
            <form method="post" action="<?php echo esc_url(admin_url('admin-post.php')); ?>" class="form_grid"<?php echo atlas_sent_hidden(); ?>><input type="hidden" name="action" value="atlas_form"><input type="hidden" name="form_type" value="Demande de rendez-vous (accueil)"><?php wp_nonce_field('atlas_form', 'atlas_nonce'); ?><input type="text" name="website" class="hp" tabindex="-1" autocomplete="off" aria-hidden="true">
              <div class="form_field"><label for="h-nom">Nom et prénom</label><input class="form_input" id="h-nom" name="h-nom" required autocomplete="name"></div>
              <div class="form_field"><label for="h-tel">Téléphone</label><input class="form_input" id="h-tel" name="h-tel" type="tel" required autocomplete="tel"></div>
              <div class="form_field"><label for="h-type">Type de rendez-vous</label><select class="form_input" id="h-type" name="h-type" required><option value="">Choisir…</option><option>Consultation</option><option>Échographie</option><option>Radiographie</option><option disabled>Scanner (bientôt disponible)</option><option>Endoscopie</option><option>Biopsie</option><option>Autre</option></select></div>
              <div class="form_field"><label for="h-date">Date souhaitée</label><input class="form_input" id="h-date" name="h-date" type="date"></div>
              <div class="form_field is-full"><label for="h-msg">Message <span>(facultatif)</span></label><textarea class="form_input" id="h-msg" name="h-msg" style="min-height:90px"></textarea></div>
              <div class="form_field is-full"><button type="submit" class="button is-primary" style="justify-self:start">Envoyer ma demande</button></div>
            </form>
            <div class="form_success<?php echo atlas_sent_class(); ?>" role="status"><span class="value_icon"><svg viewBox="0 0 24 24"><use href="#i-check"/></svg></span><h3 class="heading-style-h4">Merci !</h3><p class="text-style-muted">Votre demande a bien été reçue. Notre équipe vous contactera pour confirmer votre rendez-vous.</p></div>
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
          <span class="eyebrow2">Équipe médicale</span>
          <h2 class="heading-style-h2">Rencontrez nos médecins</h2>
        </div>
        <div class="team_grid">
          <a href="<?php echo esc_url(home_url('/nos-medecins/')); ?>" class="team_card reveal"><div class="team_photo photo-placeholder">Portrait du médecin</div><div class="team_info"><div><small>Cardiologie</small>Dr. Prénom Nom</div><span class="team_arrow"><svg width="18" height="18" fill="none" stroke="#fff" stroke-width="2"><use href="#i-arrow"/></svg></span></div></a>
          <a href="<?php echo esc_url(home_url('/nos-medecins/')); ?>" class="team_card reveal"><div class="team_photo photo-placeholder">Portrait du médecin</div><div class="team_info"><div><small>Gastro-entérologie</small>Dr. Prénom Nom</div><span class="team_arrow"><svg width="18" height="18" fill="none" stroke="#fff" stroke-width="2"><use href="#i-arrow"/></svg></span></div></a>
          <a href="<?php echo esc_url(home_url('/nos-medecins/')); ?>" class="team_card reveal"><div class="team_photo photo-placeholder">Portrait du médecin</div><div class="team_info"><div><small>Médecine générale</small>Dr. Prénom Nom</div><span class="team_arrow"><svg width="18" height="18" fill="none" stroke="#fff" stroke-width="2"><use href="#i-arrow"/></svg></span></div></a>
        </div>
        <div class="text-align-center" style="margin-top:2.5rem"><a href="<?php echo esc_url(home_url('/nos-medecins/')); ?>" class="button is-dark">Voir toute l'équipe</a></div>
      </div>
    </div>
  </section>

  <!-- ===== Témoignage (emplacement) ===== -->
  <section class="quote2">
    <div class="padding-global">
      <div class="container-large quote2_inner reveal">
        <svg class="quote2_mark" fill="currentColor" stroke="none"><use href="#i-quote"/></svg>
        <span class="eyebrow2">Témoignages</span>
        <h2 class="heading-style-h2">Ce que disent nos patients</h2>
        <!-- Emplacement : remplacer par un vrai témoignage, publié avec l'accord du patient -->
        <p class="quote2_text">« Emplacement réservé au témoignage d'un patient, publié avec son accord. »</p>
        <div class="quote2_author"><span class="quote2_avatar photo-placeholder"></span><strong>Prénom N.</strong></div>
      </div>
    </div>
  </section>

  <!-- ===== Conseils santé ===== -->
  <section class="padding-section-large">
    <div class="padding-global">
      <div class="container-large">
        <div class="text-align-center max-width-medium margin-auto margin-bottom-large">
          <span class="eyebrow2">Conseils santé</span>
          <h2 class="heading-style-h2">Derniers articles</h2>
        </div>
        <div class="blog_grid">
<?php $q = new WP_Query(['posts_per_page' => 3, 'ignore_sticky_posts' => true]); while ($q->have_posts()) : $q->the_post(); ?>
<a href="<?php the_permalink(); ?>" class="blog_card reveal"><?php atlas_thumb(); ?><div class="blog_card-body"><div class="blog_meta"><span class="chip"><?php echo esc_html(atlas_cat_name()); ?></span><span><?php echo esc_html(get_the_date('j F Y')); ?></span></div><h3 class="heading-style-h4"><?php the_title(); ?></h3><span class="quick_link text-color-accent">Lire l'article <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2"><use href="#i-arrow"/></svg></span></div></a>
<?php endwhile; wp_reset_postdata(); ?>
</div>
      </div>
    </div>
  </section>

  <!-- ===== Appel à l'action ===== -->
<?php get_template_part('parts/cta'); ?>

<?php get_footer(); ?>

<?php get_header(); ?>

  <section class="banner_component">
    <div class="padding-global"><div class="container-large banner_container">
      <h1 class="heading-style-h1" style="font-size:clamp(2rem,4vw,3.2rem)">Nos médecins</h1>
      <div class="breadcrumb"><a href="<?php echo esc_url(home_url('/')); ?>">Accueil</a><span>›</span><span>Nos médecins</span></div>
    </div></div>
  </section>

  <section class="padding-section-large">
    <div class="padding-global"><div class="container-large">
      <div class="text-align-center max-width-medium margin-auto margin-bottom-large">
        <span class="text-style-eyebrow">Équipe médicale</span>
        <h2 class="heading-style-h2">Une équipe à votre écoute</h2>
        <p class="text-style-muted text-size-medium" style="margin-top:1rem">Des médecins de plusieurs spécialités, réunis pour vous accompagner à chaque étape de votre parcours.</p>
      </div>
      <div class="doc_grid">
        <article class="doc_card reveal">
          <div class="doc_photo photo-placeholder">Portrait professionnel</div>
          <div class="doc_body">
            <div><small>Cardiologie</small><h3 class="heading-style-h4">Dr. Prénom Nom</h3></div>
            <div class="doc_meta">
              <span><strong>Formation :</strong> diplômes à compléter</span>
              <span><strong>Jours de consultation :</strong> à compléter</span>
            </div>
            <div class="chips"><span class="chip">Domaine d'expertise</span><span class="chip">Domaine d'expertise</span></div>
            <a href="<?php echo esc_url(home_url('/rendez-vous/')); ?>" class="button is-primary" style="justify-content:center">Prendre rendez-vous</a>
          </div>
        </article>
        <article class="doc_card reveal">
          <div class="doc_photo photo-placeholder">Portrait professionnel</div>
          <div class="doc_body">
            <div><small>Gastro-entérologie</small><h3 class="heading-style-h4">Dr. Prénom Nom</h3></div>
            <div class="doc_meta">
              <span><strong>Formation :</strong> diplômes à compléter</span>
              <span><strong>Jours de consultation :</strong> à compléter</span>
            </div>
            <div class="chips"><span class="chip">Domaine d'expertise</span><span class="chip">Domaine d'expertise</span></div>
            <a href="<?php echo esc_url(home_url('/rendez-vous/')); ?>" class="button is-primary" style="justify-content:center">Prendre rendez-vous</a>
          </div>
        </article>
        <article class="doc_card reveal">
          <div class="doc_photo photo-placeholder">Portrait professionnel</div>
          <div class="doc_body">
            <div><small>Médecine générale</small><h3 class="heading-style-h4">Dr. Prénom Nom</h3></div>
            <div class="doc_meta">
              <span><strong>Formation :</strong> diplômes à compléter</span>
              <span><strong>Jours de consultation :</strong> à compléter</span>
            </div>
            <div class="chips"><span class="chip">Domaine d'expertise</span><span class="chip">Domaine d'expertise</span></div>
            <a href="<?php echo esc_url(home_url('/rendez-vous/')); ?>" class="button is-primary" style="justify-content:center">Prendre rendez-vous</a>
          </div>
        </article>
        <article class="doc_card reveal">
          <div class="doc_photo photo-placeholder">Portrait professionnel</div>
          <div class="doc_body">
            <div><small>Gynécologie</small><h3 class="heading-style-h4">Dr. Prénom Nom</h3></div>
            <div class="doc_meta">
              <span><strong>Formation :</strong> diplômes à compléter</span>
              <span><strong>Jours de consultation :</strong> à compléter</span>
            </div>
            <div class="chips"><span class="chip">Domaine d'expertise</span><span class="chip">Domaine d'expertise</span></div>
            <a href="<?php echo esc_url(home_url('/rendez-vous/')); ?>" class="button is-primary" style="justify-content:center">Prendre rendez-vous</a>
          </div>
        </article>
        <article class="doc_card reveal">
          <div class="doc_photo photo-placeholder">Portrait professionnel</div>
          <div class="doc_body">
            <div><small>Neurologie</small><h3 class="heading-style-h4">Dr. Prénom Nom</h3></div>
            <div class="doc_meta">
              <span><strong>Formation :</strong> diplômes à compléter</span>
              <span><strong>Jours de consultation :</strong> à compléter</span>
            </div>
            <div class="chips"><span class="chip">Domaine d'expertise</span><span class="chip">Domaine d'expertise</span></div>
            <a href="<?php echo esc_url(home_url('/rendez-vous/')); ?>" class="button is-primary" style="justify-content:center">Prendre rendez-vous</a>
          </div>
        </article>
        <article class="doc_card reveal">
          <div class="doc_photo photo-placeholder">Portrait professionnel</div>
          <div class="doc_body">
            <div><small>Rhumatologie</small><h3 class="heading-style-h4">Dr. Prénom Nom</h3></div>
            <div class="doc_meta">
              <span><strong>Formation :</strong> diplômes à compléter</span>
              <span><strong>Jours de consultation :</strong> à compléter</span>
            </div>
            <div class="chips"><span class="chip">Domaine d'expertise</span><span class="chip">Domaine d'expertise</span></div>
            <a href="<?php echo esc_url(home_url('/rendez-vous/')); ?>" class="button is-primary" style="justify-content:center">Prendre rendez-vous</a>
          </div>
        </article>
      </div>
    </div></div>
  </section>
<?php get_template_part('parts/cta'); ?>

<?php get_footer(); ?>

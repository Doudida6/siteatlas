<?php get_header(); ?>

  <section class="banner_component">
    <div class="padding-global"><div class="container-large banner_container">
      <h1 class="heading-style-h1" style="font-size:clamp(2rem,4vw,3.2rem)">Imagerie médicale</h1>
      <div class="breadcrumb"><a href="<?php echo esc_url(home_url('/')); ?>">Accueil</a><span>›</span><span>Imagerie médicale</span></div>
    </div></div>
  </section>

  <!-- Contenu indicatif : à valider par les médecins du centre avant publication -->
  <section class="padding-section-large">
    <div class="padding-global"><div class="container-large">
      <div class="text-align-center max-width-medium margin-auto margin-bottom-large">
        <span class="text-style-eyebrow">Imagerie médicale</span>
        <h2 class="heading-style-h2">Des examens expliqués simplement</h2>
        <p class="text-style-muted text-size-medium" style="margin-top:1rem">Pour chaque examen, retrouvez pourquoi il est prescrit, comment vous y préparer et comment il se déroule.</p>
      </div>
      <div class="exam_nav"><a href="#echographie">Échographie</a><a href="#doppler">Doppler</a><a href="#radiographie">Radiographie numérique</a><a href="#scanner">Scanner</a></div>
      <article id="echographie" class="exam_section reveal">
        <div class="exam_visual"><div class="photo-placeholder">Photo : salle d'échographie Atlas</div></div>
        <div>
          <h2 class="heading-style-h2" style="font-size:2rem">Échographie</h2>
          <p class="text-style-muted text-size-medium" style="margin-top:.6rem">Un examen d'imagerie par ultrasons, sans rayons X, qui permet de visualiser de nombreux organes.</p>
          <div class="exam_facts"><div class="exam_fact"><small>Durée approximative</small>15 à 30 minutes</div><div class="exam_fact"><small>Rendez-vous</small>Sur demande, confirmé par l'équipe</div></div>
          <div class="exam_detail"><h3>Indications</h3><p class="text-style-muted">Suivi de grossesse, douleurs abdominales ou pelviennes, exploration du foie, des reins, de la vésicule, de la thyroïde, des seins ou des parties molles.</p></div>
          <div class="exam_detail"><h3>Préparation</h3><p class="text-style-muted">Selon l'examen : parfois à jeun quelques heures, ou vessie pleine. Notre équipe vous précise la consigne au moment du rendez-vous. Apportez votre ordonnance et vos anciens examens.</p></div>
          <div class="exam_detail"><h3>Déroulement</h3><p class="text-style-muted">Vous êtes allongé(e) confortablement. Le médecin applique un gel tiède sur la peau et déplace une sonde. L'examen est indolore.</p></div>
          <div class="exam_detail"><h3>Résultats</h3><p class="text-style-muted">Le médecin vous explique les premières constatations et un compte rendu vous est remis.</p></div>
          <div style="margin-top:1.5rem"><a href="<?php echo esc_url(home_url('/rendez-vous/')); ?>" class="button is-primary">Prendre rendez-vous pour cet examen</a></div>
        </div>
      </article>
      <article id="doppler" class="exam_section reveal">
        <div class="exam_visual"><div class="photo-placeholder">Photo : examen Doppler</div></div>
        <div>
          <h2 class="heading-style-h2" style="font-size:2rem">Doppler</h2>
          <p class="text-style-muted text-size-medium" style="margin-top:.6rem">Une échographie spécialisée qui étudie la circulation du sang dans les artères et les veines.</p>
          <div class="exam_facts"><div class="exam_fact"><small>Durée approximative</small>20 à 40 minutes</div><div class="exam_fact"><small>Rendez-vous</small>Sur demande, confirmé par l'équipe</div></div>
          <div class="exam_detail"><h3>Indications</h3><p class="text-style-muted">Jambes lourdes ou gonflées, suspicion de phlébite, contrôle des artères du cou ou des membres, exploration de certains vaisseaux abdominaux.</p></div>
          <div class="exam_detail"><h3>Préparation</h3><p class="text-style-muted">Généralement aucune préparation. Portez des vêtements amples, faciles à retirer au niveau de la zone examinée.</p></div>
          <div class="exam_detail"><h3>Déroulement</h3><p class="text-style-muted">Comme pour une échographie, une sonde et du gel sont utilisés. Le médecin observe et mesure le flux sanguin. L'examen est indolore.</p></div>
          <div class="exam_detail"><h3>Résultats</h3><p class="text-style-muted">Le médecin commente l'examen et remet un compte rendu à l'issue de la séance.</p></div>
          <div style="margin-top:1.5rem"><a href="<?php echo esc_url(home_url('/rendez-vous/')); ?>" class="button is-primary">Prendre rendez-vous pour cet examen</a></div>
        </div>
      </article>
      <article id="radiographie" class="exam_section reveal">
        <div class="exam_visual"><div class="photo-placeholder">Photo : salle de radiographie Atlas</div></div>
        <div>
          <h2 class="heading-style-h2" style="font-size:2rem">Radiographie numérique</h2>
          <p class="text-style-muted text-size-medium" style="margin-top:.6rem">Une image rapide des os, des articulations et du thorax, avec une dose de rayons X maîtrisée grâce au numérique.</p>
          <div class="exam_facts"><div class="exam_fact"><small>Durée approximative</small>10 à 15 minutes</div><div class="exam_fact"><small>Rendez-vous</small>Sur demande, confirmé par l'équipe</div></div>
          <div class="exam_detail"><h3>Indications</h3><p class="text-style-muted">Traumatisme ou suspicion de fracture, douleurs osseuses ou articulaires, toux persistante, contrôle du thorax.</p></div>
          <div class="exam_detail"><h3>Préparation</h3><p class="text-style-muted">Aucune préparation particulière. Retirez bijoux et objets métalliques sur la zone examinée. Signalez toute possibilité de grossesse.</p></div>
          <div class="exam_detail"><h3>Déroulement</h3><p class="text-style-muted">Vous êtes positionné(e) devant l'appareil par le manipulateur. Chaque image ne dure que quelques secondes. L'examen est indolore.</p></div>
          <div class="exam_detail"><h3>Résultats</h3><p class="text-style-muted">Les images sont disponibles rapidement et le compte rendu vous est remis selon les délais du centre.</p></div>
          <div style="margin-top:1.5rem"><a href="<?php echo esc_url(home_url('/rendez-vous/')); ?>" class="button is-primary">Prendre rendez-vous pour cet examen</a></div>
        </div>
      </article>
      <article id="scanner" class="exam_section reveal">
        <div class="exam_visual"><div class="photo-placeholder">Photo : salle de scanner (à venir)</div></div>
        <div>
          <h2 class="heading-style-h2" style="font-size:2rem">Scanner <span class="badge" style="margin-left:.6rem">Prochainement disponible</span></h2>
          <p class="text-style-muted text-size-medium" style="margin-top:.6rem">Un examen d'imagerie détaillé, qui produit des coupes précises du corps. Il sera bientôt disponible au Centre Atlas.</p>
          <div class="exam_facts"><div class="exam_fact"><small>Durée approximative</small>À préciser</div><div class="exam_fact"><small>Rendez-vous</small>Sur demande, confirmé par l'équipe</div></div>
          <div class="exam_detail"><h3>Indications</h3><p class="text-style-muted">Les indications seront précisées à l'ouverture du service.</p></div>
          <div class="exam_detail"><h3>Préparation</h3><p class="text-style-muted">Les consignes de préparation seront communiquées à l'ouverture du service.</p></div>
          <div class="exam_detail"><h3>Déroulement</h3><p class="text-style-muted">Les modalités de l'examen seront détaillées à l'ouverture du service.</p></div>
          <div class="exam_detail"><h3>Résultats</h3><p class="text-style-muted">À préciser</p></div>
          <div style="margin-top:1.5rem"><span class="button is-disabled" aria-disabled="true">Rendez-vous : bientôt disponible</span></div>
        </div>
      </article>
      <p class="note-info">Les informations présentées sont générales. Votre médecin ou notre équipe vous donnent les consignes adaptées à votre situation lors de la prise de rendez-vous.</p>
    </div></div>
  </section>
<?php get_template_part('parts/cta'); ?>

<?php get_footer(); ?>

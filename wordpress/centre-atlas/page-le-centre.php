<?php get_header(); ?>

  <section class="banner_component">
    <div class="padding-global"><div class="container-large banner_container">
      <h1 class="heading-style-h1" style="font-size:clamp(2.2rem,4vw,3.2rem)">Le Centre</h1>
      <div class="breadcrumb"><a href="<?php echo esc_url(home_url('/')); ?>">Accueil</a><span>›</span><span>Le Centre</span></div>
    </div></div>
  </section>

  <section class="padding-section-large">
    <div class="padding-global"><div class="container-large about_grid">
      <div class="about_visual reveal"><div class="about_image-main photo-placeholder">Photo : façade et entrée du Centre Atlas</div></div>
      <div class="about_content reveal">
        <span class="text-style-eyebrow">Présentation</span>
        <h2 class="heading-style-h2">Un centre pensé autour du patient</h2>
        <p class="text-style-muted text-size-medium">Le Centre Médical Atlas réunit plusieurs compétences médicales et explorations diagnostiques au sein d'un même environnement, à Dakar.</p>
        <p class="text-style-muted">Consultations pluridisciplinaires, imagerie médicale, endoscopie digestive, biopsies : le patient trouve au même endroit l'avis du médecin et les examens dont il a besoin, dans un cadre clair, calme et accueillant.</p>
        <div><a href="<?php echo esc_url(home_url('/rendez-vous/')); ?>" class="button is-primary">Prendre rendez-vous</a></div>
      </div>
    </div></div>
  </section>

  <section class="padding-section-large background-color-light">
    <div class="padding-global"><div class="container-large">
      <div class="vm_grid">
        <div class="vm_card reveal"><span class="text-style-eyebrow">Notre vision</span><h2 class="heading-style-h2" style="font-size:1.9rem">Une médecine moderne, proche des patients</h2><p class="text-style-muted">Faire du Centre Atlas une référence à Dakar pour une prise en charge coordonnée, où la technologie et l'expertise sont toujours au service du patient.</p></div>
        <div class="vm_card is-dark reveal"><span class="text-style-eyebrow">Notre mission</span><h2 class="heading-style-h2" style="font-size:1.9rem">Soigner avec écoute et rigueur</h2><p>Offrir une prise en charge accessible, professionnelle et personnalisée, du premier rendez-vous jusqu'aux résultats des examens.</p></div>
      </div>
    </div></div>
  </section>

  <section class="padding-section-large">
    <div class="padding-global"><div class="container-large">
      <div class="text-align-center max-width-medium margin-auto margin-bottom-large">
        <span class="text-style-eyebrow">Nos valeurs</span>
        <h2 class="heading-style-h2">Ce qui guide notre pratique</h2>
      </div>
      <div class="values_grid">
        <div class="value_card reveal"><span class="value_icon"><svg viewBox="0 0 24 24"><use href="#i-chat"/></svg></span><h3 class="heading-style-h4">Écoute</h3><p class="text-size-small text-style-muted">Prendre le temps de comprendre.</p></div>
        <div class="value_card reveal"><span class="value_icon"><svg viewBox="0 0 24 24"><use href="#i-stetho"/></svg></span><h3 class="heading-style-h4">Respect</h3><p class="text-size-small text-style-muted">De chaque personne et de son rythme.</p></div>
        <div class="value_card reveal"><span class="value_icon"><svg viewBox="0 0 24 24"><use href="#i-target"/></svg></span><h3 class="heading-style-h4">Expertise</h3><p class="text-size-small text-style-muted">Des compétences médicales solides.</p></div>
        <div class="value_card reveal"><span class="value_icon"><svg viewBox="0 0 24 24"><use href="#i-scan"/></svg></span><h3 class="heading-style-h4">Innovation</h3><p class="text-size-small text-style-muted">Des équipements modernes.</p></div>
        <div class="value_card reveal"><span class="value_icon"><svg viewBox="0 0 24 24"><use href="#i-calendar"/></svg></span><h3 class="heading-style-h4">Confidentialité</h3><p class="text-size-small text-style-muted">Vos données restent protégées.</p></div>
      </div>
    </div></div>
  </section>

  <section class="padding-section-large background-color-tint">
    <div class="padding-global"><div class="container-large split_grid">
      <div class="reveal">
        <span class="text-style-eyebrow">Notre approche du patient</span>
        <h2 class="heading-style-h2 margin-bottom-medium">Je découvre, je comprends, je suis rassuré</h2>
        <p class="text-style-muted text-size-medium">Chaque examen est expliqué simplement avant, pendant et après. Nos équipes vous accompagnent pour que vous sachiez toujours ce qui se passe et pourquoi.</p>
      </div>
      <div class="reveal background-color-dark" style="padding:2.5rem;border-radius:var(--radius)">
        <span class="text-style-eyebrow">Plateau technique</span>
        <ul class="list-check" style="margin-top:1rem">
          <li>Échographie &amp; Doppler</li><li>Radiographie numérique</li>
          <li>Scanner <span class="badge">Prochainement disponible</span></li>
          <li>Endoscopie digestive</li><li>Biopsies guidées par l'imagerie</li>
        </ul>
      </div>
    </div></div>
  </section>

  <section class="padding-section-large">
    <div class="padding-global"><div class="container-large">
      <div class="text-align-center max-width-medium margin-auto margin-bottom-large">
        <span class="text-style-eyebrow">Galerie</span>
        <h2 class="heading-style-h2">Découvrez nos espaces</h2>
      </div>
      <div class="gallery_grid">
        <div class="gallery_item is-wide is-tall photo-placeholder">Photo : façade</div>
        <div class="gallery_item photo-placeholder">Photo : réception</div>
        <div class="gallery_item photo-placeholder">Photo : salle d'attente</div>
        <div class="gallery_item photo-placeholder">Photo : cabinet de consultation</div>
        <div class="gallery_item photo-placeholder">Photo : échographie</div>
        <div class="gallery_item is-full photo-placeholder">Photo : détails architecturaux</div>
      </div>
    </div></div>
  </section>

<?php get_template_part('parts/cta'); ?>

<?php get_footer(); ?>

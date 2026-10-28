<?php get_header(); ?>

  <section class="banner_component">
    <div class="padding-global"><div class="container-large banner_container">
      <h1 class="heading-style-h1" style="font-size:clamp(2rem,4vw,3.2rem)">Spécialités</h1>
      <div class="breadcrumb"><a href="<?php echo esc_url(home_url('/')); ?>">Accueil</a><span>›</span><span>Spécialités</span></div>
    </div></div>
  </section>

  <section class="padding-section-large background-color-tint">
    <div class="padding-global"><div class="container-large">
      <div class="text-align-center max-width-medium margin-auto margin-bottom-large">
        <span class="text-style-eyebrow">Nos expertises médicales</span>
        <h2 class="heading-style-h2">Des spécialistes à votre écoute</h2>
        <p class="text-style-muted text-size-medium" style="margin-top:1rem">Chaque spécialité est présentée simplement : quand consulter, comment se déroule la consultation et quels examens peuvent être associés.</p>
      </div>
      <div class="spec_grid">
        <a href="<?php echo esc_url(home_url('/specialites-medecine-generale/')); ?>" class="spec_card reveal"><span class="value_icon"><svg viewBox="0 0 24 24"><use href="#i-stetho"/></svg></span><h3 class="heading-style-h4">Médecine générale</h3><p class="text-size-small text-style-muted">Votre premier interlocuteur pour tout problème de santé, pour le suivi au long cours et l'orientation vers le bon spécialiste.</p><span class="quick_link text-color-accent">En savoir plus <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2"><use href="#i-arrow"/></svg></span></a>
        <a href="<?php echo esc_url(home_url('/specialites-cardiologie/')); ?>" class="spec_card reveal"><span class="value_icon"><svg viewBox="0 0 24 24"><use href="#i-stetho"/></svg></span><h3 class="heading-style-h4">Cardiologie</h3><p class="text-size-small text-style-muted">Le dépistage, le suivi et la prise en charge des maladies du cœur et des vaisseaux.</p><span class="quick_link text-color-accent">En savoir plus <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2"><use href="#i-arrow"/></svg></span></a>
        <a href="<?php echo esc_url(home_url('/specialites-gynecologie/')); ?>" class="spec_card reveal"><span class="value_icon"><svg viewBox="0 0 24 24"><use href="#i-calendar"/></svg></span><h3 class="heading-style-h4">Gynécologie</h3><p class="text-size-small text-style-muted">Un suivi attentif et confidentiel de la santé des femmes, à chaque étape de la vie.</p><span class="quick_link text-color-accent">En savoir plus <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2"><use href="#i-arrow"/></svg></span></a>
        <a href="<?php echo esc_url(home_url('/specialites-gastro-enterologie/')); ?>" class="spec_card reveal"><span class="value_icon"><svg viewBox="0 0 24 24"><use href="#i-tube"/></svg></span><h3 class="heading-style-h4">Gastro-entérologie</h3><p class="text-size-small text-style-muted">La prise en charge des maladies de l'estomac, de l'intestin et du foie, avec accès aux explorations digestives sur place.</p><span class="quick_link text-color-accent">En savoir plus <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2"><use href="#i-arrow"/></svg></span></a>
        <a href="<?php echo esc_url(home_url('/specialites-neurologie/')); ?>" class="spec_card reveal"><span class="value_icon"><svg viewBox="0 0 24 24"><use href="#i-target"/></svg></span><h3 class="heading-style-h4">Neurologie</h3><p class="text-size-small text-style-muted">L'évaluation et le suivi des maladies du système nerveux, du cerveau aux nerfs périphériques.</p><span class="quick_link text-color-accent">En savoir plus <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2"><use href="#i-arrow"/></svg></span></a>
        <a href="<?php echo esc_url(home_url('/specialites-rhumatologie/')); ?>" class="spec_card reveal"><span class="value_icon"><svg viewBox="0 0 24 24"><use href="#i-scan"/></svg></span><h3 class="heading-style-h4">Rhumatologie</h3><p class="text-size-small text-style-muted">La prise en charge des douleurs et maladies des articulations, du dos, des os et des muscles.</p><span class="quick_link text-color-accent">En savoir plus <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2"><use href="#i-arrow"/></svg></span></a>
      </div>
    </div></div>
  </section>
  <section class="padding-section-large">
    <div class="padding-global"><div class="container-large about_grid">
      <div class="reveal">
        <span class="eyebrow2">Questions fréquentes</span>
        <h2 class="heading-style-h2 margin-bottom-medium">Avant votre consultation</h2>
        <div class="faq">
          <details open><summary>Comment prendre rendez-vous ?</summary><p>Par le formulaire du site, par téléphone au 33 867 86 46 ou sur WhatsApp au 78 831 60 60. Notre équipe vous rappelle pour confirmer le créneau.</p></details>
          <details><summary>Que dois-je apporter ?</summary><p>Votre pièce d'identité, votre ordonnance si vous en avez une, et vos anciens examens ou comptes rendus.</p></details>
          <details><summary>Comment sont remis les résultats ?</summary><p>Le médecin vous explique les résultats et un compte rendu vous est remis, selon les délais propres à chaque examen.</p></details>
          <details><summary>Le scanner est-il disponible ?</summary><p>Pas encore : il sera proposé dès son installation. Nous l'indiquerons sur le site.</p></details>
        </div>
      </div>
      <div class="collage is-right reveal">
        <div class="collage_main photo-placeholder">Photo : équipe du Centre Atlas</div>
        <div class="collage_small photo-placeholder">Photo : accueil</div>
      </div>
    </div></div>
  </section>
<?php get_template_part('parts/cta'); ?>

<?php get_footer(); ?>

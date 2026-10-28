<?php get_header(); ?>

  <section class="banner_component">
    <div class="padding-global"><div class="container-large banner_container">
      <h1 class="heading-style-h1" style="font-size:clamp(2rem,4vw,3.2rem)">Prendre rendez-vous</h1>
      <div class="breadcrumb"><a href="<?php echo esc_url(home_url('/')); ?>">Accueil</a><span>›</span><span>Prendre rendez-vous</span></div>
    </div></div>
  </section>

  <section class="padding-section-large background-color-light">
    <div class="padding-global"><div class="container-large" style="max-width:820px">
      <div class="text-align-center margin-bottom-large">
        <span class="text-style-eyebrow">Demande de rendez-vous</span>
        <h2 class="heading-style-h2">Dites-nous ce dont vous avez besoin</h2>
        <p class="text-style-muted text-size-medium" style="margin-top:1rem">Remplissez ce court formulaire. Notre équipe vous contactera pour confirmer votre rendez-vous.</p>
      </div>
      <div class="form_card">
        <form method="post" action="<?php echo esc_url(admin_url('admin-post.php')); ?>" class="form_grid"<?php echo atlas_sent_hidden(); ?>><input type="hidden" name="action" value="atlas_form"><input type="hidden" name="form_type" value="Demande de rendez-vous"><?php wp_nonce_field('atlas_form', 'atlas_nonce'); ?><input type="text" name="website" class="hp" tabindex="-1" autocomplete="off" aria-hidden="true">
          <div class="form_field is-full"><label for="nom">Nom et prénom</label><input class="form_input" id="nom" name="nom" required autocomplete="name"></div>
          <div class="form_field"><label for="tel">Téléphone</label><input class="form_input" id="tel" name="tel" type="tel" required autocomplete="tel"></div>
          <div class="form_field"><label for="email">Email <span>(facultatif)</span></label><input class="form_input" id="email" name="email" type="email" autocomplete="email"></div>
          <div class="form_field"><label for="type">Type de rendez-vous</label><select class="form_input" id="type" name="type" required><option value="">Choisir…</option><option>Consultation</option><option>Échographie</option><option>Radiographie</option><option disabled>Scanner (bientôt disponible)</option><option>Endoscopie</option><option>Biopsie</option><option>Autre</option></select></div>
          <div class="form_field"><label for="medecin">Médecin souhaité</label><select class="form_input" id="medecin" name="medecin"><option>Pas de préférence</option><option>Dr. Prénom Nom (Cardiologie)</option><option>Dr. Prénom Nom (Gastro-entérologie)</option><option>Dr. Prénom Nom (Médecine générale)</option></select></div>
          <div class="form_field is-full"><label for="date">Date souhaitée</label><input class="form_input" id="date" name="date" type="date"></div>
          <div class="form_field is-full"><label for="message">Message <span>(facultatif)</span></label><textarea class="form_input" id="message" name="message"></textarea></div>
          <div class="form_field is-full"><button type="submit" class="button is-primary" style="justify-content:center">Envoyer ma demande</button>
            <p class="form_disclaimer">Cette demande n'est pas une confirmation de créneau : notre équipe vous rappelle pour fixer l'horaire avec vous.</p></div>
        </form>
        <div class="form_success<?php echo atlas_sent_class(); ?>" role="status"><span class="value_icon"><svg viewBox="0 0 24 24"><path d="M5 12.5l4.5 4.5L19 7.5"/></svg></span><h3 class="heading-style-h4">Merci !</h3><p class="text-style-muted">Votre demande a bien été reçue. Notre équipe vous contactera pour confirmer votre rendez-vous.</p></div>
      </div>
      <p class="text-align-center text-style-muted" style="margin-top:2rem">Plus rapide ? Appelez le <a class="text-color-accent" href="tel:+221338678646"><strong>33 867 86 46</strong></a> ou écrivez-nous sur <a class="text-color-accent" href="https://wa.me/221788316060"><strong>WhatsApp</strong></a>.</p>
    </div></div>
  </section>

<?php get_footer(); ?>

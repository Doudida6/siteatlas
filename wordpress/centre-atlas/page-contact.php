<?php get_header(); ?>

  <section class="banner_component">
    <div class="padding-global"><div class="container-large banner_container">
      <h1 class="heading-style-h1" style="font-size:clamp(2rem,4vw,3.2rem)">Contact</h1>
      <div class="breadcrumb"><a href="<?php echo esc_url(home_url('/')); ?>">Accueil</a><span>›</span><span>Contact</span></div>
    </div></div>
  </section>

  <section class="padding-section-large">
    <div class="padding-global"><div class="container-large contact_grid">
      <div>
        <span class="text-style-eyebrow">Nous contacter</span>
        <h2 class="heading-style-h2">Une question ? Écrivez-nous</h2>
        <div class="contact_cards">
          <div class="contact_card"><span class="value_icon"><svg viewBox="0 0 24 24"><use href="#i-pin"/></svg></span><div><small>Adresse</small>Centre Médical Atlas, Dakar, Sénégal <span class="text-style-muted">(adresse complète à compléter)</span></div></div>
          <div class="contact_card"><span class="value_icon"><svg viewBox="0 0 24 24"><use href="#i-phone"/></svg></span><div><small>Téléphone</small><a href="tel:+221338678646">33 867 86 46</a> · <a href="tel:+221788316060">78 831 60 60</a></div></div>
          <div class="contact_card"><span class="value_icon"><svg viewBox="0 0 24 24"><use href="#i-chat"/></svg></span><div><small>Email du secrétariat</small><a href="mailto:centreatlasmedical@gmail.com">centreatlasmedical@gmail.com</a></div></div>
          <div class="contact_card"><span class="value_icon"><svg viewBox="0 0 24 24"><use href="#i-calendar"/></svg></span><div><small>Horaires</small>À compléter</div></div>
        </div>
        <div class="button-group">
          <a href="tel:+221788316060" class="button is-primary">Appeler</a>
          <a href="https://wa.me/221788316060" class="button is-whatsapp">WhatsApp</a>
          <a href="https://www.google.com/maps/dir/?api=1&destination=Dakar,Senegal" class="button is-secondary" target="_blank" rel="noopener">Itinéraire</a>
        </div>
      </div>
      <div class="form_card">
        <form method="post" action="<?php echo esc_url(admin_url('admin-post.php')); ?>" class="form_grid"<?php echo atlas_sent_hidden(); ?>><input type="hidden" name="action" value="atlas_form"><input type="hidden" name="form_type" value="Message de contact"><?php wp_nonce_field('atlas_form', 'atlas_nonce'); ?><input type="text" name="website" class="hp" tabindex="-1" autocomplete="off" aria-hidden="true">
          <div class="form_field is-full"><label for="c-nom">Nom et prénom</label><input class="form_input" id="c-nom" name="c-nom" required autocomplete="name"></div>
          <div class="form_field"><label for="c-tel">Téléphone</label><input class="form_input" id="c-tel" name="c-tel" type="tel" autocomplete="tel"></div>
          <div class="form_field"><label for="c-email">Email</label><input class="form_input" id="c-email" name="c-email" type="email" autocomplete="email"></div>
          <div class="form_field is-full"><label for="c-msg">Message</label><textarea class="form_input" id="c-msg" name="c-msg" required></textarea></div>
          <div class="form_field is-full"><button type="submit" class="button is-primary" style="justify-content:center">Envoyer le message</button></div>
        </form>
        <div class="form_success<?php echo atlas_sent_class(); ?>" role="status"><span class="value_icon"><svg viewBox="0 0 24 24"><path d="M5 12.5l4.5 4.5L19 7.5"/></svg></span><h3 class="heading-style-h4">Message envoyé</h3><p class="text-style-muted">Merci, nous avons bien reçu votre message. Notre équipe vous répondra rapidement.</p></div>
      </div>
    </div></div>
  </section>
  <section class="padding-section-medium" style="padding-top:0">
    <div class="padding-global"><div class="container-large">
      <!-- Carte : remplacer "Dakar" par l'adresse exacte du centre -->
      <iframe class="map_frame" title="Carte du Centre Médical Atlas" loading="lazy" src="https://www.google.com/maps?q=Dakar,Senegal&output=embed"></iframe>
    </div></div>
  </section>

<?php get_footer(); ?>

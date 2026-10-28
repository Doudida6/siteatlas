  <!-- ===== Footer ===== -->
  <footer class="footer_component">
    <div class="padding-global">
      <div class="container-large">
        <div class="footer2_grid">
          <div>
            <a href="<?php echo esc_url(home_url('/')); ?>" class="nav_logo" style="margin-bottom:1.2rem"><img src="<?php echo esc_url(get_theme_file_uri('assets/logo-icon.svg')); ?>" alt="" class="nav_logo-icon"><span class="nav_logo-text"><small>Centre Médical</small><strong>ATLAS</strong></span></a>
            <p class="text-size-small">Votre santé. Notre engagement.<br>Médecine • Imagerie • Endoscopie • Biopsie</p>
            <div class="footer2_social"><a href="#" aria-label="Facebook"><svg><use href="#i-fb"/></svg></a><a href="#" aria-label="Instagram"><svg><use href="#i-ig"/></svg></a><a href="https://wa.me/221788316060" aria-label="WhatsApp"><svg><use href="#i-wa"/></svg></a></div>
          </div>
          <div>
            <h4 class="footer_title">Coordonnées</h4>
            <ul class="footer2_list">
              <li><svg><use href="#i-pin"/></svg><span>Dakar, Sénégal <span style="opacity:.6">(adresse à compléter)</span></span></li>
              <li><svg><use href="#i-mail"/></svg><a href="mailto:centreatlasmedical@gmail.com">centreatlasmedical@gmail.com</a></li>
              <li><svg><use href="#i-clock"/></svg>Horaires à compléter</li>
              <li><svg><use href="#i-phone"/></svg><span><a href="tel:+221338678646">33 867 86 46</a> · <a href="tel:+221788316060">78 831 60 60</a></span></li>
            </ul>
          </div>
          <div>
            <h4 class="footer_title">Pages</h4>
            <ul class="footer2_pages">
              <li><a href="<?php echo esc_url(home_url('/')); ?>">Accueil</a></li>
              <li><a href="<?php echo esc_url(home_url('/le-centre/')); ?>">Le Centre</a></li>
              <li><a href="<?php echo esc_url(home_url('/specialites/')); ?>">Spécialités</a></li>
              <li><a href="<?php echo esc_url(home_url('/imagerie/')); ?>">Imagerie</a></li>
              <li><a href="<?php echo esc_url(home_url('/nos-medecins/')); ?>">Nos médecins</a></li>
              <li><a href="<?php echo esc_url(home_url('/conseils-sante/')); ?>">Conseils santé</a></li>
              <li><a href="<?php echo esc_url(home_url('/contact/')); ?>">Contact</a></li>
            </ul>
          </div>
          <div>
            <h4 class="footer_title">Prendre rendez-vous</h4>
            <a href="tel:+221338678646" class="footer2_call"><span class="footer2_call-icon"><svg><use href="#i-phone"/></svg></span><span><b>Appelez-nous</b><small>33 867 86 46</small></span></a>
            <p class="text-size-small" style="margin-top:1rem">Ou envoyez-nous une demande en ligne : nous vous rappelons pour confirmer.</p>
            <a href="<?php echo esc_url(home_url('/rendez-vous/')); ?>" class="button is-primary" style="margin-top:1rem">Faire une demande</a>
          </div>
        </div>
        <div class="footer_bottom"><span>© 2026 Centre Médical Atlas. Tous droits réservés.</span><span>Maquette de présentation</span></div>
      </div>
    </div>
  </footer>
</div>

<!-- Barre d'accès rapide mobile -->
<nav class="mobile-bar" aria-label="Accès rapide">
  <a href="tel:+221788316060"><svg><use href="#i-phone"/></svg>Appeler</a>
  <a href="https://wa.me/221788316060"><svg><use href="#i-chat"/></svg>WhatsApp</a>
  <a href="<?php echo esc_url(home_url('/rendez-vous/')); ?>" class="is-main"><svg><use href="#i-calendar"/></svg>Rendez-vous</a>
</nav>

<?php wp_footer(); ?>
</body>
</html>

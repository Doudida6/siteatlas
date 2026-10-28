  <!-- ===== Footer ===== -->
  <footer class="footer_component">
    <div class="padding-global">
      <div class="container-large">
        <div class="footer2_grid">
          <div>
            <a href="<?php echo esc_url(home_url('/')); ?>" class="nav_logo" style="margin-bottom:1.2rem"><img src="<?php echo esc_url(get_theme_file_uri('assets/logo-icon.svg')); ?>" alt="" class="nav_logo-icon"><span class="nav_logo-text"><small><?php atlas_t('t9e6fc50a'); ?></small><strong><?php atlas_t('t96fd73b0'); ?></strong></span></a>
            <p class="text-size-small"><?php atlas_t('tee47ac09'); ?><br><?php atlas_t('tf9c5c42b'); ?></p>
            <div class="footer2_social"><?php if (atlas_opt('facebook')) : ?><a href="<?php echo esc_url(atlas_opt('facebook')); ?>" aria-label="Facebook" target="_blank" rel="noopener"><svg><use href="#i-fb"/></svg></a><?php endif; ?><?php if (atlas_opt('instagram')) : ?><a href="<?php echo esc_url(atlas_opt('instagram')); ?>" aria-label="Instagram" target="_blank" rel="noopener"><svg><use href="#i-ig"/></svg></a><?php endif; ?><a href="https://wa.me/<?php echo esc_attr(atlas_wa()); ?>" aria-label="WhatsApp"><svg><use href="#i-wa"/></svg></a></div>
          </div>
          <div>
            <h4 class="footer_title"><?php atlas_t('t70e7a23c'); ?></h4>
            <ul class="footer2_list">
              <li><svg><use href="#i-pin"/></svg><span class="addr"><?php echo esc_html(atlas_addr()); ?></span></li>
              <li><svg><use href="#i-mail"/></svg><a href="mailto:<?php echo esc_attr(atlas_opt('email')); ?>"><?php atlas_t('t12a6d4d0'); ?></a></li>
              <li><svg><use href="#i-clock"/></svg><span class="hours"><?php echo atlas_hours(); ?></span></li>
              <li><svg><use href="#i-phone"/></svg><span><a href="tel:<?php echo esc_attr(atlas_tel('tel_mobile')); ?>"><?php atlas_t('t3046a572'); ?></a> / <a href="tel:<?php echo esc_attr(atlas_tel('tel_fixe')); ?>"><?php atlas_t('t83ca4101'); ?></a></span></li>
            </ul>
          </div>
          <div>
            <h4 class="footer_title"><?php atlas_t('t453aceb0'); ?></h4>
            <ul class="footer2_pages">
              <li><a href="<?php echo esc_url(home_url('/')); ?>"><?php atlas_t('t74fe31b5'); ?></a></li>
              <li><a href="<?php echo esc_url(home_url('/le-centre/')); ?>"><?php atlas_t('tbd986c19'); ?></a></li>
              <li><a href="<?php echo esc_url(home_url('/specialites/')); ?>"><?php atlas_t('t4b581032'); ?></a></li>
              <li><a href="<?php echo esc_url(home_url('/imagerie/')); ?>"><?php atlas_t('t70e91475'); ?></a></li>
              <li><a href="<?php echo esc_url(home_url('/biologie/')); ?>"><?php atlas_t('t2785781c'); ?></a></li>
              <li><a href="<?php echo esc_url(home_url('/nos-medecins/')); ?>"><?php atlas_t('tbc8ce25b'); ?></a></li>
              <li><a href="<?php echo esc_url(home_url('/conseils-sante/')); ?>"><?php atlas_t('t59fcfbf5'); ?></a></li>
              <li><a href="<?php echo esc_url(home_url('/contact/')); ?>"><?php atlas_t('tbbaff128'); ?></a></li>
            </ul>
          </div>
          <div>
            <h4 class="footer_title"><?php atlas_t('tda31472f'); ?></h4>
            <a href="tel:<?php echo esc_attr(atlas_tel('tel_mobile')); ?>" class="footer2_call"><span class="footer2_call-icon"><svg><use href="#i-phone"/></svg></span><span><b><?php atlas_t('t6f4dbb3f'); ?></b><small><?php atlas_t('t39af97aa'); ?></small></span></a>
            <p class="text-size-small" style="margin-top:1rem"><?php atlas_t('t3007fc35'); ?></p>
            <a href="<?php echo esc_url(home_url('/rendez-vous/')); ?>" class="button is-primary" style="margin-top:1rem"><?php atlas_t('t7c7fd123'); ?></a>
          </div>
        </div>
        <div class="footer_bottom"><span><?php atlas_t('t18fc0a3e'); ?></span><?php atlas_credit(); ?></div>
      </div>
    </div>
  </footer>
</div>

<!-- Barre d'accès rapide mobile -->
<nav class="mobile-bar" aria-label="Accès rapide">
  <a href="tel:<?php echo esc_attr(atlas_tel('tel_mobile')); ?>"><svg><use href="#i-phone"/></svg><?php atlas_t('t55c40bf7'); ?></a>
  <a href="https://wa.me/<?php echo esc_attr(atlas_wa()); ?>"><svg><use href="#i-chat"/></svg><?php atlas_t('t8b777ebc'); ?></a>
  <a href="<?php echo esc_url(home_url('/rendez-vous/')); ?>" class="is-main"><svg><use href="#i-calendar"/></svg><?php atlas_t('ta6be3418'); ?></a>
</nav>

<?php wp_footer(); ?>
</body>
</html>

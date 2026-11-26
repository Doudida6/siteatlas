/* Mode édition : textes modifiables au clic, photos remplaçables, enregistrement sans quitter la page. */
(function ($) {
  'use strict';
  var texts = {}, photos = {};

  function count() { return Object.keys(texts).length + Object.keys(photos).length; }
  function refresh() {
    var n = count();
    $('.atlas-save').prop('disabled', n === 0).text(n ? 'Enregistrer (' + n + ')' : 'Enregistrer');
  }
  function msg(t) { $('.atlas-msg').html(t); }

  // Barre d'outils en bas de l'écran
  $('body').append(
    '<div class="atlas-bar" role="region" aria-label="Mode modification">' +
    '<span class="atlas-msg"><strong>Mode modification</strong> : cliquez sur un texte ou sur « Changer la photo ».</span>' +
    '<button type="button" class="atlas-save" disabled>Enregistrer</button>' +
    '<a class="atlas-exit" href="' + atlasEditor.exit + '">Quitter</a></div>'
  );

  // ---------- Textes ----------
  $('.atlas-e').each(function () {
    var raw = this.getAttribute('data-raw') || '';
    if (raw.indexOf('{') !== -1) {
      // numéros, email, horaires : se modifient dans Coordonnées (sinon on casserait le remplacement automatique)
      this.classList.add('atlas-e-locked');
      this.setAttribute('title', 'Ce texte reprend vos coordonnées : modifiez-le dans Centre Atlas → Coordonnées.');
      return;
    }
    this.setAttribute('contenteditable', 'true');
    this.setAttribute('spellcheck', 'true');
  });
  $(document).on('input', '.atlas-e', function () {
    var key = this.getAttribute('data-atlas-t');
    var val = this.textContent.replace(/\s+/g, ' ').trim();
    texts[key] = val;
    this.setAttribute('data-raw', val);
    // même texte affiché ailleurs sur la page : on le met à jour aussi
    $('.atlas-e[data-atlas-t="' + key + '"]').not(this).text(val).attr('data-raw', val);
    $(this).addClass('is-dirty');
    refresh();
  });
  $(document).on('keydown', '.atlas-e', function (e) {
    if (e.key === 'Enter') { e.preventDefault(); this.blur(); }
  });
  $(document).on('paste', '.atlas-e', function (e) {
    e.preventDefault();
    var t = (e.originalEvent.clipboardData || window.clipboardData).getData('text');
    document.execCommand('insertText', false, t.replace(/\s+/g, ' '));
  });
  // Un clic sur un texte placé dans un lien ou un bouton ne doit pas changer de page
  document.addEventListener('click', function (e) {
    if (e.target.closest && e.target.closest('.atlas-e')) { e.preventDefault(); }
    if (e.target.closest && e.target.closest('.atlas-e-locked')) { msg('<strong>Coordonnées</strong> : ce texte se modifie dans Centre Atlas → Coordonnées.'); }
  }, true);
  document.addEventListener('submit', function (e) { e.preventDefault(); }, true);

  // Les liens internes restent en mode modification
  $('a[href]').each(function () {
    var a = this;
    if (a.closest('.atlas-bar') || a.closest('#wpadminbar')) return;
    try {
      var u = new URL(a.href, location.href);
      if (u.origin === location.origin && u.pathname.indexOf('/wp-') !== 0) { u.searchParams.set('atlas_edit', '1'); a.href = u.toString(); }
    } catch (err) {}
  });

  // ---------- Photos ----------
  $('[data-atlas-photo]').each(function () {
    var el = $(this);
    if (getComputedStyle(this).position === 'static') el.css('position', 'relative');
    el.addClass('atlas-ph').append('<span class="atlas-ph-btn"><button type="button" class="atlas-ph-pick">Changer la photo</button></span>');
  });
  $(document).on('click', '.atlas-ph-pick', function (e) {
    e.preventDefault(); e.stopPropagation();
    var box = $(this).closest('[data-atlas-photo]');
    var frame = wp.media({ title: 'Choisir une photo', button: { text: 'Utiliser cette photo' }, multiple: false, library: { type: 'image' } });
    frame.on('select', function () {
      var a = frame.state().get('selection').first().toJSON();
      var url = (a.sizes && a.sizes.large) ? a.sizes.large.url : a.url;
      photos[box.attr('data-atlas-photo')] = a.id;
      box.css('background-image', 'url("' + url + '")').addClass('has-photo is-dirty');
      // retire le libellé gris « Photo : … » s'il était affiché
      box.contents().filter(function () { return this.nodeType === 3 && this.textContent.trim(); }).remove();
      refresh();
    });
    frame.open();
  });

  // ---------- Enregistrement ----------
  $(document).on('click', '.atlas-save', function () {
    if (!count()) return;
    var btn = $(this).prop('disabled', true).text('Enregistrement…');
    $.post(atlasEditor.ajax, {
      action: 'atlas_inline_save', nonce: atlasEditor.nonce,
      texts: JSON.stringify(texts), photos: JSON.stringify(photos)
    }).done(function (r) {
      if (!r || !r.success) { msg('<strong>Erreur</strong> : non enregistré. Rechargez la page et réessayez.'); refresh(); return; }
      $.each(r.data.texts || {}, function (k, v) {
        $('.atlas-e[data-atlas-t="' + k + '"]').attr('data-raw', v.raw).text(v.shown);
      });
      texts = {}; photos = {};
      $('.is-dirty').removeClass('is-dirty');
      msg('<strong>Enregistré ✓</strong> Les visiteurs voient déjà la nouvelle version.');
      refresh();
    }).fail(function () {
      msg('<strong>Erreur</strong> : connexion perdue. Réessayez.');
      refresh();
    });
  });

  window.addEventListener('beforeunload', function (e) {
    if (count()) { e.preventDefault(); e.returnValue = ''; }
  });
})(jQuery);

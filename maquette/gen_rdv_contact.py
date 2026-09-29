"""Génère rendez-vous.html et contact.html (formulaires de maquette, sans envoi réel)."""
from layout import page, banner
OK = '''<div class="form_success" role="status"><span class="value_icon"><svg viewBox="0 0 24 24"><path d="M5 12.5l4.5 4.5L19 7.5"/></svg></span><h3 class="heading-style-h4">{titre}</h3><p class="text-style-muted">{msg}</p></div>'''

# --- Rendez-vous ---
types = ['Consultation', 'Échographie', 'Radiographie', 'Scanner (bientôt disponible)', 'Endoscopie', 'Biopsie', 'Autre']
opts = ''.join(f'<option{" disabled" if "bientôt" in t else ""}>{t}</option>' for t in types)
docs = ''.join(f'<option>{d}</option>' for d in ['Pas de préférence', 'Dr. Prénom Nom (Cardiologie)', 'Dr. Prénom Nom (Gastro-entérologie)', 'Dr. Prénom Nom (Médecine générale)'])
body = banner('Prendre rendez-vous', [('Accueil', 'index.html')]) + f'''
  <section class="padding-section-large background-color-light">
    <div class="padding-global"><div class="container-large" style="max-width:820px">
      <div class="text-align-center margin-bottom-large">
        <span class="text-style-eyebrow">Demande de rendez-vous</span>
        <h2 class="heading-style-h2">Dites-nous ce dont vous avez besoin</h2>
        <p class="text-style-muted text-size-medium" style="margin-top:1rem">Remplissez ce court formulaire. Notre équipe vous contactera pour confirmer votre rendez-vous.</p>
      </div>
      <div class="form_card">
        <form data-form class="form_grid">
          <div class="form_field is-full"><label for="nom">Nom et prénom</label><input class="form_input" id="nom" name="nom" required autocomplete="name"></div>
          <div class="form_field"><label for="tel">Téléphone</label><input class="form_input" id="tel" name="tel" type="tel" required autocomplete="tel"></div>
          <div class="form_field"><label for="email">Email <span>(facultatif)</span></label><input class="form_input" id="email" name="email" type="email" autocomplete="email"></div>
          <div class="form_field"><label for="type">Type de rendez-vous</label><select class="form_input" id="type" name="type" required><option value="">Choisir…</option>{opts}</select></div>
          <div class="form_field"><label for="medecin">Médecin souhaité</label><select class="form_input" id="medecin" name="medecin">{docs}</select></div>
          <div class="form_field is-full"><label for="date">Date souhaitée</label><input class="form_input" id="date" name="date" type="date"></div>
          <div class="form_field is-full"><label for="message">Message <span>(facultatif)</span></label><textarea class="form_input" id="message" name="message"></textarea></div>
          <div class="form_field is-full"><button type="submit" class="button is-primary" style="justify-content:center">Envoyer ma demande</button>
            <p class="form_disclaimer">Cette demande n'est pas une confirmation de créneau : notre équipe vous rappelle pour fixer l'horaire avec vous.</p></div>
        </form>
        {OK.format(titre='Merci !', msg='Votre demande a bien été reçue. Notre équipe vous contactera pour confirmer votre rendez-vous.')}
      </div>
      <p class="text-align-center text-style-muted" style="margin-top:2rem">Plus rapide ? Appelez le <a class="text-color-accent" href="tel:+221338678646"><strong>33 867 86 46</strong></a> ou écrivez-nous sur <a class="text-color-accent" href="https://wa.me/221788316060"><strong>WhatsApp</strong></a>.</p>
    </div></div>
  </section>
'''
open('rendez-vous.html', 'w').write(page('Prendre rendez-vous | Centre Médical Atlas, Dakar', "Demandez un rendez-vous au Centre Médical Atlas à Dakar : consultation, échographie, radiographie, endoscopie ou biopsie.", 'rendez-vous.html', body))

# --- Contact ---
def ic(i): return f'<span class="value_icon"><svg viewBox="0 0 24 24"><use href="#{i}"/></svg></span>'
body = banner('Contact', [('Accueil', 'index.html')]) + f'''
  <section class="padding-section-large">
    <div class="padding-global"><div class="container-large contact_grid">
      <div>
        <span class="text-style-eyebrow">Nous contacter</span>
        <h2 class="heading-style-h2">Une question ? Écrivez-nous</h2>
        <div class="contact_cards">
          <div class="contact_card">{ic('i-pin')}<div><small>Adresse</small>Centre Médical Atlas, Dakar, Sénégal <span class="text-style-muted">(adresse complète à compléter)</span></div></div>
          <div class="contact_card">{ic('i-phone')}<div><small>Téléphone</small><a href="tel:+221338678646">33 867 86 46</a> · <a href="tel:+221788316060">78 831 60 60</a></div></div>
          <div class="contact_card">{ic('i-chat')}<div><small>Email du secrétariat</small><a href="mailto:centreatlasmedical@gmail.com">centreatlasmedical@gmail.com</a></div></div>
          <div class="contact_card">{ic('i-calendar')}<div><small>Horaires</small>À compléter</div></div>
        </div>
        <div class="button-group">
          <a href="tel:+221788316060" class="button is-primary">Appeler</a>
          <a href="https://wa.me/221788316060" class="button is-whatsapp">WhatsApp</a>
          <a href="https://www.google.com/maps/dir/?api=1&destination=Dakar,Senegal" class="button is-secondary" target="_blank" rel="noopener">Itinéraire</a>
        </div>
      </div>
      <div class="form_card">
        <form data-form class="form_grid">
          <div class="form_field is-full"><label for="c-nom">Nom et prénom</label><input class="form_input" id="c-nom" required autocomplete="name"></div>
          <div class="form_field"><label for="c-tel">Téléphone</label><input class="form_input" id="c-tel" type="tel" autocomplete="tel"></div>
          <div class="form_field"><label for="c-email">Email</label><input class="form_input" id="c-email" type="email" autocomplete="email"></div>
          <div class="form_field is-full"><label for="c-msg">Message</label><textarea class="form_input" id="c-msg" required></textarea></div>
          <div class="form_field is-full"><button type="submit" class="button is-primary" style="justify-content:center">Envoyer le message</button></div>
        </form>
        {OK.format(titre='Message envoyé', msg='Merci, nous avons bien reçu votre message. Notre équipe vous répondra rapidement.')}
      </div>
    </div></div>
  </section>
  <section class="padding-section-medium" style="padding-top:0">
    <div class="padding-global"><div class="container-large">
      <!-- Carte : remplacer "Dakar" par l'adresse exacte du centre -->
      <iframe class="map_frame" title="Carte du Centre Médical Atlas" loading="lazy" src="https://www.google.com/maps?q=Dakar,Senegal&output=embed"></iframe>
    </div></div>
  </section>
'''
open('contact.html', 'w').write(page('Contact et accès | Centre Médical Atlas, Dakar', "Contactez le Centre Médical Atlas à Dakar : téléphone, WhatsApp, email, horaires et itinéraire.", 'contact.html', body))
print('ok')

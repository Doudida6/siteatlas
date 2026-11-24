"""Génère mentions-legales.html et politique-de-confidentialite.html.
Les valeurs variables sont des <span class="lv" data-v="clé"> : le thème WordPress les remplace par les réglages
« Centre Atlas > Coordonnées ». Textes juridiques à faire valider avant publication."""
from layout import page, banner, CTA

def v(key, default='à compléter'):
    return f'<span class="lv" data-v="{key}">{default}</span>'

def wrap(h1, inner):
    return banner(h1, [('Accueil', 'index.html')]) + f'''
  <!-- Texte juridique : à relire et faire valider par le centre (ou son conseil juridique) avant publication -->
  <section class="padding-section-large">
    <div class="padding-global"><div class="container-large" style="max-width:860px">
      <div class="article_body legal_body">
{inner}
      </div>
    </div></div>
  </section>
'''

MENTIONS = f'''        <p class="text-style-muted">Dernière mise à jour : novembre 2026.</p>
        <h2>Éditeur du site</h2>
        <ul>
          <li>Raison sociale : {v('raison_sociale', 'Centre Médical Atlas')}</li>
          <li>Forme juridique : {v('forme_juridique')}</li>
          <li>Siège : {v('adresse', 'Liberté 6, Dakar')}, Sénégal</li>
          <li>NINEA : {v('ninea')}</li>
          <li>RCCM : {v('rccm')}</li>
          <li>Téléphone : {v('tel_mobile', '78 831 60 60')} / {v('tel_fixe', '33 867 86 46')}</li>
          <li>Email : {v('email', 'centreatlasmedical@gmail.com')}</li>
        </ul>
        <p>Directeur de la publication : {v('directeur')}.</p>
        <h2>Exercice de la médecine</h2>
        <p>Le Centre Médical Atlas est un centre médical privé. Les informations relatives à son autorisation d'exercer et à l'inscription de ses médecins auprès de l'Ordre national des médecins du Sénégal : {v('autorisation')}.</p>
        <h2>Hébergement</h2>
        <p>Le site est hébergé par o2switch, 222 Boulevard Gustave Flaubert, 63000 Clermont-Ferrand, France.</p>
        <h2>Conception et réalisation</h2>
        <p>Site conçu et réalisé par <a href="https://digifab.agency/" target="_blank" rel="noopener">digifab agency</a>.</p>
        <h2>Propriété intellectuelle</h2>
        <p>L'ensemble des contenus du site (textes, logo, photographies, graphismes) est la propriété du Centre Médical Atlas ou utilisé avec l'autorisation de leurs titulaires. Toute reproduction ou réutilisation, totale ou partielle, sans autorisation écrite préalable est interdite.</p>
        <h2>Informations médicales et responsabilité</h2>
        <p>Les informations publiées sur ce site sont données à titre général et pédagogique. Elles ne remplacent ni une consultation, ni un avis médical personnalisé. Le centre s'efforce de fournir des informations exactes et à jour, sans garantie d'exhaustivité.</p>
        <div class="callout"><strong>En cas d'urgence vitale :</strong> n'utilisez pas ce site. Appelez immédiatement le SAMU (1515) ou les sapeurs-pompiers (18), ou rendez-vous aux urgences les plus proches.</div>
        <h2>Liens et services externes</h2>
        <p>Le site peut contenir des liens vers des sites tiers (Google Maps, WhatsApp, réseaux sociaux). Le centre n'est pas responsable de leur contenu ni de leurs pratiques en matière de données personnelles.</p>
        <h2>Données personnelles</h2>
        <p>Le traitement des données personnelles est détaillé dans notre <a href="politique-de-confidentialite.html">politique de confidentialité</a>.</p>
        <h2>Droit applicable</h2>
        <p>Le présent site est soumis au droit sénégalais. En cas de litige, les tribunaux compétents de Dakar sont seuls compétents, sous réserve des règles impératives applicables.</p>'''

PRIVACY = f'''        <p class="text-style-muted">Dernière mise à jour : novembre 2026.</p>
        <p>Le Centre Médical Atlas accorde une grande importance à la confidentialité. Cette page explique quelles données nous collectons sur ce site, pourquoi, et comment vous pouvez exercer vos droits, conformément à la loi n° 2008-12 du 25 janvier 2008 sur la protection des données à caractère personnel.</p>
        <h2>Qui est responsable de vos données ?</h2>
        <p>Le responsable du traitement est {v('raison_sociale', 'Centre Médical Atlas')}, {v('adresse', 'Liberté 6, Dakar')}, Sénégal. Pour toute question : {v('email_donnees', 'centreatlasmedical@gmail.com')}.</p>
        <h2>Quelles données collectons-nous ?</h2>
        <p>Uniquement celles que vous saisissez dans nos formulaires (demande de rendez-vous, contact) :</p>
        <ul>
          <li>nom et prénom, numéro de téléphone, adresse email (facultative) ;</li>
          <li>type de rendez-vous souhaité, médecin et date souhaités ;</li>
          <li>le message que vous choisissez d'écrire.</li>
        </ul>
        <div class="callout"><strong>Important :</strong> ne communiquez pas d'informations médicales détaillées (symptômes, diagnostic, résultats) par ces formulaires. Elles se discutent lors de la consultation.</div>
        <p>Lors de l'envoi d'un formulaire, votre adresse IP est utilisée de façon temporaire, sous forme chiffrée, pour limiter le nombre d'envois et lutter contre le spam.</p>
        <h2>Pourquoi utilisons-nous ces données ?</h2>
        <ul>
          <li>vous rappeler pour confirmer ou organiser un rendez-vous ;</li>
          <li>répondre à votre message ;</li>
          <li>assurer la sécurité du site.</li>
        </ul>
        <p>Nous n'utilisons pas vos données à des fins publicitaires et nous ne les vendons pas. Le traitement repose sur votre consentement, que vous donnez en cochant la case prévue dans chaque formulaire, et sur votre demande de prise de contact.</p>
        <h2>Qui y a accès ?</h2>
        <p>Les données sont destinées à l'équipe du centre (secrétariat et professionnels concernés par votre demande). Notre hébergeur, o2switch (France), les stocke pour notre compte, sans les utiliser pour ses propres besoins.</p>
        <h2>Combien de temps les conservons-nous ?</h2>
        <p>Les demandes sont conservées pendant la durée nécessaire à leur traitement, puis supprimées automatiquement au bout de {v('retention_mois', '12')} mois au maximum.</p>
        <h2>Quels sont vos droits ?</h2>
        <p>Vous disposez d'un droit d'accès, de rectification, d'opposition et de suppression de vos données. Pour les exercer, écrivez-nous à {v('email_donnees', 'centreatlasmedical@gmail.com')} en précisant votre demande ; nous pourrons vous demander de justifier de votre identité. Si vous estimez, après nous avoir contactés, que vos droits ne sont pas respectés, vous pouvez saisir la Commission de Protection des Données Personnelles (CDP) du Sénégal.</p>
        <h2>Cookies et services tiers</h2>
        <p>Ce site n'utilise pas de cookies publicitaires ni d'outil de suivi d'audience. Des cookies strictement techniques peuvent être déposés pour le fonctionnement du site et de son administration.</p>
        <p>La police de caractères est hébergée sur le site lui-même : elle n'entraîne aucun échange avec un service tiers. Sur la page Contact, la carte Google Maps est fournie par Google, qui reçoit votre adresse IP lors de son chargement. Les liens vers WhatsApp et les réseaux sociaux vous redirigent vers leurs services, soumis à leurs propres règles.</p>
        <h2>Sécurité</h2>
        <p>Le site est servi en connexion sécurisée (HTTPS) et l'accès aux demandes est réservé à l'équipe du centre. Aucune transmission par internet n'est totalement sans risque : c'est une raison de plus de ne pas envoyer d'informations médicales par les formulaires.</p>
        <h2>Modification de cette politique</h2>
        <p>Cette page peut être mise à jour, par exemple si nous ajoutons un outil de mesure d'audience. La date de dernière mise à jour figure en haut de page.</p>'''

for slug, h1, inner, title, desc in [
    ('mentions-legales', 'Mentions légales', MENTIONS, 'Mentions légales | Centre Médical Atlas', "Mentions légales du site du Centre Médical Atlas, Liberté 6, Dakar."),
    ('politique-de-confidentialite', 'Politique de confidentialité', PRIVACY, 'Politique de confidentialité | Centre Médical Atlas', "Comment le Centre Médical Atlas protège vos données personnelles : données collectées, durée de conservation et vos droits."),
]:
    open(slug + '.html', 'w').write(page(title, desc, slug + '.html', wrap(h1, inner) + CTA))
print('ok')

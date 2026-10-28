<?php
if (!defined('ABSPATH')) exit;

function atlas_new_articles() {
    return [
        ['slug' => 'fibroscopie', 'title' => 'La fibroscopie digestive : à quoi sert-elle et comment se déroule-t-elle ?', 'cat' => 'Endoscopie', 'excerpt' => 'Indications, préparation, déroulement et suites : tout ce qu\'il faut savoir avant une fibroscopie.', 'days' => 2],
        ['slug' => 'examens-imagerie', 'title' => 'Examens d\'imagerie : échographie, radiographie, scanner, lequel pour quoi ?', 'cat' => 'Imagerie', 'excerpt' => 'Comprendre les différences entre les examens d\'imagerie et savoir comment s\'y préparer.', 'days' => 1],
        ['slug' => 'scanner', 'title' => 'Le scanner : comprendre l\'examen avant de le passer', 'cat' => 'Imagerie', 'excerpt' => 'À quoi sert un scanner, comment s\'y préparer et comment se déroule l\'examen.', 'days' => 0],
    ];
}

/** Articles d'exemple dont le texte était provisoire : titre => identifiant. */
function atlas_fill_articles() {
    return [
        'Brûlures d\'estomac : quand faut-il consulter ?' => 'brulures-estomac',
        'Tension artérielle : les bons réflexes' => 'tension-arterielle',
        'Douleurs du dos : quand s\'en préoccuper ?' => 'douleurs-dos',
        'Comprendre la coloscopie' => 'coloscopie',
        'Le suivi gynécologique : pourquoi consulter régulièrement ?' => 'suivi-gynecologique',
    ];
}

function atlas_article_body($slug) {
    $bodies = [
        'fibroscopie' => <<<'HTML'
<p><strong>La fibroscopie digestive permet au médecin d'observer l'intérieur de l'œsophage, de l'estomac et du début de l'intestin. C'est un examen courant, de courte durée, qui se prépare simplement.</strong></p>
<h2>À quoi sert cet examen ?</h2>
<p>Un fin tuyau souple muni d'une caméra est introduit par la bouche. Le médecin voit directement la muqueuse digestive et peut, si nécessaire, réaliser de petits prélèvements (biopsies) qui ne sont pas douloureux.</p>
<h2>Quand est-elle proposée ?</h2>
<ul>
<li>Brûlures d'estomac ou douleurs persistantes au niveau de l'estomac.</li>
<li>Difficultés à avaler ou vomissements répétés.</li>
<li>Anémie dont la cause n'est pas trouvée.</li>
<li>Suivi d'une maladie digestive déjà connue.</li>
</ul>
<h2>Comment se préparer ?</h2>
<p>Il faut en général être à jeun plusieurs heures avant l'examen. Signalez à l'équipe vos traitements (notamment ceux qui fluidifient le sang), vos allergies et vos antécédents. Les consignes précises vous sont données lors de la prise de rendez-vous.</p>
<div class="callout"><strong>Bon à savoir :</strong> si une sédation est prévue, venez accompagné(e). Vous ne devez pas conduire le reste de la journée.</div>
<h2>Comment se déroule l'examen ?</h2>
<p>Vous êtes allongé(e) sur le côté. Selon le protocole du centre et l'avis du médecin, la gorge est anesthésiée et/ou une sédation est proposée. L'examen dure quelques minutes. Le médecin vous explique ce qu'il fait et répond à vos questions.</p>
<h2>Et après ?</h2>
<p>Une courte période de surveillance est prévue. Le médecin vous donne les premières conclusions et vous explique les suites. Il vous indique aussi quand reprendre une alimentation normale.</p>
<p class="text-size-small text-style-muted">Cet article a une visée informative et ne remplace pas l'avis de votre médecin.</p>
HTML,
        'examens-imagerie' => <<<'HTML'
<p><strong>Échographie, Doppler, radiographie, scanner : ces examens regardent le corps de façons différentes. C'est votre médecin qui choisit le plus adapté à votre situation.</strong></p>
<h2>L'échographie</h2>
<p>Elle utilise des ultrasons, sans rayons X. Elle permet d'observer de nombreux organes (abdomen, pelvis, thyroïde, seins…) et de suivre une grossesse. L'examen est indolore.</p>
<h2>Le Doppler</h2>
<p>C'est une échographie spécialisée qui étudie la circulation du sang dans les artères et les veines, par exemple en cas de jambes lourdes ou gonflées.</p>
<h2>La radiographie</h2>
<p>Elle utilise une faible dose de rayons X pour obtenir une image des os, des articulations ou du thorax. Elle est rapide : quelques secondes par image.</p>
<h2>Le scanner</h2>
<p>Il produit des coupes très détaillées du corps à l'aide de rayons X. Il sera bientôt disponible au Centre Atlas : nous l'indiquerons sur le site dès son ouverture.</p>
<h2>Comment bien se préparer ?</h2>
<ul>
<li>Apportez votre ordonnance et vos anciens examens d'imagerie.</li>
<li>Suivez les consignes données lors du rendez-vous (jeûne, vessie pleine, etc.).</li>
<li>Signalez toute possibilité de grossesse avant un examen utilisant des rayons X.</li>
</ul>
<div class="callout"><strong>Bon à savoir :</strong> chaque examen est expliqué avant sa réalisation. N'hésitez pas à poser vos questions à l'équipe.</div>
<p class="text-size-small text-style-muted">Cet article a une visée informative et ne remplace pas l'avis de votre médecin.</p>
HTML,
        'scanner' => <<<'HTML'
<p><strong>Le scanner sera prochainement disponible au Centre Médical Atlas. En attendant son ouverture, voici ce qu'il faut savoir sur cet examen.</strong></p>
<h2>À quoi sert un scanner ?</h2>
<p>Le scanner réalise des images en coupes de la zone examinée, avec un niveau de détail élevé. Il aide votre médecin à comprendre l'origine de certains symptômes ou à suivre une maladie.</p>
<h2>Comment se préparer ?</h2>
<p>La préparation dépend de la zone examinée. Elle peut comprendre un jeûne de quelques heures. Si une injection de produit de contraste est prévue, signalez vos allergies, vos problèmes rénaux, vos traitements et toute possibilité de grossesse. Apportez votre ordonnance et vos anciens examens.</p>
<div class="callout"><strong>Bon à savoir :</strong> les consignes précises vous seront communiquées par l'équipe lors de la prise de rendez-vous, dès l'ouverture du service.</div>
<h2>Comment se déroule l'examen ?</h2>
<p>Vous êtes allongé(e) sur une table qui glisse doucement dans un anneau ouvert. Il faut rester immobile pendant quelques minutes. Si un produit de contraste est injecté, une sensation de chaleur passagère est possible. L'examen est indolore.</p>
<h2>Et après ?</h2>
<p>Vous pouvez en général reprendre vos activités. Si un produit de contraste a été utilisé, l'équipe vous donne les consignes à suivre ensuite. Le compte rendu est transmis à votre médecin et le radiologue vous explique les résultats.</p>
<p class="text-size-small text-style-muted">Cet article a une visée informative et ne remplace pas l'avis de votre médecin.</p>
HTML,
        'brulures-estomac' => <<<'HTML'
<p><strong>Les brûlures d'estomac sont très fréquentes et le plus souvent sans gravité. Certains signes doivent cependant conduire à consulter.</strong></p>
<h2>Que ressent-on ?</h2>
<p>Il s'agit d'une sensation de brûlure qui remonte derrière le sternum, parfois accompagnée d'un goût acide dans la bouche ou de remontées après les repas.</p>
<h2>Quelles sont les causes fréquentes ?</h2>
<p>Elles peuvent être liées à un reflux de l'acidité de l'estomac vers l'œsophage, à une irritation de l'estomac, à certains aliments ou boissons, au tabac, au stress ou à la prise de certains médicaments. Seul un médecin peut en préciser l'origine.</p>
<h2>Quand faut-il consulter ?</h2>
<ul>
<li>Les brûlures durent depuis plus de quelques semaines ou reviennent souvent.</li>
<li>Vous avez du mal à avaler ou vous vomissez de façon répétée.</li>
<li>Vous perdez du poids sans raison.</li>
<li>Vous remarquez des selles noires ou du sang dans les vomissements.</li>
</ul>
<div class="callout"><strong>À ne pas attendre :</strong> une douleur intense dans la poitrine, avec essoufflement ou malaise, nécessite un avis médical immédiat.</div>
<h2>Que peut proposer le médecin ?</h2>
<p>Il vous interroge, vous examine, puis peut proposer un traitement adapté. Si les symptômes persistent ou si certains signes l'exigent, une fibroscopie digestive peut être indiquée pour observer directement l'œsophage et l'estomac.</p>
<h2>Quelques conseils au quotidien</h2>
<ul>
<li>Fractionnez les repas et évitez les repas très copieux ou très gras.</li>
<li>Limitez l'alcool et le tabac.</li>
<li>Évitez de vous allonger juste après avoir mangé.</li>
</ul>
<p class="text-size-small text-style-muted">Cet article a une visée informative et ne remplace pas l'avis de votre médecin.</p>
HTML,
        'tension-arterielle' => <<<'HTML'
<p><strong>L'hypertension artérielle est souvent silencieuse. La surveiller et savoir la mesurer correctement permet d'agir tôt pour protéger le cœur et les vaisseaux.</strong></p>
<h2>Pourquoi la surveiller ?</h2>
<p>Une tension trop élevée ne provoque pas toujours de symptômes. Sur la durée, elle peut pourtant fatiguer le cœur, les artères et les reins. C'est pourquoi un contrôle régulier est important, surtout en cas d'antécédents familiaux.</p>
<h2>Comment la mesurer correctement ?</h2>
<ul>
<li>Restez assis(e), le dos soutenu, pendant 5 minutes avant la mesure.</li>
<li>Posez le bras à hauteur du cœur, avec un brassard adapté à votre bras.</li>
<li>Ne parlez pas, ne croisez pas les jambes, évitez café et tabac dans la demi-heure qui précède.</li>
<li>Notez vos résultats matin et soir pendant plusieurs jours, et montrez-les à votre médecin.</li>
</ul>
<h2>Que signifient les chiffres ?</h2>
<p>La tension s'exprime avec deux valeurs, par exemple 120/80. Des mesures régulièrement élevées justifient un avis médical. C'est votre médecin qui définit vos objectifs selon votre situation.</p>
<div class="callout"><strong>Important :</strong> ne modifiez pas et n'arrêtez pas un traitement sans l'avis de votre médecin, même si vos chiffres sont bons.</div>
<h2>Quand consulter sans attendre ?</h2>
<p>En cas de maux de tête intenses, de troubles de la vision, de douleur dans la poitrine ou d'essoufflement inhabituel, consultez rapidement.</p>
<h2>Les bons réflexes</h2>
<ul>
<li>Réduire le sel et les aliments très transformés.</li>
<li>Bouger régulièrement et surveiller son poids.</li>
<li>Limiter l'alcool et ne pas fumer.</li>
</ul>
<p class="text-size-small text-style-muted">Cet article a une visée informative et ne remplace pas l'avis de votre médecin.</p>
HTML,
        'douleurs-dos' => <<<'HTML'
<p><strong>Le mal de dos est l'un des motifs de consultation les plus fréquents. Dans la majorité des cas, il passe en quelques semaines, mais certains signes doivent alerter.</strong></p>
<h2>Une douleur fréquente, souvent bénigne</h2>
<p>Les douleurs du bas du dos, ou lombalgies, sont très courantes. Elles surviennent souvent après un effort, une mauvaise posture ou une période de fatigue, et s'améliorent généralement en quelques jours à quelques semaines.</p>
<h2>Les bons gestes du quotidien</h2>
<ul>
<li>Restez actif : un repos complet prolongé n'est en général pas recommandé.</li>
<li>Pour porter une charge, fléchissez les genoux et gardez le dos droit.</li>
<li>Variez les positions et évitez de rester trop longtemps assis ou debout.</li>
<li>La chaleur peut soulager temporairement les muscles du dos.</li>
</ul>
<h2>Quand consulter ?</h2>
<ul>
<li>La douleur dure plus de quatre à six semaines ou s'aggrave.</li>
<li>Elle vous réveille la nuit ou ne cède pas au repos.</li>
<li>Vous ressentez des fourmillements ou une faiblesse dans une jambe.</li>
<li>Vous avez de la fièvre ou vous maigrissez sans raison.</li>
<li>La douleur suit une chute ou un choc.</li>
</ul>
<div class="callout"><strong>Urgence :</strong> une perte de force importante, des difficultés à contrôler les urines ou les selles nécessitent un avis médical immédiat.</div>
<h2>Que peut proposer le médecin ?</h2>
<p>Après l'examen, il peut demander une radiographie ou une échographie si elles sont utiles, puis proposer un traitement, des conseils adaptés et, si besoin, de la rééducation.</p>
<p class="text-size-small text-style-muted">Cet article a une visée informative et ne remplace pas l'avis de votre médecin.</p>
HTML,
        'coloscopie' => <<<'HTML'
<p><strong>La coloscopie permet d'observer l'intérieur du côlon. Bien comprise et bien préparée, c'est un examen sûr et de durée limitée.</strong></p>
<h2>À quoi sert-elle ?</h2>
<p>Un endoscope souple, muni d'une caméra, est introduit par l'anus. Le médecin voit directement la paroi du côlon, peut retirer de petites lésions ou réaliser des prélèvements si nécessaire.</p>
<h2>Quand est-elle proposée ?</h2>
<ul>
<li>Présence de sang dans les selles.</li>
<li>Troubles du transit qui durent, douleurs abdominales persistantes.</li>
<li>Dépistage ou surveillance, selon l'âge et les antécédents personnels ou familiaux.</li>
</ul>
<h2>Comment se préparer ?</h2>
<p>La préparation est indispensable : pour que l'examen soit fiable, le côlon doit être propre. Elle comprend en général une alimentation adaptée les jours précédents et une solution à boire la veille, selon les consignes de l'équipe. Signalez vos traitements, notamment ceux qui fluidifient le sang, et vos maladies chroniques comme le diabète.</p>
<div class="callout"><strong>Bon à savoir :</strong> suivez la préparation à la lettre. C'est elle qui conditionne la qualité de l'examen.</div>
<h2>Comment se déroule l'examen ?</h2>
<p>Selon le protocole du centre et l'avis du médecin, une sédation peut être proposée. L'examen dure en général entre 20 et 45 minutes. Le médecin vous explique chaque étape.</p>
<h2>Et après ?</h2>
<p>Une période de surveillance est prévue. Quelques ballonnements peuvent persister un moment. Venez accompagné(e) si une sédation a été réalisée. Le médecin vous explique les résultats et les suites.</p>
<p class="text-size-small text-style-muted">Cet article a une visée informative et ne remplace pas l'avis de votre médecin.</p>
HTML,
        'suivi-gynecologique' => <<<'HTML'
<p><strong>Consulter un(e) gynécologue n'est pas réservé aux problèmes : c'est aussi un rendez-vous de prévention, pour être accompagnée à chaque étape de la vie.</strong></p>
<h2>Pourquoi consulter régulièrement ?</h2>
<p>Le suivi permet de parler de contraception, de dépistage, de désir de grossesse, de douleurs ou de changements du cycle, mais aussi de la ménopause. Il offre un espace d'écoute, en toute confidentialité.</p>
<h2>Quand prendre rendez-vous ?</h2>
<ul>
<li>Règles très douloureuses, irrégulières ou anormalement abondantes.</li>
<li>Saignements en dehors des règles ou pertes inhabituelles.</li>
<li>Douleurs dans le bas-ventre.</li>
<li>Souhait de contraception, désir de grossesse ou suivi de grossesse.</li>
</ul>
<h2>Comment se déroule la consultation ?</h2>
<p>Le médecin commence par un échange sur vos questions et vos antécédents. Chaque geste est expliqué avant d'être réalisé. Une échographie pelvienne peut être proposée si elle est utile. Vous restez libre de poser toutes vos questions.</p>
<div class="callout"><strong>Au Centre Atlas :</strong> les consultations de gynécologie ont lieu le lundi de 15h à 18h, sur rendez-vous.</div>
<h2>Pour bien préparer votre visite</h2>
<ul>
<li>Notez la date de vos dernières règles.</li>
<li>Apportez vos anciens examens et la liste de vos traitements.</li>
<li>Préparez vos questions pour ne rien oublier.</li>
</ul>
<p class="text-size-small text-style-muted">Cet article a une visée informative et ne remplace pas l'avis de votre médecin.</p>
HTML,
    ];
    return isset($bodies[$slug]) ? $bodies[$slug] : '';
}

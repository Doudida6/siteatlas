"""Horaires du centre (source unique pour la maquette ; le thème WordPress les reprend en valeur par défaut)."""
LINES = [
    "Ouverture du centre : lundi au vendredi, 9h - 18h ; samedi, 9h - 14h",
    "Gynécologie : lundi, 15h - 18h",
    "Cardiologie : mercredi, 15h - 18h",
    "Diabétologie : samedi, 9h - 14h",
]
HTML = '<span class="hours">' + '<br>'.join(LINES) + '</span>'

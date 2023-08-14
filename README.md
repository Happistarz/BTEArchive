# BTEArchive
--- 
Ajouter COORDS, INSEE sur la table PROJET
pour afficher avec google map un iframe de la ville
exemple:
<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d22031.910201123133!2d0.2476997698941539!3d46.349767173252474!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47fde63174d697bf%3A0x405d39260e7abd0!2s86700%20Anch%C3%A9!5e0!3m2!1sfr!2sfr!4v1691997716799!5m2!1sfr!2sfr" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>

https://maps.googleapis.com/maps/api/staticmap?center=40.714728,-73.998672&zoom=12&size=400x400&key=YOUR_API_KEY&signature=YOUR_SIGNATURE
https://maps.googleapis.com/maps/api/staticmap?center=40.714728,-73.998672&zoom=14&size=400x400&key=YOUR_API_KEY&signature=YOUR_SIGNATURE

API key: AIzaSyAcApxyI9DkY8gXJarGgBOlmBhso-JmN6o
https://developers.google.com/maps/documentation/maps-static/start?hl=fr

le center peut etre une recherche comme: center=Anché
ou un lieu mais formaté avec les espaces remplacé par '+'
zoom de 12
size de 400x400

--- 
Changer REGION PAR CODEP et mettre le code du département
exemple:
CODEP: 86200
ensuite faire un dict de code => display nom
et fetch l'image de la region et la mettre en banner du projet quand on va sur la page

---
pour le cache:
ne pas mettre en cache les pages de villes car sinon les nouvelles modifs sont pas visibles pendant x temps
juste mettre en cache le result du query/exec pendant - de 10min (a voir)
[php cache exemple](https://www.sitepoint.com/php-cache/)
utiliser apc_store() et apc_fetch()

---
Apres la validation de la creation, request sur ce site [geo api gouv](https://geo.api.gouv.fr/decoupage-administratif/communes) pour les stocké dans la bdd
requete complete des infos qu'il faudrait : 'https://geo.api.gouv.fr/communes?nom=Versailles&fields=code,nom,mairie,siren,codeDepartement,departement,codeRegion,codesPostaux,population,region'
on peut rechercher par COORD, NOM, DEP et mix

---
Pour chaque ville, faire un nombre d'onglet correspondant au nombre de warp, chaque onglet aura des images et les buildeurs associés.

---
Connexion API [minotar](https://minotar.net/)
pour avoir une representation graphique des joueurs
https://minotar.net/armor/body/user/100.png changer 'user' par l'input du joueur/uuid

---
Page d'acceuil:
Affichage de tout les projets
filtres: ETAT, REGION, NB DE BUILDEUR
affichage par card en grid de 3 en horizontal et 10 en verticale qu'on peut etendre
btn pour charger plus

---
Page Liste: 
liste les pages trouvés par NOM, INSEE, CODEP
TYPE DE PAGE: Commune, Warp, Projet du type montagne, station, gare, etc

---
Page Projet:
COORDS
warps,
buildeurs
banner du DEP

---
Page Commune:
banner du DEP
carte google map
info de la ville
liste des warps + nb warp
nb de buildeur + liste des buildeurs,

---
# ORGA TABLE
BUILDEUR:
ID
IDPROJET
NOM
URLICON

PROJET:
ID
TYPE (COMMUNE, PROJET, WARP)
NOM
DESC
COORDS
REGION
ETAT
DATE

WARP:
IDPROJET
NOM
TYPE (PRINCPAL, SECONDAIRE)
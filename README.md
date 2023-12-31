# BTEArchive

BTEArchive est une idée de site d'archive pour le projet BTE France sur Minecraft. Se site ne sera pas en ligne, c'était un projet pour tester mes compétences en BTS SIO 1ère année. [Lien vers BTE France](https://buildtheearth.net/bte-france)

**Le Reste du README est un TODO Liste**

--- 
Ajouter COORDS, INSEE sur la table PROJET
pour afficher avec google map un iframe de la ville
exemple:

<iframe width="600" height="400" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" sandbox="allow-forms allow-scripts allow-same-origin" src="https://www.geoportail.gouv.fr/embed/visu.html?c=0.266497,46.343612&z=16&v0=PLAN.IGN::GEOPORTAIL:GPP:TMS(1;s:classique)&l1=GEOGRAPHICALGRIDSYSTEMS.PLANIGNV2::GEOPORTAIL:OGC:WMTS(0.87)&permalink=yes" allowfullscreen></iframe>
<!-- lat:0.266497 lon: 46.343612 -->
<!-- zoom: popu * 0.1  ///// A VOIR PRSK CA MARCHE PAS-->

ENREGIRSTRER LES COORDS SOUS FORMAT: 'LAT,LON'
zoom de 16
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
https://minotar.net/avatar/user/100.png changer 'user' par l'input du joueur/uuid

---
Page d'acceuil:
Affichage de tout les projets
filtres: ETAT, REGION, NB DE BUILDEUR
affichage par card en grid de 3 en horizontal et 10 en verticale qu'on peut etendre
btn pour charger plus
https://codepen.io/anthony_718/pen/ExgyKGr

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
https://www.w3schools.com/howto/tryit.asp?filename=tryhow_js_full_page_tabs
tab avec carrousel d'image du projet
    desc
    coords
nom du fichier = nom du projet + unique index len 3
https://www.w3schools.com/howto/tryit.asp?filename=tryhow_js_copy_clipboard2
<span data-tooltip="Tooltip help here!" data-flow="right">CSS Tooltips</span>
[data-tooltip] {
  position: relative;
  cursor: pointer;
}
[data-tooltip]:before,
[data-tooltip]:after {
  line-height: 1;
  font-size: .9em;
  pointer-events: none;
  position: absolute;
  box-sizing: border-box;
  display: none;
  opacity: 0;
}
[data-tooltip]:before {
  content: "";
  border: 5px solid transparent;
  z-index: 100;
}
[data-tooltip]:after {
  content: attr(data-tooltip);
  text-align: center;
  min-width: 3em;
  max-width: 21em;
  white-space: nowrap;
  overflow: hidden;
  text-overflow: ellipsis;
  padding: 15px 15px;
  border-radius: 14px;
  background: #A8C5FF;
  color: #000000;
  z-index: 99;
}
[data-tooltip]:hover:before,
[data-tooltip]:hover:after {
  display: block;
  opacity: 1;
}
[data-tooltip]:not([data-flow])::before,
[data-tooltip][data-flow="top"]::before {
  bottom: 100%;
  border-bottom-width: 0;
  border-top-color: #A8C5FF;
}
[data-tooltip]:not([data-flow])::after,
[data-tooltip][data-flow="top"]::after {
  bottom: calc(100% + 5px);
}
[data-tooltip]:not([data-flow])::before, [tooltip]:not([data-flow])::after,
[data-tooltip][data-flow="top"]::before,
[data-tooltip][data-flow="top"]::after {
  left: 50%;
  -webkit-transform: translate(-50%, -4px);
          transform: translate(-50%, -4px);
}
[data-tooltip][data-flow="bottom"]::before {
  top: 100%;
  border-top-width: 0;
  border-bottom-color: #A8C5FF;
}
[data-tooltip][data-flow="bottom"]::after {
  top: calc(100% + 5px);
}
[data-tooltip][data-flow="bottom"]::before, [data-tooltip][data-flow="bottom"]::after {
  left: 50%;
  -webkit-transform: translate(-50%, 8px);
          transform: translate(-50%, 8px);
}
[data-tooltip][data-flow="left"]::before {
  top: 50%;
  border-right-width: 0;
  border-left-color: #A8C5FF;
  left: calc(0em - 5px);
  -webkit-transform: translate(-8px, -50%);
          transform: translate(-8px, -50%);
}
[data-tooltip][data-flow="left"]::after {
  top: 50%;
  right: calc(100% + 5px);
  -webkit-transform: translate(-8px, -50%);
          transform: translate(-8px, -50%);
}
[data-tooltip][data-flow="right"]::before {
  top: 50%;
  border-left-width: 0;
  border-right-color: #A8C5FF;
  right: calc(0em - 5px);
  -webkit-transform: translate(8px, -50%);
          transform: translate(8px, -50%);
}
[data-tooltip][data-flow="right"]::after {
  top: 50%;
  left: calc(100% + 5px);
  -webkit-transform: translate(8px, -50%);
          transform: translate(8px, -50%);
}
[data-tooltip=""]::after, [data-tooltip=""]::before {
  display: none !important;
}

icon du DEP
carte google map
info de la ville
liste des warps + nb warp
nb de buildeur + liste des buildeurs,

---
# ORGA TABLE
BUILDEUR:
ID
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

IMAGE:
ID
IDPROJET
SRC


---
Mise en cache Builder et screenshots:


SCREENSHOTS: 
Créez un fichier .htaccess dans le répertoire de vos images (ou utilisez la configuration du serveur web si vous préférez) pour spécifier les en-têtes de mise en cache. Assurez-vous que le module mod_expires est activé sur votre serveur Apache.
# Active la compression et définit des en-têtes de cache
<IfModule mod_expires.c>
    ExpiresActive On
    ExpiresByType image/jpeg "access plus 1 year"
    ExpiresByType image/png "access plus 1 year"
    ExpiresByType image/gif "access plus 1 year"
    ExpiresByType image/svg+xml "access plus 1 year"
    ExpiresByType text/css "access plus 1 month"
    ExpiresByType application/javascript "access plus 1 month"
</IfModule>
Assurez-vous que le fichier .htaccess est activé sur votre serveur. Vous pouvez le vérifier dans le fichier de configuration d'Apache (httpd.conf) en vous assurant que la directive AllowOverride est définie sur All pour le répertoire concerné.

Lorsque les navigateurs demandent les images, les en-têtes de mise en cache spécifiés dans le fichier .htaccess indiqueront combien de temps ces images doivent être conservées en cache dans le navigateur de l'utilisateur.

BUILDER:
<img src="URL_DE_L_IMAGE" alt="Image" cache-control="max-age=600">

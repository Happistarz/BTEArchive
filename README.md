# BTEArchive
--- 
Ajouter COORDS sur la table PROJET
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
Changer REGION PAR DEPARTEMENT et mettre le code du département
exemple:
REGION: 86
ensuite faire un dict de code => display nom
et fetch l'image de la region et la mettre en banner du projet quand on va sur la page

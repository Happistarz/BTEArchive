<?php
require 'models/functions.php';
# Init a cURL session
$curl = curl_init("https://geo.api.gouv.fr/communes?nom=Poitiers&fields=code,nom,mairie,siren,codeDepartement,departement,codeRegion,codesPostaux,population,region");

# Set options on the session
curl_setopt_array($curl, [
  CURLOPT_CAINFO => dirname(__FILE__) . '/geo_cert.crt',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_TIMEOUT_MS => 2000
]);

# exec the session and get the results
$data = curl_exec($curl);
if ($data === false) {
  var_dump(curl_error($curl));
} else if (curl_getinfo($curl, CURLINFO_HTTP_CODE) === 200) {
  # decode the json string to an object
  $data = json_decode($data, true);
  // print_r($data);
} else {
  var_dump(curl_getinfo($curl, CURLINFO_HTTP_CODE));
}

# close the session
curl_close($curl);

function convertGEO($data)
{
  $code = $data['departement']['code'];
  $name = join("-", explode(" ", strtolower($data['departement']['nom'])));
  $src = $code . "-logo-" . $name . ".png";
  echo "<img src='src/LOGODEPFR/icones-300px/$src' />";
}
// convertGEO($data[0]);

// $source = "cache/" . uniqid("icon") . ".png";
// $fh = fopen($source, "w");
// $curl = curl_init("https://minotar.net/helm/FuzeIII/100.png");

// // # Set options on the session
// curl_setopt_array($curl, [
//   CURLOPT_CAINFO => dirname(__FILE__) . '/geo_cert.crt',
//   CURLOPT_FILE => $fh,
//   CURLOPT_TIMEOUT_MS => 2000
// ]);

// if (!curl_errno($curl)) {
//   $info = curl_getinfo($curl);
//   // var_dump($info);
// }

// curl_exec($curl);
// curl_close($curl);
// fclose($fh);
// echo "<img src='$source' />";
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>

<body>
  <?php require('vue/loader.php');
  require('vue/header.php'); ?>
  <main class='insertmain'>
    <h1 style='margin:50px 0;font-size: 40px;'>Création du projet</h1>
    <form action="" method="post">
      <div class="infocreation">

        <div class="type">
          <input type="button" value="Commune" class='btnactive'>
          <input type="button" value="Projet">
          <input type="button" value="Warp">
        </div>
        <div class="item">
          <label for="nom" id='labelnom'>Nom de la Commune</label>
          <input type="text" name="nom" id="nom" placeholder="Nom de la Commune">
        </div>
        <div class="item">
          <label for="warp" id='labelwarp'>Nom du Warp</label>
          <input type="text" name="warp" id="warp" placeholder='Nom du warp'>
        </div>

        <div class="item">
          <label for="etat" id='labeletat'>Etat du projet</label>
          <select name="etat" id="etat">
            <option value="1" selected>Démarrage</option>
            <option value="2">En cours</option>
            <option value="3">Avancé</option>
            <option value="4">Terminé</option>
          </select>
        </div>
      </div>
      <div class='infocreation buildercreation'>
        <div class="item">
          <label for="builder">Ajouter un buildeur à la liste</label>
          <input type="text" name="builder" id="builder" placeholder="Nom sur Minecraft">
        </div>
        <div class='listebuilder'>
          <div class='builder'>
            <img src="https://minotar.net/helm/FuzeIII/100.png" alt="">
            <p>FuzeIII</p>
            <span>X</span>
          </div>
        </div>
      </div>
      <input type="submit" value="submit">
    </form>
  </main>
</body>
<script>
  var commune_btn = document.querySelector('.type input:nth-child(1)');
  var projet_btn = document.querySelector('.type input:nth-child(2)');
  var warp_btn = document.querySelector('.type input:nth-child(3)');

  var list = [commune_btn, projet_btn, warp_btn]

  var nom = document.querySelector('#nom');
  var labelnom = document.querySelector('#labelnom');
  var warp = document.querySelector('#warp');
  var etat = document.querySelector('#etat');
  commune_btn.addEventListener('click', () => {
    nom.innerHTML = 'Nom de la Commune';
    nom.setAttribute('placeholder', 'Nom de la Commune');
    labelnom.innerHTML = 'Nom de la Commune';
    list.forEach(element => {
      element == commune_btn ? element.classList.add('btnactive') : element.classList.remove('btnactive');
    });
  })
  projet_btn.addEventListener('click', () => {
    nom.innerHTML = 'Nom du Projet';
    nom.setAttribute('placeholder', 'Nom du Projet');
    labelnom.innerHTML = 'Nom du Projet';
    list.forEach(element => {
      element == projet_btn ? element.classList.add('btnactive') : element.classList.remove('btnactive');
    });
  })
  warp_btn.addEventListener('click', () => {
    nom.innerHTML = 'Nom du Warp';
    nom.setAttribute('placeholder', 'Nom du Projet');
    labelnom.innerHTML = 'Nom du Projet';
    list.forEach(element => {
      element == warp_btn ? element.classList.add('btnactive') : element.classList.remove('btnactive');
    });
  })
  nom.addEventListener('keyup', () => {
    if (nom.value.length == 0) {
      warp.setAttribute('placeholder', 'Nom du warp');
      return;
    }
    let re = nom.value.replace(/[^a-zA-z_]+/gi, '');
    warp.setAttribute('placeholder', re);
  })
</script>

</html>
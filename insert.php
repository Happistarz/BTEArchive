<?php
require 'models/functions.php';
require 'models/DataBase.php';
# Init a cURL session


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
    <form method="post" id='insertform'>
      <div class="infocreation">

        <div class="type">
          <input type="button" value="COMMUNE" class='btnactive'>
          <input type="button" value="PROJET">
          <input type="button" value="WARP">
        </div>
        <div class="item">
          <label for="nom" id='labelnom'>Nom de la Commune</label>
          <input type="text" name="nom" id="nom" placeholder="Nom de la Commune" required>
          <input type="text" name="dep" id="dep" placeholder="Numéro du département" required>
        </div>
        <div class="item">
          <label for="labeldesc">Description</label>
          <textarea name="desc" id="desc" cols="30" rows="10" placeholder='Description'></textarea>
        </div>
        <div class="item">
          <label for="warp" id='labelwarp'>Nom du Warp</label>
          <input type="text" name="warp" id="warp" placeholder='Nom du warp' required>
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
          <input type="text" name="builder" id="builder" placeholder="Nom sur Minecraft" required>
        </div>
        <div class='listebuilder'>
          <p id="default"><u><i>Pas de Builder ajoutée...</i></u></p>
        </div>
      </div>
      <input type="submit" value="Valider">
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
    nom.setAttribute('placeholder', 'Nom du Warp');
    labelnom.innerHTML = 'Nom du Warp';
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
    warp.value = re;
    // warp.setAttribute('placeholder', re);
  });

  ///// BUILDER SECTION /////

  var builderinput = document.querySelector('#builder');
  var listebuilder = [];
  var builderform = document.querySelector('#builderform');

  builderinput.onkeydown = function (e) {
    if (e.keyCode == 13) {
      e.preventDefault();
      if (builderinput.value.length == 0) {
        return;
      }
      let re = builderinput.value.replace(/[^a-zA-Z0-9_]+/gi, '');

      // Ajouter les données au format JSON à la liste
      listebuilder.push({
        buildernom: re,
        buildericon: `https://minotar.net/helm/${re}/100.png`
      });


      isEmptyBuilder();

      let builder = document.createElement('div');
      builder.classList.add('builder');
      builder.innerHTML = `<img src="https://minotar.net/helm/${re}/100.png" alt=""><p>${re}</p><span onclick="deleteEL(this);">X</span>`;
      document.querySelector('.listebuilder').appendChild(builder);
      builderinput.value = '';
    }
  }

  // Fonction pour supprimer un élément de la liste
  function deleteEL(el) {
    const index = Array.from(el.parentNode.parentNode.children).indexOf(el.parentNode);

    // Supprimer l'élément de la liste
    listebuilder.splice(index, 1);

    // Supprimer l'élément HTML de la liste
    el.parentNode.remove();

    isEmptyBuilder();
  }

  function isEmptyBuilder() {
    listebuilder.length == 0 ? document.querySelector('#default').style.display = 'block' : document.querySelector('#default').style.display = 'none';
  }

  document.querySelector("#insertform").addEventListener('submit', (e) => {
    e.preventDefault();
    let form = document.querySelector('#insertform');
    let data = new FormData(form);

    data.append('type', document.querySelector('.type .btnactive').value);

    console.log(listebuilder);
    for (let index = 0; index < listebuilder.length; index++) {
      data.append(index, JSON.stringify(listebuilder[index]));
    }

    let xhr = new XMLHttpRequest();
    xhr.open('POST', 'enregistrement.php', true);
    xhr.onload = function () {
      if (this.status == 200) {
        var result = this.responseText
        if (result.success) {
          // window.location.href = 'index.php';
        } else {
          alert('Erreur lors de la création... Veuillez contacter le support sur discord.');
        }
      }
    }
    xhr.send(data);
  })
</script>

</html>
<?php require('models\functions.php'); ?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>

<body>
</body>
<?php
require('vue/loader.php');
require('vue/header.php'); ?>
<div class="banner">
  <h1>Archives.</h1>
</div>
<main class='mainindex'>
  <div class="filtre">
    <button class="FILTRE-TAG FILTRE-TAG-SELECTED" style='margin-left:10px;'>TOUT</button>
    <button class="FILTRE-TAG">ETAT</button>
    <button class="FILTRE-TAG">TYPE</button>
    <button class="FILTRE-TAG">DEPARTEMENT</button>
    <button class="FILTRE-TAG">NOMBRE DE BUILDEURS</button>
  </div>
  <div class="cards">
  </div>
  <div class="spinner"></div>

  <style>
    .spinner {
      position: relative;
      margin: 0 auto;

      width: 72px;
      height: 72px;
      border-radius: 50%;
      border: 11.5px solid;
      border-color: #dbdcef;
      border-right-color: #474bff;
      animation: spinner-d3wgkg 1.2s infinite linear;
    }

    @keyframes spinner-d3wgkg {
      to {
        transform: rotate(1turn);
      }
    }
  </style>
</main>
<div style="height:1500px;"></div>
<?php echo createTAG("Anché", "#") ?>
<?php echo createLINK("Anché", "#") ?>
<script>

  var start = 0;
  var limit = 12;

  const buttons = document.querySelectorAll(".FILTRE-TAG");
  buttons.forEach(button => {
    button.addEventListener("click", () => {
      let tag = button.innerHTML;
      var xhr = new XMLHttpRequest();
      xhr.open('GET', 'listeprojet.php?tag=' + tag + "&start=" + start + "&limit=" + limit, true);
      xhr.onload = function () {
        if (this.status == 200) {
          var result = JSON.parse(this.responseText);
          console.log(result);
          if (result.success) {
            var cards = document.querySelector('.cards');
            cards.innerHTML = "";
            result.card.forEach(element => {
              cards.innerHTML += element;
            });
          } else {
            var body = document.querySelector('.cards');
            body.innerHTML = "<h1>Erreur: " + result.error + "</h1>";
          }
        }
      }
      xhr.send();
      buttons.forEach(button => {
        button.classList.remove("FILTRE-TAG-SELECTED");
      });
      button.classList.add("FILTRE-TAG-SELECTED");
    });
  });

  window.addEventListener('DOMContentLoaded', (event) => {
    var xhr = new XMLHttpRequest();
    xhr.open('GET', 'listeprojet.php?tag=TOUT&start=0&limit=' + limit, true);
    xhr.onload = function () {
      if (this.status == 200) {
        var result = JSON.parse(this.responseText);
        console.log(result);
        if (result.success) {
          var cards = document.querySelector('.cards');
          cards.innerHTML = "";
          result.card.forEach(element => {
            cards.innerHTML += element;
          });
        } else {
          var body = document.querySelector('.cards');
          body.innerHTML = "<h1>Erreur: " + result.error + "</h1>";
        }
      }
    }
    xhr.send();
  });
</script>


</html>
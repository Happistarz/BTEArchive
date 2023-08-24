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
// require('vue/loader.php');
require('vue/header.php'); ?>
<div class="banner">
  <h1>Archives.</h1>
</div>
<main class='mainindex'>
  <div class="filtre">
    <button class="FILTRE-TAG FILTRE-TAG-SELECTED" style='margin-left:10px;'
      onclick='triggerTag(this,"TOUT");'>TOUT</button>
    <button class="FILTRE-TAG" onclick="triggerTag(this,'ETAT');">ETAT</button>
    <button class="FILTRE-TAG" onclick="triggerTag(this,'TYPE');">TYPE</button>
    <button class="FILTRE-TAG" onclick="triggerTag(this,'DEPARTEMENT');">DEPARTEMENT</button>
    <button class="FILTRE-TAG" onclick="triggerTag(this,'NOMBRE DE BUILDEURS');">NOMBRE DE BUILDEURS</button>
  </div>
  <div class="cards">
  </div>
  <div class="spinner"></div>

  <style>
    .spinner {
      position: relative;
      margin: 0 auto;
      display: none;
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
<script>
  var start = 0;
  var limit = 12;
  var sort = 'ASC';
  var lastTag = document.querySelector('.FILTRE-TAG-SELECTED');
  var lastName = "TOUT";
  var arrowList = ['▲', '▼'];
  var sortList = ['ASC', 'DESC'];
  var is_asc = true;
  var it = 0;
  var spinner = document.querySelector('.spinner');


  function triggerTag(el, name) {
    var tags = document.querySelectorAll('.FILTRE-TAG'); // Ajoutez la classe "tag" à vos boutons de filtre

    tags.forEach(function (tag) {
      tag.classList.remove('FILTRE-TAG-SELECTED');
      tag.innerHTML = tag.innerHTML.replace(' ▲', '').replace(' ▼', '');
    });

    el.classList.add('FILTER-TAG-SELECTED');
    if (!el.innerHTML.includes('TOUT')) {

      it = (it + 1) % 2;

      if (sortList[it] === 'ASC') {
        el.innerHTML = name + ' ▲';
      } else {
        el.innerHTML = name + ' ▼';
      }
    }

    research(start = 0, limit, name, sortList[it], true);
  }

  function nextBTN() {
    start += limit;
    research(start, limit, document.querySelector('.FILTER-TAG-SELECTED').innerHTML, sort);
  }

  function research(start, limit, tag, sort, reset = false) {
    if (reset) {
      document.querySelector('.cards').innerHTML = '';
    }
    document.querySelectorAll('.next').forEach(function (el) {
      el.remove();
    });
    document.querySelector('.result').innerHTML += '<p id="res">start: ' + start + ', limit: ' + limit + ', tag: ' + tag + ', sort: ' + sort + "<br>";
    if (start + limit <= liste.length) {
      document.querySelector('body').innerHTML += '<div class="next"><button href="#filtre" onclick="nextBTN();">V</button></div>';
    }
  }

  window.onload = function () {
    research(start, limit, lastTag.innerHTML, sort);
  }
  // Fais la recherche et affiche les résultats
  function research(start, limit, tag, sort, reset = false) {
    spinner.style.display = "block";
    var xhr = new XMLHttpRequest();
    xhr.open('GET', 'listeprojet.php?tag=' + tag + "&start=" + start + "&limit=" + limit + "&sort=" + sort, true);
    xhr.onload = function () {
      if (this.status == 200) {
        var result = JSON.parse(this.responseText);
        spinner.style.display = "none";
        if (result.success) {
          var cards = document.querySelector('.cards');
          cards.innerHTML = "";
          result.card.forEach(element => {
            cards.innerHTML += element;
          });
          var next = document.querySelectorAll('.next');
          next.forEach(element => {
            element.remove();
          });
          if (start + limit <= result.card.length) {
            document.querySelector("body").innerHTML += result.nextbutton;
          }
          start += limit;
        } else {
          var body = document.querySelector('.cards');
          body.innerHTML = "<h1>Erreur: " + result.error + "</h1>";
        }
      }
    }
    xhr.send();
  }
</script>


</html>
<header>
  <link rel="stylesheet" href="style.css">
  <div class="left-header">
    <img src="src/logo.png" alt="">
    <h1>Archives</h1>
  </div>
  <div class="center-header">
    <!-- Create a search bar -->
    <form action="liste.php" method="GET">
      <input type="text" name="search" placeholder="Rechercher" class='searchbar'>
    </form>
  </div>
  <div class="right-header">
    <a href="index.php" class="header_link">Accueil</a>
    <a href="insert.php" class='header_link'>Ajouter</a>
    <a href="" class='header_link'>Random</a>
  </div>
</header>
<script>
  let lastScrollPosition = 0;
  const header = document.querySelector('header');

  window.addEventListener('scroll', () => {
    const currentScrollPosition = window.scrollY;

    if (currentScrollPosition > 500) {

      header.style.transform = currentScrollPosition > lastScrollPosition ?
        'translateY(-100%)' : 'translateY(0)';
      header.style.opacity = currentScrollPosition > lastScrollPosition ?
        '0' : '1';

    }

    lastScrollPosition = currentScrollPosition;
  });
  window.addEventListener('DOMContentLoaded', () => {
    header.style.transform = 'translateY(0)';
    header.style.opacity = '1';
  });
  var random_btn = document.querySelector('.right-header a:nth-child(3)');
  random_btn.addEventListener('click', () => {
    var xhr = new XMLHttpRequest();
    xhr.open('GET', 'enregistrement.php?count=true', true);
    xhr.onload = function () {
      if (this.status == 200) {
        var result = JSON.parse(this.responseText);
        console.log(result);
        if (result.success) {
          var random = Math.floor(Math.random() * (result.max - result.min + 1) + result.min);
          window.location.href = 'view.php?p=' + random;
        }
      }
    }
    xhr.send();
  });
</script>
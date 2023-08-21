<?php session_start(); ?>
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
    <?php if (isset($_SESSION['login']) && $_SESSION['logged']===true) {
        echo "<a href='logout.php' class='header_link' style='color:red;'>DECONNEXION</a>";
        } else {
        echo "<a href='login.php' class='header_link'>ADMINISTRATION</a>";
    } 
    
    ?>
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
</script>

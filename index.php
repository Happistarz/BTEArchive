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
<div style="height:1500px;"></div>
<?php echo createTAG("Anché", "#") ?>
<?php echo createLINK("Anché", "#") ?>
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

</html>
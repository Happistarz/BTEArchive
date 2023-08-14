<div class="loader">
  <section class="dots-container">
    <div class="dot"></div>
    <div class="dot"></div>
    <div class="dot"></div>
    <div class="dot"></div>
    <div class="dot"></div>
  </section>
</div>
<script>
  window.addEventListener('DOMContentLoaded', () => {
    var loader = document.querySelector('.loader');
    var dots = document.querySelector('.dots-container');
    setTimeout(() => {
      dots.style.opacity = '0';
      setTimeout(() => {
        loader.style.opacity = '0';
        loader.style.display = 'none';
      }, 300);
    }, 1000);
  })
</script>
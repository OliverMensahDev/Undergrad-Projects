<?php include("includes/header.php"); ?>
<link rel="stylesheet" href="<?php echo BASE_URL?>/templates/css/style.css">
    <div class="container">
      <div id="movie" class="well"></div>
    </div>
    <?php include("includes/footer.php") ?>
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
    <script src="<?php echo BASE_URL?>templates/js/main.js"></script>
  <script>
    getMovie();
  </script>
  </body>
</html>

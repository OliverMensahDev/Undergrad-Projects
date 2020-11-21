<?php include("includes/header.php"); ?>
<div class="container">
    	<div class="jumbotron">
        <?php displayMessage();?>
	    	<h3 class="text-center">Search For Any Movie</h3>
	    	<form id="searchForm">
	    		<input type="text" class="form-control" id="searchText" placeholder="Search Movies...">
	    	</form>
	    </div>
    </div>
    <div class="container">
      <div id="movies" class="row"></div>
    </div>
    <?php include("includes/footer.php") ?>
  <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
  <script src="<?php echo BASE_URL?>templates/js/main.js"></script>
</body>
</html>

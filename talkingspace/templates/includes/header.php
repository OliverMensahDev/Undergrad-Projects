<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="favicon.ico">
    <title><?php echo $title ?></title>
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700%7CRoboto%7CJosefin+Sans:100,300,400,500" rel="stylesheet" type="text/css">
    <link href="<?php echo BASE_URL;?>templates/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo BASE_URL;?>templates/css/font-awesome.css" rel="stylesheet">
    <link href="<?php echo BASE_URL;?>templates/css/styles.css" rel="stylesheet">
    <script src="https://unpkg.com/scrollreveal/dist/scrollreveal.min.js"></script>
</head>
<body id="background">
  <div class="loader"></div>
  <nav class="navbar navbar-inverse navbar-fixed-top">
       <div class="container-fluid">
         <div class="navbar-header">
           <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
             <span class="sr-only">Toggle navigation</span>
             <span class="icon-bar"></span>
             <span class="icon-bar"></span>
             <span class="icon-bar"></span>
           </button>
           <a class="navbar-brand"><span id="brand1">Talk</span><span id="brand2">in</span><span id="brand3">Space</span></a>
         </div>
         <div id="navbar" class="navbar-collapse collapse">
           <ul class="nav navbar-nav navbar-right">
            <li  <?php if( $title=="Talking Space || Free your mind") echo "class='active'" ;?>>
              <a href="<?php echo BASE_URL?>">Home</a>
            </li>
             <li class="dropdown"  <?php if( $title=="Talking Space || Categories") echo "class='active'" ;?> >
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Categories<span class="caret"></span></a>
              <ul class="dropdown-menu">
                <?php if ($getAllCategories): ?>
                  <?php foreach ($getAllCategories as $value): ?>
                    <li><a href="<?php echo BASE_URL."categories.php?category=". urlEnCoded($value->id) ?>"><?php echo  $value->name ?></a></li>
                  <?php endforeach; ?>
                  <?php else: ?>
                    <li>No category created</li>
                <?php endif; ?>
              </ul>
            </li>
             <?php if (isNomalUsr()): ?>
               <li  <?php if( $title=="Talking Space || Create Thread") echo "class='active'" ;?>>
                 <a href="<?php echo BASE_URL?>create.php">Create Thread</a>
               </li>
               <li  <?php if( $title=="Talking Space || Movies" || $title == "Talking Space || Movie Details") echo "class='active'" ;?>>
                 <a href="<?php echo BASE_URL?>movies.php">Get a Movie</a>
              </li>
              <li  <?php if( $title=="Talking Space || User Profile") echo "class='active'" ;?>>
                 <a href="users.php?user=<?php echo $_SESSION['user_id']?>">Profile</a>
              </li>
              <li  <?php if( $title=="") echo "class='active'" ;?>>
                <a href="<?php echo BASE_URL?>logout.php">Logout</a>
              </li>
               <?php else: ?>
                 <li  <?php if( $title=="Talking Space || Login" || $title=="Talking Space || Register") echo "class='active'" ;?>>
                  <a href="<?php echo BASE_URL?>login.php">Login</a>
                </li>
             <?php endif; ?>
           </ul>
           <form class="navbar-form navbar-right form" action="">
             <input id="searchHere" type="search" class="form-control" placeholder="Search By Topic " name="search" onkeydown="getTopic()" onblur="empty()">
           </form>
         </div>
       </div>
     </nav>
     <div id="myModal" class="modal fade" role="dialog">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Results</h4>
          </div>
          <div class="modal-body">
            <ul class="list-group searchResult">
            </ul>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
    </div>
     <script type="text/javascript">
     document.querySelector("#searchHere").onsubmit = function(){
       return false;
     }

      function getTopic(){
        var output = '';
        var placeholder = document.querySelector(".searchResult");
        var content = document.querySelector("#searchHere").value;
        var xhr = new XMLHttpRequest();
        xhr.open("GET", "<?php echo BASE_URL?>ajax/search.php?search="+content, true);
        xhr.onreadystatechange = function() {
          if(xhr.readyState == 4 && xhr.status == 200) {
              var result = JSON.parse(this.responseText);
              if(result.length > 0){
              result.forEach(function(elem){
                  output += `<li class="list-item block"><a href="<?php echo BASE_URL?>topic.php?topic=${elem.id}">
                  ${elem.title}</a></li>`;
              })
            }else{
              output = `<h1>No Result match your query</h1>`
            }
              placeholder.innerHTML = output;
               $("#myModal").modal();
          }
        }
        xhr.send();
      }

    window.sr = ScrollReveal();
      sr.reveal('.navbar', {
        duration: 2000,
        origin:'bottom'
      });
   </script>

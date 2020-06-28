<!-- new index-->

<?php 
	$myname=$_GET['uname'];
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <!-- <title>Digital Clock</title> -->
        <link rel="stylesheet" href="style.css">
        <script src="app.js"></script>
    </head>
    <body>
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <a class="navbar-brand" href="#">
            <img src="lpunss.png" width="70" height="40" alt="" loading="lazy">
          </a>
                
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                    aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
        
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item active">
                            <a class="nav-link" href="index.php">Log Out<span class="sr-only">(current)</span></a>
                        </li>
                    </ul>
                </div>
                <div class="mx-2 text-light">
                    <h3>Welcome to WeBlog</h3>
                </div>
            </nav>
        <div id="myTime" onload="showTime()" class="clock"></div>
         <div class="text-light text-center">
         <?php
          echo "<h1>Welcome ".$myname."</h1>"
                    ?>
        </div>
    </body>
    <script src="app.js"></script>
</html>
<?php

	session_start();
	$username = $_SESSION['user'];
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="Soundboard index page">
    <meta name="Author" content="Mario">

    <title>Sound Pal</title>

    <!-- Bootstrap core CSS -->
    <link href="bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
	
    <!-- Custom narrow bootstrap -->
    <link href="bootstrap/dist/css/jumbotron-narrow.css" rel="stylesheet"> 
  </head>
  <body>
    <br>
    <div class="container">
      <div class="header clearfix">
        <nav>
          <ul class="nav nav-tabs justify-content-right">
	    <li class="nav-item"><a class="nav-link active" href="index.php">Home</a></li>
		<?php 
			if(isset($_SESSION['user'])){
				echo "<li class=\"nav-item\"><a class=\"nav-link\" href=\"soundboard/views/dashboard.php\">";
				echo $username; 
				echo "'s Dashboard</a></li> \n";
				echo "<li class=\"nav-item\"><a class=\"nav-link\" href=\"soundboard/model/processLogout.php\">";
				echo "Logout</a></li> \n";
				
			}
			else{
	echo "<li class=\"nav-item\"><a class=\"nav-link\" href=\"/soundboard/views/login.php\">Login</a><li> \n";	
	echo "<li class=\"nav-item\"><a class=\"nav-link\" href=\"/soundboard/views/registration.php\">Sign up</a><li> \n";	
			}
		 ?>	
	</ul>
	</nav>

      </div>

      <div class="jumbotron">
        <h1>Sound Pal</h1>
	<p class="lead">
		Upload sounds and share them 
	</p>
	<p><a class="btn btn-lg btn-success" href="soundboard/views/publicSoundboards.php" role="button">View soundboards</a></p>
      </div>

      <footer class="footer">
        <p>&copy; Mario </p>
      </footer>

    </div> <!-- /container -->

    <!--<script src="bootstrap/dist/js/bootstrap.min.js"></script>-->
  </body>
</html>

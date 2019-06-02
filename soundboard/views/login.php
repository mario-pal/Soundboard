<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="Soundboard login page">
    <meta name="author" content="Mario">

    <title>Login</title>

    <!-- Bootstrap core CSS -->
    <link href="../../bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">  
		
    <!-- Custom narrow bootstrap -->
    <link href="../../bootstrap/dist/css/jumbotron-narrow.css" rel="stylesheet">

  </head>

  <body>
    <br>
    <div class="container">
      <div class="header clearfix">
        <nav>
          <ul class="nav nav-tabs">
	    <li class="nav-item"><a class="nav-link" href="../../index.php">Home</a></li>
	    <li class="nav-item"><a class="nav-link active" href="login.php">Login</a></li> 
	    <li class="nav-item"><a class="nav-link" href="registration.php">Sign up</a></li>
	</ul>
        </nav>
      </div>

      <div class="jumbotron text-center">
	<h1>Login</h1>
	<?php 
		if(isset($_SESSION['wrong']) && $_SESSION['wrong'] && $_SESSION['lockOut'] < 3){
			echo "<p> Wrong username or password </p> <br>";
			unset($_SESSION['wrong']);
		
		}
		if(isset($_SESSION['alphanumeric']) && $_SESSION['alphanumeric']){
			echo "<p> Username contains invalid characters </p><br>";
			unset($_SESSION['alphanumeric']);
		}
		if(isset($_SESSION['lockOut']) && $_SESSION['lockOut'] > 2){
			echo "<p> You have failed to login 3 times. Please try again after 10 minutes </p><br>";
		}
	?>
	<p class="lead">
	</p><form action="../model/processLogin.php" method="GET">
		<div class="form-group">
		<input type="text" pattern="[a-zA-Z0-9]{4,30}"
			title="Alphanumeric characters where input is longer than 3"
			class="form-control"
			name="username" placeholder="USERNAME" required> <br><br>

		<div class="form-group">
		<input type="password" pattern="[a-zA-Z0-9]{6,30}"
			title="Alphanumeric characters where input is longer than 5"
			class="form-control"
			name="password" placeholder="PASSWORD" required> <br><br>
		<input type="submit" class="btn btn-lg btn-success"  value="Login">
	</form> 

  </div> <!-- /container -->

  </body>
</html>


<?php
	session_start();
	if ( isset($_SESSION['user']) && $_SESSION['isAdmin'] == false ){
		header("Location: ../../index.php");
		die();
	}

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="Soundboard registration page">
    <meta name="author" content="Mario">

    <title>Sign up</title>

	    <!-- Bootstrap core CSS -->
	    <link href="../../bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">  
	    <link href="../../bootstrap/dist/css/jumbotron-narrow.css" rel="stylesheet">  

  </head>

  <body>
    <br>
    <div class="container">
      <div class="header clearfix">
        <nav>
          <ul class="nav nav-tabs">
	    <li class="nav-item"><a class="nav-link" href="../../index.php">Home</a></li>
	    <li class="nav-item"><a class="nav-link" href="login.php">Login</a></li> 
	    <li class="nav-item"><a class="nav-link active" href="registration.php">Sign up</a></li>
	</ul>
        </nav>
      </div>

      <div class="jumbotron text-center">
        <h1>Registration</h1>
	<p class="lead">
		<?php
			if(isset($_SESSION['fromPA']) && $_SESSION['fromPA']){
				echo "Username already taken <br>";
			}
			if(isset($_SESSION['alphanumeric']) && $_SESSION['alphanumeric']){
				echo "Only alphanumeric can be used in fields <br>";
			}
			if(isset($_SESSION['unequal']) && $_SESSION['unequal']){
				echo "Password and Confirm password do not match <br>";
			}
			if(isset($_SESSION['badpassword']) && $_SESSION['badpassword']){
				echo "Password length must be greater than 5 <br>";
			}
			if(isset($_SESSION['baduser']) && $_SESSION['baduser']){
				echo "Username length must be greater than 3 and less than 30 <br>";
			}
			/*if(isset($_SESSION['invalidEmail']) && $_SESSION['invalidEmail']){
				echo "Email entered is not valid <br>";
			}*/

			unset($_SESSION['fromPA']);
			unset($_SESSION['alphanumeric']);
			unset($_SESSION['unequal']);
			unset($_SESSION['badpassword']);
			unset($_SESSION['baduser']);
			//unset($_SESSION['invalidEmail']);

		?>
		All fields are mandatory
	</p>
	
	<form action="../model/processAccount.php" method="GET">

		<div class="form-group">
		<input type="text" pattern="[a-zA-Z0-9]{4,29}" 
			title="Alphanumeric characters where input is longer than 3"
				class="form-control"
			name="username" placeholder="USERNAME" required> <br><br>
		</div>

		<div class="form-group">
		<input type="password" pattern="[a-zA-Z0-9]{5,29}" 
			title="Alphanumeric characters where input is longer than 5"
			class="form-control"
			name="password" placeholder="PASSWORD" required> <br><br>
		</div>
		
		<div class="form-group">
		<input type="password" pattern="[a-zA-Z0-9]{5,29}"
			title="Alphanumeric characters where input is longer than 5"
			class="form-control"
			name="confirm_password" placeholder="CONFIRM PASSWORD" required> <br>
		<br>
		</div>

		<input type="submit" class="btn btn-lg btn-success"  value="Create account">
	</form> 

  </div> <!-- /container -->

  </body>
</html>

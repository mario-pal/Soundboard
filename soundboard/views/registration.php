<?php
	session_start();
	if ( isset($_SESSION['user']) && $_SESSION['isAdmin'] == false ){
		header("Location: ../index.php");
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
    <!-- defer loading of CSS snippet, not compatible in some browsers -->
	<!--<script> 
		var l = document.createElement('link');
		l.rel='stylesheet';
		l.href='../../bootstrap/dist/css/all.min.css';
		l.media='defer';
		l.addEventListener('load', function() { l.media=''; }, false);
		var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(l, s);
	</script>-->

    <!-- if no JS is enabled, fall back is added here-->
	    <!-- Bootstrap core CSS -->
	    <link href="../../bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">  
	    <link href="../../bootstrap/dist/css/jumbotron-narrow.css" rel="stylesheet">  


    <!--Critical CSS above the fold -->
<!--    <style>
* { box-sizing: border-box; }
html { font-family: sans-serif; text-size-adjust: 100%; font-size: 10px; -webkit-tap-highlight-color: rgba(0, 0, 0, 0); }
body { margin: 0px; font-family: "Helvetica Neue", Helvetica, Arial, sans-serif; font-size: 14px; line-height: 1.42857; color: rgb(51, 51, 51); background-color: rgb(255, 255, 255); padding-top: 20px; padding-bottom: 20px; }
.container { padding-right: 15px; padding-left: 15px; margin-right: auto; margin-left: auto; width: 750px; max-width: 730px; }
.header, .marketing, .footer { padding-left: 0px; padding-right: 0px; }
.header { border-bottom: 1px solid rgb(229, 229, 229); margin-bottom: 30px; }
article, aside, details, figcaption, figure, footer, header, hgroup, main, menu, nav, section, summary { display: block; }
ul, ol { margin-top: 0px; margin-bottom: 10px; }
.nav { padding-left: 0px; margin-bottom: 0px; list-style: none; }
.nav-tabs { border-bottom: 1px solid rgb(221, 221, 221); }
.pull-right { float: right !important; }
.nav > li { position: relative; display: block; }
.nav-tabs > li { float: left; margin-bottom: -1px; }
a { background-color: transparent; color: rgb(51, 122, 183); text-decoration: none; }
.nav > li > a { position: relative; display: block; padding: 10px 15px; }
.nav-tabs > li > a { margin-right: 2px; line-height: 1.42857; border: 1px solid transparent; border-radius: 4px 4px 0px 0px; }
.nav-tabs > li.active > a, .nav-tabs > li.active > a:hover, .nav-tabs > li.active > a:focus { color: rgb(85, 85, 85); cursor: default; background-color: rgb(255, 255, 255); border-width: 1px; border-style: solid; border-color: rgb(221, 221, 221) rgb(221, 221, 221) transparent; border-image: initial; }
.text-center { text-align: center; }
.jumbotron { padding-top: 48px; padding-bottom: 48px; margin-bottom: 30px; color: inherit; background-color: rgb(238, 238, 238); text-align: center; border-bottom: 0px; }
.container .jumbotron, .container-fluid .jumbotron { padding-right: 60px; padding-left: 60px; border-radius: 6px; }
h1 { margin: 0.67em 0px; font-size: 2em; }
h1, h2, h3, h4, h5, h6, .h1, .h2, .h3, .h4, .h5, .h6 { font-family: inherit; font-weight: 500; line-height: 1.1; color: inherit; }
h1, .h1, h2, .h2, h3, .h3 { margin-top: 20px; margin-bottom: 10px; }
h1, .h1 { font-size: 36px; }
.jumbotron h1, .jumbotron .h1 { color: inherit; font-size: 63px; }
p { margin: 0px 0px 10px; }
.lead { margin-bottom: 20px; font-size: 21px; font-weight: 300; line-height: 1.4; }
.jumbotron p { margin-bottom: 15px; font-size: 21px; font-weight: 200; }
.form-group { margin-bottom: 15px; }
button, input, optgroup, select, textarea { margin: 0px; font-style: inherit; font-variant: inherit; font-weight: inherit; font-stretch: inherit; font-size: inherit; line-height: inherit; font-family: inherit; color: inherit; }
input { line-height: normal; }
input, button, select, textarea { font-family: inherit; font-size: inherit; line-height: inherit; }
.form-control { display: block; width: 100%; height: 34px; padding: 6px 12px; font-size: 14px; line-height: 1.42857; color: rgb(85, 85, 85); background-color: rgb(255, 255, 255); background-image: none; border: 1px solid rgb(204, 204, 204); border-radius: 4px; box-shadow: rgba(0, 0, 0, 0.075) 0px 1px 1px inset; transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out; }
.btn { display: inline-block; padding: 6px 12px; margin-bottom: 0px; font-size: 14px; font-weight: normal; line-height: 1.42857; text-align: center; white-space: nowrap; vertical-align: middle; touch-action: manipulation; cursor: pointer; user-select: none; background-image: none; border: 1px solid transparent; border-radius: 4px; }
.btn-success { color: rgb(255, 255, 255); background-color: rgb(92, 184, 92); border-color: rgb(76, 174, 76); }
.btn-lg, .btn-group-lg > .btn { padding: 10px 16px; font-size: 18px; line-height: 1.33333; border-radius: 6px; }
button, html input[type="button"], input[type="reset"], input[type="submit"] { -webkit-appearance: button; cursor: pointer; }
.jumbotron .btn { font-size: 21px; padding: 14px 24px; }	
   </style> -->

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
		<!--<div class="form-group">
		<input type="text" pattern="[a-zA-Z0-9]{1,29}" 
			title="Alphanumeric characters only" class="form-control"
			name="first_name" placeholder="FIRST NAME" required> <br> <br>

		<div class="form-group">
		<input type="text" pattern="[a-zA-Z0-9]{1,29}" 
			title="Alphanumeric characters only" class="form-control" 
			name="last_name" placeholder="LAST NAME" required> <br> <br>

		<input type="email" class="form-control" 
			name="email" placeholder="EMAIL" required> <br><br>-->

		<div class="form-group">
		<input type="text" pattern="[a-zA-Z0-9]{4,29}" 
			title="Alphanumeric characters where input is longer than 3"
				class="form-control"
			name="username" placeholder="USERNAME" required> <br><br>

		<div class="form-group">
		<input type="password" pattern="[a-zA-Z0-9]{5,29}" 
			title="Alphanumeric characters where input is longer than 5"
			class="form-control"
			name="password" placeholder="PASSWORD" required> <br><br>
		
		<div class="form-group">
		<input type="password" pattern="[a-zA-Z0-9]{5,29}"
			title="Alphanumeric characters where input is longer than 5"
			class="form-control"
			name="confirm_password" placeholder="CONFIRM PASSWORD" required> <br>
		<br>
		<input type="submit" class="btn btn-lg btn-success"  value="Create account">
	</form> 

  </div> <!-- /container -->

  </body>
</html>

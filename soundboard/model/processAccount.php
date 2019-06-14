<?php
	session_start();
	require_once '../../../../config.php';
	
	//regex sanitation for alphanumerics
	$password = $_GET['password'];
	$altered = preg_replace("/(\W)+/", "", $password);
	if ($password !== $altered){
		$_SESSION['alphanumeric'] = true;
		header('Location: ../views/registration.php');
		die();	
	}
	
	$confpassword = $_GET['confirm_password'];
	$altered = preg_replace("/(\W)+/", "", $confpassword);
	if ($confpassword !== $altered){
		$_SESSION['alphanumeric'] = true;
		header('Location: ../views/registration.php');
		die();	
	}

	//For when password and confirm password not equal
	if ($password !== $confpassword){
		$_SESSION['unequal'] = true;
		header('Location: ../views/registration.php');
		die();	
	}
 	
	$username = $_GET['username'];
	$altered = preg_replace("/(\W)+/", "", $username);
	if ($username !== $altered){
		$_SESSION['alphanumeric'] = true;
		header('Location: ../views/registration.php');
		die();	
	}


	// checks if username is already taken
	$query = mysqli_query($conn, "SELECT * FROM users WHERE BINARY username='".$username."'");
	if(mysqli_num_rows($query) > 0){
		session_start();
		$_SESSION['fromPA'] = true;
		header('Location: ../views/registration.php');
		die();
	}

	else{ 
	/*$first_name = $_GET['first_name'];
	
	$last_name = $_GET['last_name'];

	// email sanitization
	$email = $_GET['email'];

	if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
		// invalid emailaddress
		$_SESSION['invalidEmail'] = true;
		header('Location: ../views/registration.php');
		die();
	}

	//For when user inputs non alphanumeric characters in these fields
	if( !ctype_alnum($first_name) || !ctype_alnum($last_name) ){
		$_SESSION['alphanumeric'] = true;
		header('Location: ../views/registration.php');
		die();
	}*/
	$pepper = 'pepper';
	$password = md5($pepper.$_GET['password']);

		//$sql = "INSERT INTO users (id, first_name, last_name, email, username, password, admin,login_attempts, login_fails, login_success, logouts) VALUES (NULL, '$first_name', '$last_name', '$email', '$username', '$password', FALSE, '0', '0', '0', '0')";
        $todays_date = date('Y-m-d');
	$sql = "INSERT INTO users (user_id, user_name, password, admin, signup_date) VALUES (NULL, '$username', '$password', FALSE, '$todays_date' )";
	$result = mysqli_query($conn, $sql);

	if( isset($_SESSION['isAdmin']) && $_SESSION['isAdmin'] == true ){
		header('Location: ../views/list.php');
		die();
	}
	else{
		header('Location: ../../index.php');
		die();
	}
	}

?>

<?php
	session_start();
	
	require_once '../../../../config.php';

	$soundboard_name = $_GET['soundboard_name'];
	$soundboard_description = $_GET['soundboard_description'];
	
	//For when user inputs non alphanumeric characters in these fields
	if( !ctype_alnum($soundboard_name) ||
	    !ctype_alnum($soundboard_description) ){
	      $_SESSION['alphanumeric'] = true;
	      header('Location: ../views/addSounboard.php');
	      die();
	}


	if($_GET['public'] == "on" ){
		$public = 1;
	}
	else{
		$public = 0;
	}

	$username = $_SESSION['user'];
	$sql = "SELECT * FROM users WHERE BINARY user_name='$username'";
	$result = mysqli_query($conn, $sql);

	$getID = mysqli_fetch_array($result );
	$userID = (int)$getID['id'];

	$todays_date = date('Y-m-d');
	$sql = "INSERT INTO soundboards (user_id, soundboard_name, soundboard_image,soundboard_description, public, date_created) 
	        VALUES 
		($userID, '$soundboard_name', NULL, '$soundboard_description', $public, '$todays_date')";

	//$sql = "INSERT INTO soundboard (id, soundboard_name, soundboard_image,soundboard_description, public) VALUES (30, 'test3', NULL, 'hello', 1)";
	$result = mysqli_query($conn, $sql);

		header('Location: ../views/dashboard.php');
		die();

?>

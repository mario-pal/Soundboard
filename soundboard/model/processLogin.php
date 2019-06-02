<?php
	session_start();
	require_once '../../../../config.php';
	
	if(isset($_SESSION['user'])){
		header('Location: ../../index.php');
		die();	
	}
	else{
		/*
		$ip = $_SERVER["REMOTE_ADDR"];
		
		mysqli_query($conn, "INSERT INTO `ip` (`address` ,`timestamp`)VALUES ('$ip',CURRENT_TIMESTAMP)");
		$result = mysqli_query($conn, "SELECT COUNT(*) FROM `ip` WHERE `address` LIKE '$ip' AND `timestamp` > (NOW() - INTERVAL 30 MINUTE)");
		
		$sql = "DELETE FROM `ip` WHERE `timestamp` < (NOW() - INTERVAL 30 MINUTE)";
		mysqli_query($conn, $sql);
		
		$count = mysqli_fetch_array($result, MYSQLI_NUM);

		if ($count[0] > 3){
			$_SESSION['loginDisabled'] = true;
			header('Location: ../views/login.php');
			die();
		}*/

		if (isset($_SESSION['lockOut']) && $_SESSION['lockOut'] > 2){
			header('Location: ../views/login.php');
			die();
		}

		// if timeout over 10 minutes
		if (isset($_SESSION['lockOut']) && $_SESSION['lockOut'] > 2 && (time() - $_SESSION['lockOut'] > 600) ){
			unset($_SESSION['lockOut']);
			session_destroy();
		}

		$username = $_GET['username'];
		
		//Data sanitization
		$altered = preg_replace("/(\W)+/", "", $username);

		if( !ctype_alnum($username) || $username !== $altered ){
			$_SESSION['alphanumeric'] = true;
			header('Location: ../views/login.php');
			die();
		}
		
		$sql = "SELECT * FROM `users` WHERE username = '$username'";	
		$result = mysqli_query($conn, $sql);
		if ( (mysqli_num_rows($result) > 0)){
			$rightUser = true;
		}
		else{
			$rightUser = false;
		}

		$filterPW = $_GET['password'];
		$alteredPW = preg_replace("/(\W)+/", "", $filterPW);

		if( !ctype_alnum($filterPW) || $alteredPW !== $filterPW ){
			$_SESSION['alphanumeric'] = true;
			header('Location: ../views/login.php');
			die();
		}

		$pepper = pepper;
		$password = md5($pepper.$_GET['password']);

		$sql = "SELECT * FROM `users` WHERE BINARY username = '$username' and password = '$password'";
		$result = mysqli_query($conn , $sql);
		if( (mysqli_num_rows($result) == 1)){
			
			$sql = "UPDATE `users` 
			    SET login_attempts = login_attempts + 1
			WHERE username = '".$username."'";
			mysqli_query($conn, $sql);

			$sql = "UPDATE `users` 
			    SET login_success = login_success + 1
			WHERE username = '".$username."'";
			mysqli_query($conn, $sql); 


			$row = mysqli_fetch_array( $result);
			$isAdmin = $row['admin'];
			
			$_SESSION['user'] = $username;
			$_SESSION['isAdmin'] = $isAdmin;
			
			/*
			//delete query from `ip` if successful login
			$sql = "DELETE FROM `ip` WHERE `address` = '$ip'";
			mysqli_query($conn, $sql);
			die(); */

			// delete session if login is successful
			if (isset($_SESSION['lockOut']) ){
				unset($_SESSION['lockOut']);
			}

			header('Location: ../../index.php');
			die();

		}
		//wrong credentials
		else{
			if ($rightUser == true){
				
			$sql = "UPDATE `users` 
			    SET login_fails = login_fails + 1
			WHERE username = '".$username."'";
			mysqli_query($conn, $sql);

			$sql = "UPDATE `users` 
			    SET login_attempts = login_attempts + 1
			WHERE username = '".$username."'";
			mysqli_query($conn, $sql);
			}

			++$_SESSION['lockOut'];
			
			$_SESSION['wrong'] = true;
			header('Location: ../views/login.php');
			die();
		}
	}
?>


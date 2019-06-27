<?php
	session_start();
	
	require_once '../../../../config.php';

	$soundboard_id = $_GET['soundboard_id'];

	$username = $_SESSION['user'];
	$sql = "SELECT * FROM users WHERE BINARY user_name='$username'";
	$result = mysqli_query($conn, $sql);

	$getID = mysqli_fetch_array($result );
	$userID = (int)$getID['user_id'];

	//$sql = $conn->prepare("DELETE FROM soundboards WHERE soundboard_id= ? AND user_id= ?");
	$sql = "DELETE FROM soundboards WHERE soundboard_id='$soundboard_id' AND user_id='$userID'";
	//$sql->bind_param('ii', $soundboard_id, $userID);
	//$sql-> execute();

	if($_SESSION['isAdmin'] == true)
	{
		/*$sql = $conn->prepare("DELETE FROM soundboard WHERE soundboard_id= ?");
		$sql->bind_param('i', $soundboard_id);
		$sql-> execute();*/
		$sql = "DELETE FROM soundboards WHERE soundboard_id='$soundboard_id'";
	}

	//$result = $sql->get_result();
	$resultSB = mysqli_query($conn, $sql);

	$sql = "SELECT * FROM sounds WHERE soundboard_id='$soundboard_id'";
	$resultS = mysqli_query($conn, $sql);

	$sql = "DELETE FROM sounds WHERE soundboard_id='$soundboard_id'";
	while($row = mysqli_fetch_assoc($resultS)){
		 unlink($row["sound_file"]);
	}

	if($resultS && $resultSB){
		 $_SESSION['soundboardDeleted'] = true;
	}
	else{
		$_SESSION['soundboardDeleted'] = false;
	}

	header('Location: ../views/dashboard.php');
	die();
?>

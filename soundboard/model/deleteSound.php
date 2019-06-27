<?php
	session_start();

	require_once '../../../../config.php';

	$username = $_SESSION['user']; 
	$sql = "SELECT * FROM users WHERE BINARY username='$username'";
	$result = mysqli_query($conn, $sql);

	$getID = mysqli_fetch_array($result );
	$userID = (int)$getID['user_id'];

	$sound_id = $_GET['sound_id'];

	//$sql = $conn->prepare("SELECT * FROM sounds WHERE sound_id = ?");
	//$sql->bind_param('i', $sound_id);
	$sql = "SELECT * FROM sounds WHERE sound_id='$sound_id'";
	//$sql-> execute();
	//$result = $sql->get_result();
	$result = mysqli_query($conn, $sql);

	$get_soundboard = mysqli_fetch_array($result);
	$soundboard_id = (int)$get_soundboard['soundboard_id'];
	$sound_file = $get_soundboard['sound_file'];

	$sql = "SELECT * FROM soundboards WHERE soundboard_id = '$soundboard_id'";
	$result = mysqli_query($conn, $sql);
	$get_owner = mysqli_fetch_array($result);
	$owner_id = (int)$get_owner['user_id'];

	if(($userID == $owner_id) || $_SESSION['isAdmin'] == true)
	{
		$sql = "DELETE FROM sounds WHERE sound_id='$sound_id'";
		$result = mysqli_query($conn, $sql);

		if($result && unlink($sound_file)){
			$_SESSION['deletedSound'] = true;
		}
		else{
			$_SESSION['deletedSound'] = false;
		}
		//$sql = $conn->prepare("DELETE FROM sound WHERE sound_id = ?");
		//$sql->bind_param('i', $sound_id);
		//$sql-> execute();
	}
	
	header('Location: ../views/soundboard.php?soundboard_id='$sound_id');
	die();

?>

<?php
	session_start();

	require_once '../../../../config.php';

	$username = posix_getpwuid(posix_geteuid())['name'];
	error_log($username,0);

	function readable_filesize($bytes, $decimals = 2){
		$sz = 'BKMGTP';
		$factor = floor((strlen($bytes) - 1) / 3);
			return sprintf("%.{$decimals}f", $bytes / pow(1024, $factor)) . @$sz[$factor];
	}
	
	$soundboard_id = $_SESSION['curr_soundboard_id'];
	$sound_name = $_POST['sound_name'];

	 if( !ctype_alnum($sound_name)){
		$_SESSION['alphanumeric'] = true;
		header('Location: ../views/addSound.php');
		die();
	 }

	if(isset($_FILES['sound_file']['tmp_name'])){
		$file_name = $_FILES['sound_file']['name'];
		$finfo = finfo_open(FILEINFO_MIME_TYPE);
		$mime = finfo_file($finfo, $_FILES['sound_file']['tmp_name']);

		if($mime == "audio/wav" || $mime == "audio/x-wav" || $mime == "audio/mpeg" ){
			//the name of the sound file is concatenated to make file names in the server unique to prevent overwriting
			 $soundServerLocation = "../audio/" . $_SESSION['user'] . $file_name;
			 if(!(move_uploaded_file($_FILES['sound_file']['tmp_name'], $soundServerLocation))){ 
				$_SESSION['soundStorageError'] = true;
				header('Location: ../views/addSound.php');
				die();
			 }
			 $sql = "INSERT INTO sounds (soundboard_id, sound_name, sound_file) 
			         VALUES ($soundboard_id, '$sound_name','$file_name')";
			$result = mysqli_query($conn, $sql);
			$_SESSION['fileUploadSuccess'] = true;
			header('Location ../views/addSound.php');
			die();
		}
		else{
			$_SESSION['fileTypeError'] = true;
			header('Location ../views/addSound.php');
			die();
		}
	}
	elseif(isset($_FILES['sound_file']['error'])){
		$fileUploadErrors = array(
		    0 => 'No errors in uploading',
		    1 => 'The chosen file is larger than the permitted file size',
		    2 => 'The chosen file is too large',
		    3 => 'Something went wrong while uploading the file',
		    4 => 'The chosen file could not be uploaded',
		    5 => 'UNKNOWN!',
		    6 => 'Website is not currently allowing files to be uploaded',
		    7 => 'Website failed to save file',
		    8 => 'File upload was interrupted',
		);
		$_SESSION['uploadError'] = $fileUploadErrors[$_FILES['sound_file']['error']];
		header('Location ../views/addSound.php');
		die();
	}
	else{
		$_SESSION['uploadError'] = 'An unknown error occurred!';
		header('Location ../views/addSound.php');
		die();
	}
?>

<?php	
	session_start();
	require_once '../../../../config.php';

	if ( !(isset($_SESSION['user'])) ){
	    header("Location: ../../login.php");
	    die();
	}
	define('MAX_BYTE_UPLOAD', '2000000');

	//$username = $_SESSION['user'];
	$soundboard_id = $_GET['soundboard_id'];
	$_SESSION['curr_soundboard_id'] = $soundboard_id;

	function readable_filesize($bytes, $decimals = 2){
		  $sz = 'BKMGTP';
		  $factor = floor((strlen($bytes) - 1) / 3);
		    return sprintf("%.{$decimals}f", $bytes / pow(1024, $factor)) . @$sz[$factor];
	}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Add Sound">
    <meta name="author" content="Mario">

    <title>Add Sound</title>

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
	    <li class="nav-item"><a class="nav-link" href="./dashboard.php">
		<?php echo $_SESSION['user']?>'s Dashboard</a></li>
	    <li class="nav-item"><a class="nav-link" href="../model/processLogout.php">Logout</a></li>
	  </ul>
        </nav>
      </div>

      <div class="jumbotron">
        <h1>Add Sound</h1>
	<p class="lead">
		<?php
			if(isset($_SESSION['alphanumeric']) && $_SESSION['alphanumeric']){
				echo "Only alphanumeric can be used in fields <br>";
			}

			unset($_SESSION['alphanumeric']);

			if(isset($_SESSION['soundStorageError']) && $_SESSION['soundStorageError']){
			   echo "<div class=\"alert alert-danger\" role=\"alert\">
			         There was a problem storing the file!
			         </div>";
			}


			 if(isset($_SESSION['fileTypeError']) && $_SESSION['fileTypeError']){
				echo "<div class=\"alert alert-warning\" role=\"alert\">
				      Your chosen file is NOT .mp3 or .wav !
				        </div>";
			 }

			 if(isset($_SESSION['uploadError'])){
			    echo "<div class=\"alert alert-danger\" role=\"alert\">";
			    echo $_SESSION['uploadError'];
			    echo "</div>";
			 }

			 if(isset($_SESSION['fileUploadSuccess']) &&  $_SESSION['fileUploadSuccess']){
			      echo "<div class=\"alert alert-success\" role=\"alert\">
			      File was uploaded successfully!
			      </div>";
			 }

			 unset($_SESSION['soundStorageError']);
			 unset($_SESSION['fileTypeError']);
			 unset($_SESSION['uploadError']);
			 unset($_SESSION['fileUploadSuccess']);
		?>
		
	</p>
	<form action="../model/processSound.php" method="POST" enctype="multipart/form-data" >
		<div class="form-group">
		<input type="text" pattern="[a-zA-Z0-9]{1,15}" 
			title="Alphanumeric characters only" class="form-control"
			name="sound_name" placeholder="SOUND NAME" required>
		</div> 
		<br> <br>

		<!--<div class="form-group">
		<input type="text" pattern="[a-zA-Z0-9 ]{1,20}" 
			title="Alphanumeric characters where input is NOT longer
			than 20"
			class="form-control"
			name="sound_description" placeholder="DESCRIPTION"> 
		</div>
		<br><br>-->
		
		<div class = "form-group">
		<input type="file" name="sound_file" id = "sound_file" accept = "audio/*" required/>
		</div>
		<br>
		<br>

		<input type="submit" class="btn btn-lg btn-success"  value="Upload Audio" name = "save_audio"/>
	</form> 
  </div>
<!--Add sound to database-->
	<?php
		/*$soundboard_id = $_SESSION['curr_soundboard_id'];
		$sound_name = $_REQUEST['sound_name'];
		$sound_description = $_REQUEST['sound_description'];
		
		if(isset($_FILES['sound_file']['name'])){
			$name = $_FILES['sound_file']['name'];
			$finfo = finfo_open(FILEINFO_MIME_TYPE);
			$mime = finfo_file($finfo, $_FILES['sound_file']['tmp_name']);
			if($mime == "audio/wav" || $mime == "audio/x-wav" || $mime == "audio/mp3" || $mime == "audio/mpeg3" ){
				$sizefile = $_FILES['sound_file']['tmp_name'];
				if(filesize($_FILES['sound_file']['tmp_name']) > MAX_BYTE_UPLOAD){
					echo "<div class=\"alert alert-danger\"> <strong>ERROR:</strong> $name is too large at" . readable_filesize($sizefile) . "!(max file size is 2MB) </div>";
					die();
				}
				if(move_uploaded_file($_FILES['sound_file']['tmp_name'], "../audio/$name")){                                
					$sound = "../audio/" . $name;                       
				}
				else{
					echo "<div class=\"alert alert-warning\">
					      <strong>Warning!</strong> A file with that name already exists in our database! Try again!
					      </div>";
			                die();

				}
				//echo "<script>alert(\" $mime \")</script>";
	etlocal spell spelllang=en_us
	<F9>$sql = "INSERT INTO sound (soundboard_id, sound_name, sound, sound_image, sound_description) VALUES ($soundboard_id, '$sound_name','$sound', NULL, '$sound_description')";
				$result = mysqli_query($conn, $sql);
				echo "<div class=\"alert alert-success\">
				<strong>Success!</strong> $name was successfully uploaded</div>";
			}
			else{
				//echo "<script>alert(\" $mime \")</script>";
				echo "<div class=\"alert alert-danger\"> <strong>ERROR:</strong> $name is the wrong file type!(choose wav or mp3) </div>";
				die();

			}
			
		}
		else{
			echo "<div class=\"alert alert-warning\">
				  <strong>Warning!</strong> Something went wrong! We could not obtain your chosen file. Perphaps it's too large. Try again with a file no bigger than 2MB.
				  </div>";
			die();
		}*/
	?>

  </body>
</html>

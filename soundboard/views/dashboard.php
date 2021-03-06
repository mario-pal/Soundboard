<?php
	session_start();
	require_once '../../../../config.php';
	if(!isset($_SESSION['user'])){
		header("Location: ../../index.php");
		die();
	}
	$username = $_SESSION['user'];
	$isAdmin = $_SESSION['isAdmin'];
	//========================Php code below needed to load table
	$limit = 5;
	if(isset($_GET["page"])){ $page = $_GET["page"]; } else { $page=1; };
	$start_from = ($page-1) * $limit;

	$sql = "SELECT * FROM users WHERE user_name = '$username'";
	$rs_result = mysqli_query($conn, $sql);
	$row = mysqli_fetch_assoc($rs_result);
	$userId = (int)$row["user_id"];

	$sql = "SELECT soundboard_name, public, soundboard_id FROM soundboards WHERE user_id='$userId' ORDER BY soundboard_id ASC LIMIT $start_from, $limit";
	if($_SESSION['isAdmin'] == true)
	{
		$sql = "SELECT soundboard_name, public, soundboard_id FROM soundboards ORDER BY soundboard_id ASC LIMIT $start_from, $limit";
	}
	$rs_result = mysqli_query($conn, $sql);
	$total_records = mysqli_num_rows($rs_result);
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="Soundboard user's dashboard">
    <meta name="author" content="Mario">

    <title><?=$username?>'s Dashboard</title>

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
	    <?php
	       echo "<li class=\"nav-item\"><a class=\"nav-link active\" href=\"dashboard.php\">";
	       echo $username;
	       echo "'s Dashboard</a></li> \n";
	    ?>
	    <li class="nav-item"><a class="nav-link" href="../model/processLogout.php">Logout</a></li>
	</ul>
        </nav>
      </div>

	<?php if ( $_SESSION['isAdmin'] == 1 ){ ?>
		<a class="btn btn-lg btn-success" href="list.php" role="button">Admin Control</a>
	<?php } ?>

	<?php
		if(isset($_SESSION['soundboardDeleted']) && $_SESSION['soundboardDeleted']){
			echo "<div class=\"alert alert-success\" role=\"alert\">
			  Successfully deleted soundboard!
			  </div>";
		}
		elseif(isset($_SESSION['soundboardDeleted']) && !($_SESSION['soundboardDeleted'])){
			echo "<div class=\"alert alert-danger\" role=\"alert\">
			Something went wrong deleting the soundboard!
			</div>";
		}
		unset($_SESSION['soundboardDeleted']);
	?>
<!--Soundboard-->
      <?php 
      	if($total_records == 0){
		echo "<div class=\"alert alert-info\" role=\"alert\">
			You have no soundboards
		</div>";
	}
      ?>
      <div class = "jumbotron text-center">
        <h1>
	  Your Soundboards
	</h1>
	<form action="" method="get">
        <table class="table table-striped table-hover">
	  <thead class="thead-light">
	    <tr>
	      <th scope="col">Soundboard Name</th>
	      <th scope="col">Public</th>
	    </tr>
	  </thead>
	  <tbody>
	    <?php
		while($row = mysqli_fetch_assoc($rs_result)){
			$soundboard_id = $row["soundboard_id"];
			$soundboard_name = $row["soundboard_name"];
	    ?>
		<tr>	
		<td>
		<?php echo "<a href = \"./soundboard.php?soundboard_id=" . $soundboard_id . "\">" . 
			$soundboard_name . "</a>";
		?>
		</td>
		<td>
		  <?php 
			if($row["public"] == false ){
				echo 'No';
			}
			else{
				echo 'Yes';
			}
		  ?>
		</td>
		<td>
		<?php
			echo '<a href="../model/deleteSoundboard.php?soundboard_id='.$row["soundboard_id"].'">Delete</a>';
		?>	
		</td>
		</tr>
	    <?php
	    };
	    ?>
	  </tbody>
	</table>
	</form>
	<a class = "btn btn-success" href = "./addSoundboard.php" role = "button">Add Soundboard</a>
	<br>
	<?php
	  $total_pages = ceil($total_records / $limit);
	  $pagLink = "<nav><ul class=\"pagination justify-content-center\">";
	  for ($i = 1; $i<=$total_pages; $i++){
		  $pagLink .= "<li class=\"page-item\" ><a class=\"page-link\" href='./dashboard.php?page=".$i."'>".$i."</a></li>";
	 };
	  echo $pagLink . "</ul></nav>";
	?>
  </div>	
</div>
</body>
</html>

i<!--<script type="text/javascript">
$(document).ready(function(){
	$('.pagination').pagination({
	        item: <?php //echo $total_records;?>,
			itemsOnPage: <?php //echo $limit;?>,
			cssStyle: 'light-theme',
			currentPage : <?php //echo $page;?>,
			hrefTextPrefix : 'dashboard.php?page='
	});
	});
</script>-->


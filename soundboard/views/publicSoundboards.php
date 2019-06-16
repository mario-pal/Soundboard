<?php
	session_start();

	require_once '../../../../config.php';

	$limit = 5;
	if(isset($_GET["page"])){ $page = $_GET["page"]; } else { $page=1; };
	$start_from = ($page-1) * $limit;

	$sql = "SELECT * FROM soundboards WHERE public = 1 ORDER
	BY soundboard_id ASC LIMIT $start_from, $limit";

	$rs_result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv = "Content-Type" content="text/html; charset=utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name = "description" content="Public soundboard viewing page">
    <meta name="author" content="Mario">
    <title>Public Soundboards</title>
    <!---->
    <link href="../../bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="../../bootstrap/dist/css/jumbotron-narrow.css" rel="stylesheet">

    <script type = "text/javascript" charset = "utf8" src = "../../js/jquery-2.0.3.js"></script>
    <script type = "text/javascript" src = "../../bootstrap/dist/js/bootstrap.min.js"></script>
    <script src = "../../js/paginationFunc.js"></script>
  </head>
  <body>
    <br>
    <div class = "container">
      <div class = "header clearfix">
      <nav>
        <ul class="nav nav-tabs">
	  <li class = "nav-item"><a class="nav-link" href="../../index.php">Home</a></li>
	    <?php
	    	if(isset($_SESSION['user'])){
			echo "<li class=\"nav-item\"><a class=\"nav-link\" href=\"./dashboard.php\">";
			echo $_SESSION['user'];
			echo "'s Dashboard</a></li> \n";
			echo "<li class=\"nav-item\"><a class=\"nav-link\"
			href=\"../model/processLogout.php\">";
			echo "Logout</a></li> \n";
		}
		else{
			echo "<li class=\"nav-item\"><a class=\"nav-link\"
			href=\"./login.php\">Login</a></li> \n";
			echo "<li class=\"nav-item\"><a class=\"nav-link\"
			href=\"./registration.php\">Sign up</a></li> \n";
                }
	    ?>
        </ul>
      </nav>
      </div>
      
	<h2>Public Soundboards</h2>


    <div class ="jumbotron">
      <table class="table table-striped table-hover">
        <thead>
          <tr>
          <th scope="col">Soundboard Name</th>
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
		<?php
			echo "<a href = \"./soundboard.php?soundboard_id=" . $soundboard_id . "\">" . $soundboard_name . "</a>"; 
       		#echo $row["soundboard_name"];	
		?>
		
           </td>
		   <!-- <td>
		<a
		<?php #echo"href=\"./soundboard.php?soundboard_id=" .$row["soundboard_id"]. "\"" ?>
		><span class = 'glyphicon glyphicon-eye-open'></span>
		</a>
		    </td>-->
	  </tr>
        <?php
        };
        ?>
        </tbody>
      </table>

    <?php
    $sql = "SELECT COUNT(soundboard_id) FROM soundboards WHERE public = 1";
    $rs_result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_row($rs_result);
    $total_records = $row[0];
    $total_pages = ceil($total_records / $limit);
    $pagLink = "<nav><ul class=\"pagination justify-content-center\">";
    for ($i = 1; $i<=$total_pages; $i++){
    	$pagLink .= "<li class=\"page-item\" ><a class=\"page-link\" href='publicSoundboards.php?page=".$i."'>".$i."</a></li>";
    };
    echo $pagLink . "</ul></nav>";
?>

    <a class="btn btn-success" href="./addSoundboard.php" role="button">Add Soundboard</a>
    </div>
    
  </div>
  </body>
</html>

<!--<script type="text/javascript">
$(document).ready(function(){
$('.pagination').pagination({
	item: <?php //echo $total_records;?>,
	itemsOnPage: <?php //echo $limit;?>,
	cssStyle: 'light-theme',
		currentPage : <?php //echo $page;?>,
		hrefTextPrefix : 'publicSoundboards.php?page='
	});
});
</script>-->

<?php

$query = $_GET["query"];

include 'rank.php';

//connection
$con = mysql_connect("localhost","root","root");

//check if connection successful
if (!$con)
{
    //if not output error and die
	die('Could not connect: ' . mysql_error());
}

//select the db
mysql_select_db("miniIR", $con);

//get the articles from the docs table
/*foreach($rankings as $key => $val){

	if($val > 0){

    	//write the sql query to select the row of that single article
		$sql = "SELECT * FROM docs WHERE num='$key'";

    	//submit the mysql query
		$result = mysql_query($sql, $con);

    	//put the row in an array
		$row = mysql_fetch_array($result);

    	//put all the fields together to one big string
		$all = $row['title'];// + " " + $row['description'] + " " + $row['narrative'];

		echo $all . "</br></br>";

	}

}*/
?>

<!DOCTYPE html>
<html>
<head>
	<title>Mini Information Retrieval</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<!-- Bootstrap -->
	<link href="css/bootstrap.css" rel="stylesheet" media="screen">
	<link href="css/custom.css" rel="stylesheet" media="screen">

</head>
<body>

	<div id="topbar">

		<form action="results.php">

			<input id="topquery" type="text" method="get" name="query" value="<?php echo implode($query, " "); ?>">

		</form>

	</div>

	<div class="container">

		<div class="row" id="results">
			<div id="titles" class="span5">
				<ul>
					<?php 
					foreach($rankings as $key => $val){

						if($val > 0){

    						//write the sql query to select the row of that single article
							$sql = "SELECT * FROM docs WHERE num='$key'";

    						//submit the mysql query
							$result = mysql_query($sql, $con);

    						//put the row in an array
							$row = mysql_fetch_array($result);

    						//put all the fields together to one big string
							$all = $row['title'];// + " " + $row['description'] + " " + $row['narrative'];

							$title = $row["title"];
							$description = $row["description"];
							$narrative = $row["narrative"];

							$id = preg_replace('/\s+/', '', $title);

							echo '<li id="'. $id .'" class="item"> <p class="title">'. $title .'</p> <p class="description">'.$description.'</p> ';
							echo '<p class="narrative" style="display:none;">'. $narrative .'</p> </li>';

						}

					} ?>


				</ul>
			</div>

			<div class="span7" id="preview">
				
				<h1></h1>
				<h4></h4>
				<p>Click a result to preview the document here.</p>

			</div>

		</div>

	</div>
<script src="js/jquery.min.js"></script>
<script>
	
	$( document ).ready(function() {
    	
		
		$( ".item" ).click(function() {
  			var id = $.trim($(this).attr('id'));
  			var title = $("#" + id + " p.title").text();
  			var desc = $("#" + id + " p.description").text();
  			var narr = $("#" + id + " p.narrative").text();
  			$("#preview h1").text(title);
  			$("#preview h4").text(desc);
  			$("#preview p").text(narr);

		});
	

	});

</script>
<script src="js/bootstrap.min.js"></script>
</body>
</html>
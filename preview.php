<h1>Title</h1>
<h4>Description of the document will be inserted in this area.</h4>
<p>Any document discussing petroleum exploration in the
	South Atlantic near the Falkland Islands is considered
	relevant.  Documents discussing petroleum exploration in 
	continental South America are not relevant.</p>


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

							echo '<li> <p class="title">'.$row["title"].'</p> <p class="description">'.$row["description"].'</p> </li>';

						}

					} ?>
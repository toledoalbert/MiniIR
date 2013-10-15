<?php


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

//select the db
$query = "SELECT * FROM freq"; 

//perform query and save result
$result = mysql_query($query) or die(mysql_error());

//for each row
while($row = mysql_fetch_array($result)){

	//values we are counting
	$cf = 0;
	$df = 0;

	//document number
	$doc = 351;

	//echo "(".$row['399']." ".$row.")";

	
	//loop thru each column
	for($doc = 351; $doc < 401; $doc++){

		$f = $row["$doc"];
		echo $f;

		if($f > 0){

			$cf += $f;
			$df++;

		}
		
	} 
	
	//insert df and cf
	//$query = "INSERT INTO freq (CF, DF) VALUES ($cf, $df) WHERE word = $row['word']";
	$word = $row["word"];
	$query = "UPDATE `freq` SET `CF`=$cf, `DF`=$df WHERE `word` = '$word'";

	mysql_query($query, $con);

	echo $query . " added for word ". $word ."</br>";	

}



?>
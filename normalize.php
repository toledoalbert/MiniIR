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

//query
$query = "SELECT * FROM freq"; 

//perform query and save result
$result = mysql_query($query) or die(mysql_error());

//for each row
while($row = mysql_fetch_array($result)){
	
	//echo $row["word"] . "</br>";
	
	//number of documents
	$N = 50;

	//get df
	$df = $row['DF'];

	//the word
	$word = $row["word"];

	echo "WORD: " . $word . "\tDF: " . $df . "</br>";

	//loop thru each column
	for($doc = 351; $doc < 401; $doc++){

		//get the tf
		$tf = $row["$doc"];

		echo "DOC NUMBER: " . $doc . " TF: $tf \t";

		$weight = 0;

		if($tf > 0){

			//calc the weight
			$weight = (log10($tf))*(log10(50/$df));
		}/*else{
			$weight = 0;
		}*/

		echo "WEIGHT: " . $weight . "</br>";

		//echo $weight . "</br>";

		$query = "UPDATE `normal` SET `$doc`=$weight WHERE `word` = '$word'";

		//$result = mysql_query($query);
		//mysql_query($query);

		if(mysql_query($query)){ 
			echo "success " . $query . mysql_error() ."</br>";
		}else{
			echo mysql_error()."</br>" . $query;
		} 

		//echo $query . "</br></br>";		
		
	} 

}


?>
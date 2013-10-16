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
$query = "aboard anticipated abuse abuse";

$query = explode(" ", $query);

//select the db
$sql = "SELECT * FROM normal"; 

//perform query and save result
$result = mysql_query($sql) or die(mysql_error());

$vector = array();

//for each row
while($row = mysql_fetch_array($result)){

	$word = $row['word'];
	
	$vector[$word] = 0;

	for($i = 0; $i < $loop; $i++){

		if($word == $query[$i]){	

			if($vector[$word] > 0){
			
				$vector[$word]++;

			}else{

				$vector[$word] = 1;

			}

		}

	}

}


?>
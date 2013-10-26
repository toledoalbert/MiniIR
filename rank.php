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

	for($i = 0; $i < count($query); $i++){

		if($word == $query[$i]){	

			if($vector[$word] > 0){

				$vector[$word]++;

			}else{

				$vector[$word] = 1;

			}

		}

	}

}

//Arrays that we will need
//$frequency = array(); //two dimensional
$rankings = array(); //one dimensional
$col = array();	//one dimensional

for($i = 351; $i < 401; $i++){

	//number of tables
	$sql = "SELECT * FROM freq";
	$result = mysql_query($sql);

	while($row = mysql_fetch_array($result)){

		$word = $row['word'];

		$fr = $row[$i];

		$col[$word] = $fr;

	}

	//$dot = 0;

	if(count($vector === count($col))){
		/*foreach(array_combine($vector, $col) as $vec => $column){
			$dot += $vec*$column;
			echo $vec . "*" . $column . " = " . $dot . "</br>";
		}*/

		foreach($col as $key => $value){
			$dot += $value * $vector[$key]; 
			//echo $value . "*" . $vector[$key] . " = " . $dot . "</br>";
		}

	}

	foreach($col as $val){
		$colMag += pow($val, 2);
	}

	$colMag = sqrt($colMag);

	foreach($vector as $val){
		$vecMag += pow($val, 2);
	}

	$vecMag = sqrt($vecMag);

	$cos = $dot/($vecMag*$colMag);

	$rankings[$i] = $cos;

	//echo $i . ": " . $cos . "</br>";
}

arsort($rankings);

print_r($rankings);




?>
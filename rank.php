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


/*function dotp($arr1, $arr2){
     return array_sum(array_map(create_function('$a, $b', 'return $a * $b;'), $arr1, $arr2));
}

//$similarity=dotp($id1,$id2)/sqrt(dotp($id1,$id1)*dotp($id2,$id2));

function cosSim($arr1, $arr2){
	$similarity = dotp($arr1,$arr2)/sqrt(dotp($arr1,$arr1)*dotp($arr2,$iarr2));
	return $similarity;
}*/

/*function similarity($A, $B)
{
    // This means they are simple text vectors
    // so we need to count to make them vectors
	if (is_int(key($A)))
		$v1 = array_count_values($A);
	else
		$v1 = $A;
	if (is_int(key($B)))
		$v2 = array_count_values($B);
	else
		$v2 = $B;

	$prod = 0.0;
	$v1_norm = 0.0;
	foreach ($v1 as $i=>$xi) {
		if (isset($v2[$i])) {
			$prod += $xi*$v2[$i];
		}
		$v1_norm += $xi*$xi;
	}
	$v1_norm = sqrt($v1_norm);

	$v2_norm = 0.0;
	foreach ($v2 as $i=>$xi) {
		$v2_norm += $xi*$xi;
	}
	$v2_norm = sqrt($v2_norm);

	return $prod/($v1_norm*$v2_norm);
}*/

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


	echo $i . ": " . $dot . "</br>";
}




?>
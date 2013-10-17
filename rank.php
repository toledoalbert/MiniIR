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


function dotp($arr1, $arr2){
     return array_sum(array_map(create_function('$a, $b', 'return $a * $b;'), $arr1, $arr2));
}

//$similarity=dotp($id1,$id2)/sqrt(dotp($id1,$id1)*dotp($id2,$id2));

function cosSim($arr1, $arr2){
	$similarity = dotp($arr1,$arr2)/sqrt(dotp($arr1,$arr1)*dotp($arr2,$iarr2));
	return $similarity;
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

	include("vendor/autoloader.php");

	use NlpTools\Similarity\CosineSimilarity;

	$sim = new CosineSimilarity();

	$sim = $sim->similarity($vector, $col);

	echo $i . ": " . $sim . "</br>";

}




?>
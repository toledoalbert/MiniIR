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

if (file_exists('topics.xml')) {
	$xml = simplexml_load_file('topics.xml');

	for($i = 0; $i < 50; $i++){
		echo '<h5>'.$xml->top[$i]->num.'</h5>';
		echo '<h1>'.$xml->top[$i]->title.'</h1>';
		echo '<h3>'.$xml->top[$i]->desc.'</h3>';
		echo '<h4>'.$xml->top[$i]->narr.'</h4></br></br>';
	}	

} else {
	exit('Failed to open person.xml.');
}




	//echo $xml;
	//$xml = simplexml_load_string('topics.xml');
	//print_r($xml);
	//$num = 'dasdasddasdasd';
	//echo $xml->top[1];
	//echo $num;
	//echo $xml->top[0]->desc;
	//echo "dasdas";

?>
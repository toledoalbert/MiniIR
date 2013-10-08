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

echo 'entering the loop</br>';

//get the articles from the docs table
for($i = 351; $i < 401; $i++){

	echo 'processing number '.$i.'</br>';

	//write the sql query to select the row of that single article
	$query = "SELECT * FROM docs WHERE num='$i'";

	echo 'sql query = '.$query.'</br>';

	//submit the mysql query
	$result = mysql_query($query, $con);

	echo $result.'</br>';

	//put the row in an array
	$row = mysql_fetch_array($result);

	echo $row.'</br>';

	//put all the fields together to one big string
	$all = $row['title'] + " " + $row['description'] + " " + $row['narrative'];
	//echo $row['title']; 
	//echo $row['desc']; 
	echo $row['narrative'];

	//echo $row['title'] + ;

	//echo $all.'</br>';


}

?>
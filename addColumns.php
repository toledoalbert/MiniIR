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

for($i = 351; $i < 401; $i++){

	//add a new column for each document
	$query = "ALTER TABLE  `freq` ADD  `$i` INT( 11 ) NOT NULL";

	$result = mysql_query($query, $con);

}

?>
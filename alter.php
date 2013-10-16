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

	for($doc = 351; $doc < 401; $doc++){
		$query = "ALTER TABLE `normal` MODIFY `$doc` DECIMAL(65,12)";
		mysql_query($query, $con);
	}

?>
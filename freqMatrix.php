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

//get the articles from the docs table
for($i = 351; $i < 401; $i++){

	//write the sql query to select the row of that single article
	$query = "SELECT * FROM docs WHERE num='$i'";

	//submit the mysql query
	$result = mysql_query($query, $con);

	//put the row in an array
	$row = mysql_fetch_array($result);

	//put all the fields together to one big string
	$all = $row['title']. " " . $row['description'] . " " . $row['narrative'];

	//trim the string
	$all = trim($all);

	//put all the words in an array
	$all = explode(" ", $all);

	//load list of common words
 	$stopwords = file('stopwords.txt');
 	//$stopwords = array('is', "the");

	/*remove every word from array if it is a stopword
	foreach( $all as $key => $val ) {

		//trim the word before matching
		$val = trim($val);

		if( in_array($val, $stopwords) ) {
			unset($all[$key]);    
		}
	}*/

	//remove the stop words from the array of words
	$pure = array_diff($all, $stopwords);

	//print_r($pure);

	//echo implode(" ", $pure);

	//add a new column for each document
	$query = "ALTER TABLE  `freq` ADD  `$i` VARCHAR( 255 ) NOT NULL";

	$result = mysql_query($query, $con);

	//count the occurances of the words in the document
	$counts = array_count_values($pure);

	//print_r($counts); 

	//for each word insert a row
	foreach($counts as $key => $val){

		addslashes($key);
		addslashes($val);

		//query to insert the info
		$query = "INSERT INTO freq (word, '$i') VALUES ('$key', '$val')";

		//run the query
		$result = mysql_query($con, $query);

		//if($result){ echo "success";}else{echo mysql_error();}

		//echo "</br></br>";

	}

}

//


?>
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
	print_r($all); echo "</br></br></br>";
	//load list of common words
 	$stopwords = file('stopwords.txt', FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
 	//$stopwords = array('is', "the");
 	print_r($stopwords); echo "</br></br></br>";
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
	print_r($pure); echo "</br></br></br>";
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

		//addslashes($key);
		//addslashes($val);

		$key = trim($key, ",./?!'\)\(:;-*^$%#@!\"=+/");
		$key = trim($key);
		$val = strval($val);

		if(in_array($key, $stopwords)){
			echo $key."</br>";
		}

		if($key != ""){
		//query to insert the info
		$query = "INSERT INTO freq (word) VALUES ('$key')";
		}

		//run the query
		$result = mysql_query($query, $con);

		//print_r($result);

		if($result){ echo "success";}else{echo mysql_error()."</br>";}

		//echo "</br></br>";

	}
	
}

//


?>
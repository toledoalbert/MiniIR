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

//if the file exists
if (file_exists('topics.xml')) {

	//load the xml file
	$xml = simplexml_load_file('topics.xml');

	//for 50 times go thru the xml, parse and store to db
	for($i = 0; $i < 50; $i++){

		//parse and get the info
		$num = mysql_real_escape_string($xml->top[$i]->num);
		$title = mysql_real_escape_string($xml->top[$i]->title);
		$desc = mysql_real_escape_string($xml->top[$i]->desc);
		$narr = mysql_real_escape_string($xml->top[$i]->narr);

		//divide strings by : to get rid of the entry word
		$num = substr($num,strpos($num,":")+1);
		$title = substr($title,strpos($title,":")+1);
		$desc = substr($desc,strpos($desc,":")+1);
		$narr = substr($narr,strpos($narr,":")+1);

		//create sql query
		$sql = "INSERT INTO docs (num, title, description, narrative) VALUES ('$num', '$title', '$desc', '$narr')";

		//submit the sql query and store bool value to variable
		$query = mysql_query($sql, $con);

		//check if query successfull
		if (!$query){
			echo ('Error: ' . mysql_error()."</br>");
		}
		else {
			echo "Record number". $i . "added </br>";
		}
	}

	//close the connection with the server
	mysql_close($con);	

} else {
	exit('Failed to open person.xml.');
}




?>
<?php 

	//xml parser
	//load the topics.xml file

if (file_exists('topics.xml')) {
	$xml = simplexml_load_file('topics.xml');

	print_r($xml);
	print_r($xml->top);

} else {
	exit('Failed to open person.xml.');
}

echo $xml->top->desc;


	//echo $xml;
	//$xml = simplexml_load_string('topics.xml');
	//print_r($xml);
	//$num = 'dasdasddasdasd';
	//echo $xml->top[1];
	//echo $num;
	//echo $xml->top[0]->desc;
	//echo "dasdas";

?>
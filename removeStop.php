<?php

	//$stopwords = array('in', 'the', 'a', 'to', 'I', 'I\'ll');
	$stopwords = file('stopwords.txt', FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

	print_r($stopwords);

	$all = 'I went to the market to get a choacalate.';

	$all = explode(" ", $all);

	$all = array_diff($all, $stopwords);

	$all = implode(" ", $all);

	echo $all;



?>
<?php

	//load list of common words
	$stopwords = file('stopwords.txt');   

    $all = explode(" ", $str);
    foreach( $all as $key => $val ) {
        if( in_array($val, $stopwords) ) {
            unset($all[$key]);    
        }
    }
    
    $ implode(" ", $str);

?>
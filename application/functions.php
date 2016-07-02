<?php

function showArray($array){
    echo '<pre>', print_r($array, true), '</pre>';
}

function uploadFile($file, $input, $name){
    move_uploaded_file($file[$input]['tmp_name'], $_SERVER['DOCUMENT_ROOT'].$name);
}

function getCurrentUrl(){
	$protocol = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == "on")?'https':'http';
	return $protocol.'://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
}

function setClassFromSettings($settings){
	foreach($settings as $attribute => $val){
		
		// BACKGROUND COLOR
		if(strripos($attribute, '_background-color')){
			echo '.'.$attribute.'{'.PHP_EOL;
			echo 'background-color: '.$val.' !important;'.PHP_EOL;
			echo '}'.PHP_EOL;
		}
		// TEXT COLOR
		if(strripos($attribute, '_color')){
			echo '.'.$attribute.'{'.PHP_EOL;
			echo 'color: '.$val.' !important;'.PHP_EOL;
			echo '}'.PHP_EOL;
		}
	}
}

?>
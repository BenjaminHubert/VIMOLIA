<?php

function showArray($a){
    echo '<pre>', print_r($a, true), '</pre>';
}

function uploadFile($file, $input, $name){
    move_uploaded_file($file[$input]['tmp_name'], $_SERVER['DOCUMENT_ROOT'].$name);
}





?>
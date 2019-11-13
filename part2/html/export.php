<?php
require_once("include/functions.php");

if(check_signed_in()){
    $username = md5($_SESSION["username"]); //md5 is just to avoid spaces and so on
    $file = "./keys/$username.pem";

	header("Content-Description: File Transfer"); 
	header("Content-Type: application/octet-stream"); 
	header("Content-Disposition: attachment; filename=\"". basename("$username.pem") ."\""); 

	readfile($file);
}
exit(); 
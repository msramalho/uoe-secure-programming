<?php
require_once("include/functions.php");
post_only();
login_only();

if (strlen($_POST["message"]) > 10000) echo_and_die("Message length should be less than 10k chars");

$pubKey = file_get_contents($_FILES["pem"]["tmp_name"]);
openssl_public_decrypt(base64_decode($_POST["signed"]), $decrypted, $pubKey);

if($decrypted == $_POST["message"]){
    echo "This digital signature is valid";
}else{
    echo "This digital signature is NOT valid";
}
<?php
require_once("include/functions.php");
post_only();
logout();

if(!signup($_POST["username"], $_POST["password"])) exit();

// get private, public keys
$res = openssl_pkey_new(["private_key_bits" => 2048, "private_key_type" => OPENSSL_KEYTYPE_RSA]);

// Extract the private key from $res to $priKey
openssl_pkey_export($res, $priKey);

// Extract the public key from $res to $pubKey
$pubKey = openssl_pkey_get_details($res);
$pubKey = $pubKey["key"];
$username = md5($_POST["username"]); //md5 is just to avoid spaces and so on
file_put_contents("./keys/$username.pem", $pubKey);
file_put_contents("./keys/$username.pri", $priKey);

login($_POST["username"], $_POST["password"]);
header("Location: dashboard.php");

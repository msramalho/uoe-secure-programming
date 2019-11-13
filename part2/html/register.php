<?php
//setup
require_once("include/functions.php");
post_only();
// $db = get_db();
//check validity of data
// if (!check_uniqueness($db, $_POST["username"]))	echo_and_die("Username must be unique");
// if (!is_password_secure($_POST["password"])) echo_and_die("Password is not secure");
signup($_POST["username"], $_POST["password"]);


$pubKey = "public";
$priKey = "private";
$username = md5($_POST["username"]); //md5 is just to avoid spaces and so on
file_put_contents("./keys/$username.pub", $pubKey);
file_put_contents("./keys/$username.pri", $priKey);
// also save a pem version
openssl_pkey_export($pubKey, $pem);
file_put_contents("./keys/$username.pem", $pem);


// var_dump(openssl_error_string());

// get private, public keys
// $res = openssl_pkey_new(["private_key_bits" => 2048, "private_key_type" => OPENSSL_KEYTYPE_RSA]);

// Extract the private key from $res to $priKey
// openssl_pkey_export($res, $priKey);

// Extract the public key from $res to $pubKey
// $pubKey = openssl_pkey_get_details($res);
// $pubKey = $pubKey["key"];

/* Encrypt the data using the public key
 * The encrypted data is stored in $encrypted */
// openssl_public_encrypt($data, $encrypted, $pubKey);

/* Decrypt the data using the private key and store the
 * result in $decrypted. */
// openssl_private_decrypt($encrypted, $decrypted, $privKey);

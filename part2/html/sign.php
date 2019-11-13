<?php
require_once("include/functions.php");
post_only();

if (strlen($_POST["message"]) > 10000) echo_and_die("Message length should be less than 10k chars");

$pubKey = get_public_key();
/* Encrypt the data using the public key
 * The encrypted data is stored in $encrypted */
// openssl_public_encrypt($_POST["message"], $encrypted, $pubKey);

echo $encrypted;
exit();


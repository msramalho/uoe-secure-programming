<?php
require_once("include/functions.php");
post_only();
login_only();

if (strlen($_POST["message"]) > 10000) echo_and_die("Message length should be less than 10k chars");

// The encrypted data is stored in $encrypted
openssl_private_encrypt($_POST["message"], $encrypted, get_private_key());

echo base64_encode($encrypted);
exit();


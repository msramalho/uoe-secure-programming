<?php
require_once("include/functions.php");
post_only();

if (login($_POST["username"], $_POST["password"])) {
	header("Location: dashboard.php");
} else {
	header("Location: index.php?error=login%20failed");
}
exit();
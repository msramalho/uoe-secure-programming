<?php require_once("include/functions.php"); ?>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Dashboard</title>

	<!-- Bootstrap -->
	<link href="css/bootstrap.min.css" rel="stylesheet">

<body>
	<div class="jumbotron">
		<h1>Dashboard for <?= htmlspecialchars($_SESSION["username"], ENT_QUOTES, 'UTF-8'); ?></h1>
	</div>

	<div class="container">
		<h1>Export key</h1>
		<a href="export.php">Export Public Key</a>
		<hr>

		<h1>Sign message</h1>
		<form name="sign" class="form-horizontal" action="sign.php" method="post">
			<textarea name="message" id="message" placeholder="your message to sign (max 10000 chars)" style="width:50%;"></textarea>
			<br>
			<button type="submit" class="btn btn-default">Sign message</button>
		</form>
		<hr>

		<h1>Digital Signature Verification</h1>
		<form name="verify" class="form-horizontal" action="sign.php" method="post">
			<textarea name="message" id="message" placeholder="your message to verify (max 10000 chars)" style="width:50%;"></textarea>
			<br>
			<textarea name="signed" id="signed" placeholder="your signed message" style="width:50%;"></textarea>
			<br>
			PEM file: <input type="file" name="pem" id="pem">
			<button type="submit" class="btn btn-default">Verify Digital Signature</button>
		</form>
	</div>

	<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
	<!-- Include all compiled plugins (below), or include individual files as needed -->
	<script src="js/bootstrap.min.js"></script>
</body>

</html>
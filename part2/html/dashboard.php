<?php require_once("include/functions.php");
// $_SESSION["username"] = "lelel";
?>
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
		<?php
			var_dump($_SESSION);
		?>
		<h1>Dashboard for <?= htmlspecialchars($_SESSION["username"], ENT_QUOTES, 'UTF-8'); ?></h1>
	</div>

	<div class="container">
	</div>

	<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
	<!-- Include all compiled plugins (below), or include individual files as needed -->
	<script src="js/bootstrap.min.js"></script>
</body>

</html>
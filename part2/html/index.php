<?php require_once("include/functions.php"); ?>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Super Secure Digital Signature Service</title>

	<!-- Bootstrap -->
	<link href="css/bootstrap.min.css" rel="stylesheet">

	<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body>
	<div class="jumbotron">
		<h1>Super Secure Digital Signature Service</h1>
	</div>

	<div class="container">
		<?php if (array_key_exists("error", $_GET)) : ?>
			<span style="color:red" ;><?= $_GET["error"] ?></span>
		<?php endif; ?>
		<form name="signup" class="form-horizontal" action="register.php" method="post">
			<legend>Sign up</legend>
			<div class="control-group">
				<label class="control-label" for="username">User name</label>
				<div class="controls">
					<input id="username" name="username" type="text" placeholder="username" class="input-medium" required="">
				</div>
			</div>
			<div class="control-group">
				<label class="control-label" for="password">Password</label>
				<div class="controls">
					<input id="password" name="password" type="password" placeholder="password" class="input-medium" required="">
				</div>
			</div>
			<div class="control-group">
				<label class="control-label" for="createaccount"></label>
				<div class="controls">
					<button id="signup" name="signup" type="submit" value="signup" class="btn btn-default">Sign up</button>
				</div>
			</div>
		</form>
		<form name="login" class="form-horizontal" action="login.php" method="post">
			<legend>Login</legend>
			<div class="control-group">
				<label class="control-label" for="username">User name</label>
				<div class="controls">
					<input id="username" name="username" type="text" placeholder="username" class="input-medium" required="">
				</div>
			</div>
			<div class="control-group">
				<label class="control-label" for="password">Password</label>
				<div class="controls">
					<input id="password" name="password" type="password" placeholder="password" class="input-medium" required="">
				</div>
			</div>
			<div class="control-group">
				<label class="control-label" for="createaccount"></label>
				<div class="controls">
					<button id="login" name="login" type="submit" value="login" class="btn btn-default">Log in</button>
				</div>
			</div>
		</form>
	</div>

	<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
	<!-- Include all compiled plugins (below), or include individual files as needed -->
	<script src="js/bootstrap.min.js"></script>
</body>

</html>
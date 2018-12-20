<!DOCTYPE HTML>

<html lang="en">
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="./styles/style.css"/>
	<title>Timeshard</title>
</head>

<body>
	<div id="header">
		<img src="./img/logo.png"/>
	</div>
	<div id="body">
			<div id="logincontainer">
			<form method="POST" action="." class="textcenter">
				<h1 id="logintext" class="textgreen">Login</h1>
				<?php 
					if($_SERVER["REQUEST_METHOD"] == "POST")
					{
						require("./scripts/login.php");
					}
				?>
				<br/>
				<input type="text" name="username" /> <br />
				<input type="password" name="password"/> <br />
				<input type="submit" /> <br />
			</form>
            <a href="./pages/shared/resetpassword.php">Forgot Password?</a>
		</div>
	</div>
	<div id="footer">

	</div>
</body>
</html>
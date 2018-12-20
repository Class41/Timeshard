<!DOCTYPE HTML>

<?php     
	$valid = true; 
?>

<html lang="en">
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="./styles/style.css"/>
	<link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro" rel="stylesheet">
	<title>Timeshard - Login</title>
</head>

<body>
	<div id="header">
		<img src="./img/logo.png"/>
	</div>
	<div id="body">
			<div id="logincontainer" <?php echo "Value" . var_dump($GLOBALS["valid"]); if($GLOBALS["valid"] == false) { echo 'class="shakeonload"'; }?>>
			<form method="POST" action="." class="textcenter">
				<h1 class="textgreen">Login</h1>
				<?php 
					if($_SERVER["REQUEST_METHOD"] == "POST")
					{
						require("./scripts/login.php");
					}
				?>
				<br/>
				<input class="formitem" type="text" name="username" placeholder="Username"/> <br />
				<input class="formitem" type="password" name="password" placeholder="Password"/> <br />
				<input id="loginbutton" type="submit" value="Login"/> <br />
			</form>
			<hr/>
			<div id="createaccount" class="loginbuttons">Forgot Password</div>
			<div id="resetaccount" class="loginbuttons">Create Account</div>
		</div>
	</div>
	<div id="footer">

	</div>
</body>
</html>
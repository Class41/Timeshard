<!DOCTYPE HTML>

<?php
	$valid = true;
	$posted = false;
?>

<html lang="en">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="./styles/login.css" />
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro|Muli" rel="stylesheet">
    <title>Timeshard - Login</title>
</head>

	<?php
		if($_SERVER["REQUEST_METHOD"] == "POST")
		{
			$GLOBALS["posted"] = true;
			require("./scripts/login.php");
		}
	?>

<body>
    <div id="header">
        <img id="menulogo" src="./img/logo.png" />
    </div>

    <div id="body">
        <div id="logincontainer" <?php if($GLOBALS["valid"] == false) { echo 'class="shakeonload"'; }?>>
			<form method="POST" action="." class="textcenter">
				<div class="divheader">
					<h1 class="textgreen">Login</h1>
				</div>
				<div class="errorticker" <?php if($GLOBALS["valid"] == false) { echo 'style="display: block;"'; }?>>
				Invalid Credentials
				</div>
				<br/>
				<input class="formitem" type="text" name="username" placeholder="Username" <?php if($GLOBALS["posted"] == true) { echo "value=\"" . $_POST["username"] . "\""; } ?>/> <br />
				<input class="formitem" type="password" name="password" placeholder="Password"/> <br />
				<input id="loginbutton" type="submit" value="Login"/> <br />
			</form>
			<hr/>
			<div id="resetaccount" class="loginbuttons" onclick="window.location.assign('./pages/shared/forgot.php');">Forgot Password</div>
			<div id="createaccount" class="loginbuttons" onclick="window.location.assign('./pages/shared/accountcreate.php');">Create Account</div>
		</div>
    </div>
</body>
</html>
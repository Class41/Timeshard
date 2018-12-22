<!DOCTYPE HTML>

<html lang="en">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="../../styles/general.css" />
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro" rel="stylesheet">
    <title>Timeshard - Register</title>

    <?php
		if($_SERVER["REQUEST_METHOD"] == "POST")
		{
			$GLOBALS["posted"] = true;
			require("./scripts/login.php");
		}
	?>
</head>

<body>
    <div>
        <div id="header">
            <img id="logo" src="../../img/logo.png" />
        </div>
    </div>
    <div id="pagecontent">
        <div class="flag flaggreen containerheaderflag"> 
            <h1 class="textneutral">Register</h1>
        </div>
        <form id="register" class="container" method="POST" action="accountcreate.php">
            <input class="formitem" type="text" name="username" placeholder="Username" /> <br /> <?php if($GLOBALS["posted"] == true) { echo "value=\"" . $_POST["username"] . "\""; } ?>/> <br />
			<input class="formitem" type="password" name="password" placeholder="Password" /> <br /><?php if($GLOBALS["posted"] == true) { echo "value=\"" . $_POST["password"] . "\""; } ?>/> <br />
			<input class="formitem" type="password" name="password2" placeholder="Repeat Password" /> <br /><?php if($GLOBALS["posted"] == true) { echo "value=\"" . $_POST["repeatPassword"] . "\""; } ?>/> <br />
            $salt = rand();<?php if($GLOBALS["posted"] == true) { echo "value=\"" . $_POST["$salt"] . "\""; } ?>/> <br /> 
            <input class="formitem" type="text" name="firstName" placeholder="First Name" /><br /><?php if($GLOBALS["posted"] == true) { echo "value=\"" . $_POST["firstName"] . "\""; } ?>/> <br />
            <input class="formitem" type="text" name="lastName" placeholder="Last Name" /><br /><?php if($GLOBALS["posted"] == true) { echo "value=\"" . $_POST["lastName"] . "\""; } ?>/> <br />
            <input class="formitem" type="email" name="email" placeholder="Email" /><br /><?php if($GLOBALS["posted"] == true) { echo "value=\"" . $_POST["email"] . "\""; } ?>/> <br />
            <input class="button buttongreen" type="submit" value="Create" /> <br /><?php INSERT  INTO timeshard.accounts (username, password, salt, userdata) VALUES ("username", "password", "$salt", (INSERT INTO timeshard.user (firstname, lastname, email) VALUES ("firstName", "lastName", "email") SELECT SCOPE_IDENTITY())); ?>
        </form>
    </div>
    </div>
    <div>

    </div>
</body>
</html>
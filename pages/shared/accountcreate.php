<!DOCTYPE HTML>

<html lang="en">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="../../styles/general.css" />
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script src="../../scripts/registervalid.js"></script>
    <title>Timeshard - Register</title>
</head>

<?php
        $posted = false;
		if($_SERVER["REQUEST_METHOD"] == "POST")
		{
			$GLOBALS["posted"] = true;
			require("../../scripts/registersubmit.php");
		}
?>

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
            <input class="formitem" type="text" name="username" placeholder="Username" <?php if($GLOBALS["posted"] == true) { echo "value=\"" . $_POST["username"] . "\"";}?> /> <br />
			<input class="formitem" type="password" name="password" placeholder="Password"/> <br />
			<input class="formitem" type="password" name="password2" placeholder="Repeat Password"/> <br />
            <input class="formitem" type="text" name="firstName" placeholder="First Name" <?php if($GLOBALS["posted"] == true) { echo "value=\"" . $_POST["firstName"] . "\"";}?> /><br />
            <input class="formitem" type="text" name="lastName" placeholder="Last Name" <?php if($GLOBALS["posted"] == true) { echo "value=\"" . $_POST["lastName"] . "\"";}?> /><br />
            <input class="formitem" type="email" name="email" placeholder="Email" <?php if($GLOBALS["posted"] == true) { echo "value=\"" . $_POST["email"] . "\"";}?> /><br />
            <input class="button buttongreen" type="submit" value="Create" > <br />
        </form>
    </div>
    </div>
    <div>

    </div>
</body>
</html>
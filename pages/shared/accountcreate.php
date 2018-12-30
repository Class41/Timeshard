<!DOCTYPE HTML>

<html lang="en">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="../../styles/general.css" />
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro" rel="stylesheet">
    <!--script src="../../scripts/registervalid.js"></script-->
    <title>Timeshard - Register</title>
</head>

<?php
        $posted = false;
		if($_SERVER["REQUEST_METHOD"] == "POST")
		{
			$GLOBALS["posted"] = true;
			require("../../scripts/formValidation.php");
		}
?>



<!--?php
        $posted = false;
		if($_SERVER["REQUEST_METHOD"] == "POST")
		{
			$GLOBALS["posted"] = true;
			require("../../scripts/registersubmit.php");
		}
?-->

<body onload="RegisterButtonLock();">
    <div>
        <div id="header">
            <img id="logo" src="../../img/logo.png" />
        </div>
    </div>
    <div id="pagecontent">
        <div class="flag flaggreen containerheaderflag"> 
            <h1 class="textneutral">Register</h1>
        </div>
    <div id="register" class="container">
        <div>
            <form novalidate id="register" method="POST" action="accountcreate.php";>
                <input class="formitem" type="text" name="username" placeholder="Username" oninput="UserNameCheck(); RegisterButtonLock();" <?php if($GLOBALS["posted"] == true) { echo "value=\"" . $_POST["username"] . "\"";}?> <?php if($GLOBALS["posted"] == true) {echo"value=\"" . $GLOBALS["usernameErr"] . "\"";}?> /> <br />
                <input class="formitem" type="password" name="password" oninput="PasswordCheck(); RegisterButtonLock();" placeholder="Password"/><?php if($GLOBALS["posted"] == true) { echo"value=\"" . $GLOBALS["$passwordErr"] . "\"";}?> <br />
                <input class="formitem" type="password" name="password2" oninput="PasswordRepeatCheck(); RegisterButtonLock();" placeholder="Repeat Password"/><?php if($GLOBALS["posted"] == true) { echo"value=\"" . $GLOBALS["$repeatpasswordErr"] . "\"";}?><br />
                <input class="formitem" type="text" name="firstName" oninput="FirstNameCheck(); RegisterButtonLock();" placeholder="First Name" <?php if($GLOBALS["posted"] == true) { echo "value=\"" . $_POST["firstName"] . "\"";}?><?php if($GLOBALS["posted"] == true) { echo"value=\"" . $GLOBALS["firstNameErr"] . "\"";}?> /><br />
                <input class="formitem" type="text" name="lastName" oninput="LastNameCheck(); RegisterButtonLock();" placeholder="Last Name" <?php if($GLOBALS["posted"] == true) { echo "value=\"" . $_POST["lastName"] . "\"";}?><?php if($GLOBALS["posted"] == true) { echo"value=\"" . $GLOBALS["lastNameErr"] . "\"";}?> /><br />
                <input class="formitem" type="email" name="email" oninput="EmailCheck(); RegisterButtonLock();" placeholder="Email" <?php if($GLOBALS["posted"] == true) { echo "value=\"" . $_POST["email"] . "\"";}?> <?php if($GLOBALS["posted"] == true) { echo"value=\"" . $GLOBALS["emailErr"] . "\"";}?>/><br />
                <input id="formsubmit" class="button buttongreen" type="submit" value="Create"> <br />
            </form>
        </div>
    </div>

        
        

    </div>
    </div>
    <div>

    </div>
</body>
</html>
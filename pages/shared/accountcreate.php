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

$usernameErr = isset($_POST['username']) ? $_POST['password'] : NULL;
$passwordErr = isset($_POST['password']) ? $_POST['password'] : NULL;
$repeatpasswordErr = isset($_POST['repeatpassword']) ? $_POST['repeatpassword'] : NULL;
$firstNameErr = isset($_POST['firstName']) ? $_POST['firstName'] : NULL;
$lastNameErr = isset($_POST['lastName']) ? $_POST['lastName'] : NULL;
$emailErr = isset($_POST['email']) ? $_POST['email'] : NULL;

?>

<?php
        $GLOBALS["posted"] = false;
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
                <p><span class="error">* required field</span></p>
                <p><span> Only letters and numbers with a minimum of 8 Characters. No white space allowed for Username. </span></p>
                <p><span> Passowords have to have atleast 1 Uppercase and valid Special Character with a minimum length of 8 and Maximum Length of 96.</span></p>
                <p><span> First and last names cannot be anything other than letters.</span></p>
                <p><span> Only letters and numbers with a minimum of 8 Characters. No white space allowed for Username. </span></p>
                <p><span> Please give a valid email Address. </span></p>


                <input class="formitem" type="text" name="username" placeholder="Username" oninput="UserNameCheck(); RegisterButtonLock();" <?php if($GLOBALS["posted"] == true) { echo "value=\"" . $_POST["username"] . "\"";}?> /><span class="error">* <?php echo $GLOBALS["usernameErr"];?></span>
                <input class="formitem" type="password" name="password" oninput="PasswordCheck(); RegisterButtonLock();" placeholder="Password" /><span class="error">* <?php echo $GLOBALS["passwordErr"];?></span>
                <input class="formitem" type="password" name="password2" oninput="PasswordRepeatCheck(); RegisterButtonLock();" placeholder="Repeat Password" /><span class="error">* <?php echo $GLOBALS["repeatpasswordErr"];?></span>
                <input class="formitem" type="text" name="firstName" oninput="FirstNameCheck(); RegisterButtonLock();" placeholder="First Name" <?php if($GLOBALS["posted"] == true) { echo "value=\"" . $_POST["firstName"] . "\"";}?> /><span class="error">* <?php echo $GLOBALS["firstNameErr"];?></span>
                <input class="formitem" type="text" name="lastName" oninput="LastNameCheck(); RegisterButtonLock();" placeholder="Last Name" <?php if($GLOBALS["posted"] == true) { echo "value=\"" . $_POST["lastName"] . "\"";}?> /><span class="error">* <?php echo $GLOBALS["lastNameErr"];?></span>
                <input class="formitem" type="email" name="email" oninput="EmailCheck(); RegisterButtonLock();" placeholder="Email" <?php if($GLOBALS["posted"] == true) { echo "value=\"" . $_POST["email"] . "\"";}?> /><span class="error">* <?php echo $GLOBALS["emailErr"];?></span>
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
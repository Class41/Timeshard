<?php
//var_dump($_POST);  //for testing purposes
// define variables and set to empty values
$usernameErr = $passwordErr = $repeatpasswordErr = "";
$firstNameErr = $lastNameErr = "";
$emailErr = "";
$username = $firstName = $lastName = "";  
$password = $reapeatpassword = ""; 
$email = "";
$isValid = true; 
function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  /*$data = htmlspecialchars($data);*/
  return $data;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (empty($_POST["username"])) {
    $usernameErr = "username is required";
    $isValid == false;
  } else {
    $username = ($_POST["username"]);
    // check if name only contains letters and whitespace
    if (!preg_match("/^[a-zA-Z0-9]{6,30}$/",$username)) {
      $usernameErr = "Only letters and numbers. No white space allowed";
       $isValid == false; 
    }
  }
    
if(!empty($_POST["password"]) && ($_POST["password"] == $_POST["password2"])) {
$password = test_input($_POST["password"]);
$repeatpassword = test_input($_POST["password2"]);
    if ((strlen($_POST["password"]) <= '8') && (strlen($_POST["password"]) > 96)) {
        $passwordErr = "Your Password Must Contain At Least 8 Characters and not longer than 96 Characters";
        $isValid == false;
    }
    elseif(!preg_match('#[0-9]+#',$password)) {
        $passwordErr = "Your Password Must Contain At Least 1 Number!";
        $isValid == false;
    }
    elseif(!preg_match('#[A-Z]+#',$password)) {
        $passwordErr = "Your Password Must Contain At Least 1 Capital Letter!";
        $isValid == false;
    }
    elseif(!preg_match('#[a-z]+#',$password) || preg_match('#[\~\`\!\#\$\%\\^\&\*\+\=\[\]\\\'\;\,\/\{\}\|\\\:\<\>\\\?]+#',$password)) {
        $passwordErr = "Your Password Must Contain At Least 1 Lowercase Letter and a valid special Character!";
        $isValid == false;
    }
}
elseif(!empty($_POST["password2"])) {
    $repeatpasswordErr = "Please Check You've Entered Or Confirmed Your Password!";
    $isValid == false;
    
} else {
     $passwordErr = "Please enter password";
}    
  if (empty($_POST["firstName"])) {
    $firstNameErr = "Name is required";
    $isValid == false;
  } else {
    $firstName = test_input($_POST["firstName"]);
    // check if name only contains letters and whitespace
    if (!preg_match("/^[a-zA-Z]{1,30}$/",$firstName)) {
      $firstNameErr = "Only letters and no white space allowed"; 
      $isValid == false;
    }
  }
  
  if (empty($_POST["lastName"])) {
    $lastNameErr = "Name is required";
    $isValid == false;
  } else {
    $lastName = test_input($_POST["lastName"]);
    // check if name only contains letters and whitespace
    if (!preg_match("/^[a-zA-Z]{1,30}$/",$lastName)) {
      $lastNameErr = "Only letters and white space allowed";
      $isValid == false;
    }
  }
    // check if name only contains letters and whitespace
    if (empty ($_POST["email"])) {
      $emailErr = "Email is required";
      $isValid == false;
    } else {
      $email = ($_POST["email"]);
      // check if e-mail address is well-formed
      if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $emailErr = "Invalid email format";
          $isValid == false; 
      }
    }
  
  
  
  if ($isValid == true){
    require("../../scripts/registersubmit.php");
  }    
      
  
  
  
  
  }
    
//Couldn't get zipcode to work right, and did not do a proper confirmation page. the rest of the validation looks like it works.
//use vardump to verify values/check validation, it should work.  isValid was meant to stop validation and keep it from going to 
//confirmation page beacause validation failed. don't know why I am getting declaration errors. need to fix. 

?>
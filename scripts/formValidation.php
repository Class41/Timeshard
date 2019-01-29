<?php
//var_dump($_POST);  //for testing purposes
// define variables and set to isset values
$isValid = true;
function test_input( $data )
{
    $data = trim( $data );
    $data = stripslashes( $data );
    /*$data = htmlspecialchars($data);*/
    return $data;
}

if ( $_SERVER[ "REQUEST_METHOD" ] == "POST" )
{
    if ( !isset( $_POST[ "username" ] ) )
    {
        $GLOBALS[ "usernameErr" ] = "username is required";
        $isValid == false;
    }
    else
    {
        $username = $_POST[ "username" ];
        // check if name only contains letters and whitespace
        if ( !preg_match( "/^[a-zA-Z0-9]{6,30}$/", $username ) )
        {
            $GLOBALS[ "usernameErr" ] = "Only letters and numbers. No white space allowed";
            $isValid == false;
        }
    }
    
    if ( isset( $_POST[ "password" ] ) && ( $_POST[ "password" ] == $_POST[ "password2" ] ) )
    {
        $password       = test_input( $_POST[ "password" ] );
        $repeatpassword = test_input( $_POST[ "password2" ] );
        if ( ( strlen( $_POST[ "password" ] ) <= '8' ) && ( strlen( $_POST[ "password" ] ) > 96 ) )
        {
            $GLOBALS[ "passwordErr" ] = "Your Password Must Contain At Least 8 Characters and not longer than 96 Characters";
            $isValid == false;
        }
        elseif ( !preg_match( '#[0-9]+#', $password ) )
        {
            $GLOBALS[ "passwordErr" ] = "Your Password Must Contain At Least 1 Number!";
            $isValid == false;
        }
        elseif ( !preg_match( '#[A-Z]+#', $password ) )
        {
            $GLOBALS[ "passwordErr" ] = "Your Password Must Contain At Least 1 Capital Letter!";
            $isValid == false;
        }
        elseif ( !preg_match( '#[a-z]+#', $password ) || preg_match( '#[\~\`\!\#\$\%\\^\&\*\+\=\[\]\\\'\;\,\/\{\}\|\\\:\<\>\\\?]+#', $password ) )
        {
            $GLOBALS[ "passwordErr" ] = "Your Password Must Contain At Least 1 Uppercase Letter and a valid special Character!";
            $isValid == false;
        }
    }
    else {
        $GLOBALS[ "passwordErr" ] = "Your Password Must Contain At Least 1 Lowercase Letter and a valid special Character!";
            $isValid == false;
    }
    if ( isset( $_POST[ "password2" ] ) )
    {
        $GLOBALS[ "repeatpasswordErr" ] = "Please make sure passwords match";
        $isValid == false;
        
    }
    else
    {
        $GLOBALS[ "passwordErr" ] = "Please enter password";
    }
    if ( !isset( $_POST[ "firstName" ] ) )
    {
        $GLOBALS[ "firstNameErr" ] = "Name is required";
        $isValid == false;
    }
    else
    {
        $firstName = test_input( $_POST[ "firstName" ] );
        // check if name only contains letters and whitespace
        if ( !preg_match( "/^[a-zA-Z]{1,30}$/", $firstName ) )
        {
            $GLOBALS[ "firstNameErr" ] = "Only letters and no white space allowed";
            $isValid == false;
        }
    }
    
    if ( !isset( $_POST[ "lastName" ] ) )
    {
        $GLOBALS[ "lastNameErr" ] = "Name is required";
        $isValid == false;
    }
    else
    {
        $lastName = test_input( $_POST[ "lastName" ] );
        // check if name only contains letters and whitespace
        if ( !preg_match( "/^[a-zA-Z]{1,30}$/", $lastName ) )
        {
            $GLOBALS[ "lastNameErr" ] = "Only letters and white space allowed";
            $isValid == false;
        }
    }
    // check if name only contains letters and whitespace
    if ( !isset( $_POST[ "email" ] ) )
    {
        $GLOBALS[ "emailErr" ] = "Email is required";
        $isValid == false;
    }
    else
    {
        $email = ( $_POST[ "email" ] );
        // check if e-mail address is well-formed
        if ( !filter_var( $email, FILTER_VALIDATE_EMAIL ) )
        {
            $GLOBALS[ "emailErr" ] = "Invalid email format";
            $isValid == false;
        }
    }
    
    if ( $isValid == true )
    {
        require( "../../scripts/registersubmit.php" );
    }
    
    
    
    
    
}

//Couldn't get zipcode to work right, and did not do a proper confirmation page. the rest of the validation looks like it works.
//use vardump to verify values/check validation, it should work.  isValid was meant to stop validation and keep it from going to 
//confirmation page beacause validation failed. don't know why I am getting declaration errors. need to fix. 

?>
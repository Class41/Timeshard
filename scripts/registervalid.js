<link rel="stylesheet" type="text/css" href="../../styles/login.css" />

myFunction(value1)
{

value1 = true; 
const emailReg = /^[A-Za-z0-9]+@([A-Za-z0-9]+\.)+[A-Za-z0-9]+/m;
var name_regex = /^[a-zA-Z]/;
var usernameReg = /^{A-Za-z0-9]/;
const pwreg1 = /[A-Z]/m;
const pwreg2 = /[a-z]/m;
const pwreg3 = /[0-9]/m;
const pwreg4 = /[~`!#$%\^&*+=\[\]\\';,\/{}|\:<>\?]/m;
const pwreg5 = /.{8,64}/m;



function firstNameCheck() {
    var field = document.getElementById("firstName");
    var result = name_regex.exec(field.value);

    if (result != null) {
        field.style.borderBottom = "solid green 2px";
    }
    else {
        field.style.borderBottom = "shake";
        value1 = false
    }
}


function lastNameCheck() {
    var field = document.getElementById("lastName");
    var result = name_regex.exec(field.value);

    if (result != null) {
        field.style.borderBottom = "solid green 2px";
    }
    else {
        field.style.borderBottom = "shake";
        value1 = false; 
    }
}

function emailCheck() {
    var field = document.getElementById("email");
    var result = emailReg.exec(field.value);

    if (result != null) {
        field.style.borderBottom = "solid green 2px";
    }
    else {
        field.style.borderBottom = "shake";
        value1 = false; 
    }
}

function userNameCheck() {
    var field = document.getElementById("username");
    var result = emailReg.exec(field.value);

    if (result != null) {
        field.style.borderBottom = "solid green 2px";
    }
    else {
        field.style.borderBottom = "shake";
        value = false; 
    }
}

function passwordCheck() {
    var field = document.getElementById("passsword");
    var result = pwreg5.exec(field.value);

    field.style.borderBottom = "shake";
    value1 = false; 
    if (result != null) {
        result = pwreg1.exec(field.value)
        if (result != null) {
            result = pwreg2.exec(field.value)
            if (result != null) {
                result = pwreg3.exec(field.value)
                if (result != null) {
                    result = pwreg4.exec(field.value)
                    if (result != null) {
                        value1 = true;
                        field.style.borderBottom = "solid green 2px";
                    
                    }
                }
            }
        }
    }

    passwordRepeatCheck();
}



function passwordRepeatCheck() {
    var field1 = document.getElementById("password");
    var field2 = document.getElementById("password2");
    if (field1.value != field2.value) {
        field2.style.borderBottom = "shake";
        value1 = false; 
    }
    else {
        field2.style.borderBottom = "solid green 2px";
    }

}


passwordCheck();
firstNameCheck(); 
lastNameCheck(); 
emailCheck(); 
userNameCheck(); 

return value1; 
}
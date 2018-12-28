var usernameReg = /^[A-Za-z0-9][@]/;

function userNameCheck() {
    var field = document.getElementsByName("username")[0];
    var result = usernameReg.exec(field.value);

    if (result != null) {
        
    }
    else {
        field.style.border(red);
    }
}

var name_regex = /^[a-zA-Z]/;

function firstNameCheck() {
    var field = document.getElementsByName("firstName")[0];
    var result = name_regex.exec(field.value);

    if (result != null) {
         
    }
    else {
        field.style.border(red);
    }
}

function lastNameCheck() {
    var field = document.getElementsByName("lastName")[0];
    var result = name_regex.exec(field.value);

    if (result != null) {
     
    }
    else {
        field.style.border(red);
    }
}


const emailReg = /^[A-Za-z0-9]+@([A-Za-z0-9]+\.)+[A-Za-z0-9]+/m;

function emailCheck() {
    var field = document.getElementsByName("email")[0];
    var result = emailReg.exec(field.value);

    if (result != null) {
        
    }
    else {
        field.style.border(red);
    }
}

var usernameReg = /^{A-Za-z0-9]/;

function userNameCheck() {
    var field = document.getElementsByName("username")[0];
    var result = emailReg.exec(field.value);

    if (result != null) {
         
    }
    else {
        field.style.border(red);
    }
}

function passwordCheck() {
    var field = document.getElementsByName("passsword")[0];
    var result = pwreg5.exec(field.value);
    if (result != null) {
        result = pwreg1.exec(field.value)
        if (result != null) {
            result = pwreg2.exec(field.value)
            if (result != null) {
                result = pwreg3.exec(field.value)
                if (result != null) {
                    result = pwreg4.exec(field.value)
                    if (result != null) {
                        
                    }
                    else 
                    {
                        field.style.border(red); 
                    }
                }
            }
        }
    }
}



function passwordRepeatCheck() {
    var field1 = document.getElementsByName("password")[0];
    var field2 = document.getElementsByName("password2")[0];
    if (field1.value != field2.value) {
        field.style.border(red); 
    }
    else {
    }
}
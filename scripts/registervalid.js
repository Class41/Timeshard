var usernameReg = /^[A-Za-z0-9]{8,30}$/;

function UserNameCheck() {
    var field = document.getElementsByName("username")[0];
    var result = usernameReg.exec(field.value);

    if (result != null) {
        field.style.borderColor = "#2ecc71";
        return true;
    }
    else {
        field.style.borderColor = "#c0392b";
        return false;
    }
}

var name_regex = /^[a-zA-Z]{1,30}$/;

function FirstNameCheck() {
    var field = document.getElementsByName("firstName")[0];
    var result = name_regex.exec(field.value);

    if (result != null) {
        field.style.borderColor = "#2ecc71";
        return true;
    }
    else {
        field.style.borderColor = "#c0392b";
        return false;
    }
}

function LastNameCheck() {
    var field = document.getElementsByName("lastName")[0];
    var result = name_regex.exec(field.value);

    if (result != null) {
        field.style.borderColor = "#2ecc71";
        return true;
    }
    else {
        field.style.borderColor = "#c0392b";
        return false;
    }
}


const emailReg = /^[A-Za-z0-9]+@([A-Za-z0-9]+\.)+[A-Za-z0-9]+$/m;

function EmailCheck() {
    var field = document.getElementsByName("email")[0];
    var result = emailReg.exec(field.value);

    if (result != null) {
        field.style.borderColor = "#2ecc71";
        return true;
    }
    else {
        field.style.borderColor = "#c0392b";
        return false;
    }
}


const pwreg1 = /[A-Z]/m;
const pwreg2 = /[a-z]/m;
const pwreg3 = /[0-9]/m;
const pwreg4 = /[~`!#$%\^&*+=\[\]\\';,\/{}|\:<>\?]/m;
const pwreg5 = /^.{8,96}$/m;

function PasswordCheck() {
    var field = document.getElementsByName("password")[0];
    if (pwreg5.exec(field.value) != null) {
        if (pwreg1.exec(field.value) != null) {
            if (pwreg2.exec(field.value) != null) {
                if (pwreg3.exec(field.value) != null) {
                    if (pwreg4.exec(field.value) != null) {
                        field.style.borderColor = "#2ecc71";
                        return true;
                    }
                }
            }
        }
    }
    field.style.borderColor = "#c0392b"; 
    return false;
}


function PasswordRepeatCheck() {
    var field1 = document.getElementsByName("password")[0];
    var field2 = document.getElementsByName("password2")[0];
    if (field1.value != field2.value) {
        field2.style.borderColor = "#c0392b";
        return false; 
    }
    else {
        field2.style.borderColor = "#2ecc71";
        return true;
    }
}

function RegisterButtonLock() {
    var btn = document.getElementById("formsubmit");

    if(UserNameCheck() && FirstNameCheck() && LastNameCheck() && PasswordCheck() && PasswordRepeatCheck() && EmailCheck())
    {
        if(btn.classList.contains("buttondisabled"))
            btn.classList.remove("buttondisabled");
        
        btn.disabled = false;
    }
    else
    {
        if(!btn.classList.contains("buttondisabled"))
            btn.classList.add("buttondisabled");

        btn.disabled = true;
    }
}
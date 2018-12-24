$(document).ready(function() {
    $('#submit').click(function(e) {
    // Initializing Variables With Form Element Values
    var firstName = $('#firstName').val();
    var lastName = $('#lastName').val(); 
    var username = $('#username').val();
    var email = $('#email').val();
    // Initializing Variables With Regular Expressions
    var name_regex = /^[a-zA-Z]+$/;
    var email_regex = /^[w-.+]+@[a-zA-Z0-9.-]+.[a-zA-z0-9]{2,4}$/;
    
    if (firstName.length == 0) {
    $('#p3').text("* All fields are mandatory *"); // This Segment Displays The Validation Rule For All Fields
    $("#firstName").focus();
    return false;
    }
    // Validating Name Field.
    else if (!firstName.match(name_regex) || firstName.length == 0) {
    $('#p3').text("* For your name please use alphabets only *"); // This Segment Displays The Validation Rule For Name
    $("#firstName").focus();
    return false;
    }

    if (lastName.length == 0) {
        $('#p3').text("* All fields are mandatory *"); // This Segment Displays The Validation Rule For All Fields
        $("#lastName").focus();
        return false;
        }
        // Validating Name Field.
        else if (!lastname.match(name_regex) || firstname.length == 0) {
        $('#p3').text("* For your name please use alphabets only *"); // This Segment Displays The Validation Rule For Name
        $("#lastName").focus();
        return false;
        }

    // Validating Username Field.
    else if (!(username.length >= 6 && username.length <= 8) || username.length == 0) {
    $('#p3').text("* Please enter between 6 and 8 characters *"); // This Segment Displays The Validation Rule For Username
    $("#username").focus();
    return false;
    }
    // Validating Email Field.
    else if (!email.match(email_regex) || email.length == 0) {
    $('#p3').text("* Please enter a valid email address *"); // This Segment Displays The Validation Rule For Email
    $("#email").focus();
    return false;
    }

    });
    });
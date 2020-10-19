//contact-us.php Message Us Form Validation
function validateForm() {

    var Email = document.forms["myForm"]["InputEmail"].value;
    var name = document.forms["myForm"]["InputName"].value;
    var comment = document.forms["myForm"]["comment"].value;
    if (name === null || name === "") {

        alert("Name must be filled out");
        return false;
    }
    if (comment === null || comment === "") {
        alert("Please type your feedback.");
        return false;
    }
    if (Email === null || Email === "") {
        alert("Email must be filled out");
        return false;
    }
    if (/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(Email))
    {
        return (true);
    }
    alert("You have entered an invalid email address! It should be in xyz@gmail.com");
    return (false);
}
//register.php Sign Up Form Validation
function validateFormRegister() {
    var Fname = document.forms["myForm"]["register_Fname"].value;
    var Lname = document.forms["myForm"]["register_Lname"].value;
    var Email = document.forms["myForm"]["email"].value;
    var password = document.forms["myForm"]["register_password"].value;
    var repassword = document.forms["myForm"]["register_repassword"].value;
    var answer = document.forms["myForm"]["answer"].value;
    var terms = document.forms["myForm"]["checkTerms"].checked;
    
    if (Fname == null || Fname == "") {
        alert("First Name must be filled out");
        return false;
    }

    else if (Lname == null || Lname == "") {
        alert("Last Name must be filled out");
        return false;
    }
    else if (Email == null || Email == "") {
        alert("Email must be filled out");
        return false;
    }
    else if (password == null || password == "") {
        alert("Password must be filled out");
        return false;
    }
    else if (repassword == null || repassword == "") {
        alert("Confirm Password must be filled out");
        return false;
    }
    else if (!terms)
    {
        alert('You must agree to the terms first.');
        return false;
    }
    else if (answer == null || answer == "") {
        alert("Answer must be filled out");
        return false;
    }
    else if (password != repassword) {
        alert("Password does not match");
        return false;
    }
    else if (!(/^[a-zA-Z-,](\s{0,1}[a-zA-Z-, ])*$/.test(Fname))) {
        alert("First Name: No special characters and numbers.");
        return false;
    }
    else if (!(/^[a-zA-Z-,](\s{0,1}[a-zA-Z-, ])*$/.test(Lname))) {
        alert("First Name: No special characters and numbers.");
        return false;
    }
    else if (!(/(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}/.test(password))) {
        alert("Password must be at least 8 characters and must contain at least one lower case letter, one upper case letter and one digit");
        return false;
    }

    else if (!(/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(Email)))
    {
        alert("You have entered an invalid email address! It should be in xyz@gmail.com");
        return false;
    }
return true;
}

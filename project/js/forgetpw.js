/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

function validateForgetpw() {

    var Email = document.forms["ForgetPw"]["email"].value;;
    var Answer = document.forms["ForgetPw"]["Answer"].value;
    
    if (Email === null || Email === "") {
        alert("Email must be filled out");
        return false;
    }
    
    if (!(/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(Email)))
    {
        alert("You have entered an invalid email address! It should be in xyz@gmail.com");
        return false;
    }
    else {
        return true;
    }

    if (Answer === null || Answer === "") {
        alert("Answer must be filled out");
        return false;
    }
    
}

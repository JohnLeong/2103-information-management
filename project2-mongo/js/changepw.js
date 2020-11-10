/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

function changepw() {
    var password = document.forms["newpw"]["password"].value;
    var cfmpassword = document.forms["newpw"]["cfmpassword"].value;
    
    
    if (password == null || password == "") {
        alert("Password must be filled out");
        return false;
    }
    else if (cfmpassword == null || cfmpassword == "") {
        alert("Confirm Password must be filled out");
        return false;
    }
    else if (!(/(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}/.test(password))) {
        alert("Password must be at least 8 characters and must contain at least one lower case letter, one upper case letter and one digit");
        return false;
    }
}

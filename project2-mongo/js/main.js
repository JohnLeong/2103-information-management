/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

function validateLogin() {
  var email = document.forms["myLogin"]["email"].value;
  if (email == "") {
    alert("Email must be filled out");
    return false;
  }
  else {
    var reg = /[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}/;
    if (reg.test(email) == false) {
        alert("Email is in the wrong format!");
        return false;
        }
    }

  var Password = document.forms["myLogin"]["password"].value;
  if (Password == "") {
    alert("Please Enter a password");
    return false;
  }
}

function newpw() {
    var Password = document.forms["newpw"]["password"].value;
    alert(Password);
    
  if (Password == "") {
    alert("Please Enter a password");
    return false;
  }
  var ConfirmPassword = document.forms["newpw"]["cfmpassword"].value;
    if (ConfirmPassword == "") {
        alert("Please confirm your password!");
        return false;
    }
    else {
        if (ConfirmPassword != Password) {
            alert("Password does not match");
            return false;
        }
    }
}

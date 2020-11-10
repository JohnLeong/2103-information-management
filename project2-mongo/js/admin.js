// Initialize tooltip component
$(function () {
    $('[data-toggle="tooltip"]').tooltip()
})

// Initialize popover component
$(function () {
    $('[data-toggle="popover"]').popover()
})

//Login
// Get the modal
var modal = document.getElementById('adminLogin');
window.onclick = function (event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}

//Validate numbers only in textbox
function isNumber(evt) {
    var iKeyCode = (evt.which) ? evt.which : evt.keyCode
    if (iKeyCode != 46 && iKeyCode > 31 && (iKeyCode < 48 || iKeyCode > 57))
        return false;

    return true;
}

//Search table
function tableFunction() {
    var input, filter, table, tr, td, i, txtValue;
    input = document.getElementById("searchInput");
    filter = input.value.toUpperCase();
    table = document.getElementById("s");
    tr = table.getElementsByTagName("tr");
    for (i = 0; i < tr.length; i++) {
        td = tr[i].getElementsByTagName("td")[1];
        if (td) {
            txtValue = td.textContent || td.innerText;
            if (txtValue.toUpperCase().indexOf(filter) > -1) {
                tr[i].style.display = "";
            } else {
                tr[i].style.display = "none";
            }
        }
    }
}

//Change password
var myInput = document.getElementById("newPassword");
var letter = document.getElementById("letter");
var capital = document.getElementById("capital");
var number = document.getElementById("number");
var length = document.getElementById("length");

// When the user clicks on the password field, show the message box
myInput.onfocus = function () {
    document.getElementById("message").style.display = "block";
}

// When the user clicks outside of the password field, hide the message box
myInput.onblur = function () {
    document.getElementById("message").style.display = "none";
}

// When the user starts to type something inside the password field
myInput.onkeyup = function () {
    // Validate lowercase letters
    var lowerCaseLetters = /[a-z]/g;
    if (myInput.value.match(lowerCaseLetters)) {
        letter.classList.remove("invalid");
        letter.classList.add("valid");
    } else {
        letter.classList.remove("valid");
        letter.classList.add("invalid");
    }

    // Validate capital letters
    var upperCaseLetters = /[A-Z]/g;
    if (myInput.value.match(upperCaseLetters)) {
        capital.classList.remove("invalid");
        capital.classList.add("valid");
    } else {
        capital.classList.remove("valid");
        capital.classList.add("invalid");
    }

    // Validate numbers
    var numbers = /[0-9]/g;
    if (myInput.value.match(numbers)) {
        number.classList.remove("invalid");
        number.classList.add("valid");
    } else {
        number.classList.remove("valid");
        number.classList.add("invalid");
    }

    // Validate length
    if (myInput.value.length >= 8) {
        length.classList.remove("invalid");
        length.classList.add("valid");
    } else {
        length.classList.remove("valid");
        length.classList.add("invalid");
    }
}

// Form validation
function validateForm() {
 
    var regName = /^[a-zA-Z]+$/;
    var firstname = document.forms["createAccountForm"]["fname"].value;
    if(firstname == ""){
    alert("First Name must be filled in");
    return false;
    }
    else if(!regName.test(firstname)){
        alert('Please enter a valid first name');
        return false;
    }
        
    var lastname = document.forms["createAccountForm"]["lname"].value;
    if (lastname == "") {
        alert("Last Name must be filled in");
        return false;
    }
        
    var email = document.forms["createAccountForm"]["email"].value;
    if (email == "") {
      alert("Email must be filled in");
      return false;
    }
    
    var newPassword = document.forms["createAccountForm"]["newPassword"].value;
    if (newPassword == "") {
      alert("New Password must be filled in");
      return false;
    }

    var confirmPassword = document.forms["createAccountForm"]["confirmPassword"].value;
    if (confirmPassword == "") {
      alert("Confirm Password must be filled in");
      return false;
    }
    
    if(newPassword != confirmPassword)
    {
        alert("Password is incorrect");
        return false;
    }
}

function validateAccountForm() {
 
    var regName = /^[a-zA-Z]+$/;
    var firstname = document.forms["accountProfileForm"]["fname"].value;
    if(firstname === ""){
    alert("First Name must be filled in");
    return false;
    }
    else if(!regName.test(firstname)){
        alert('Please enter a valid first name');
        return false;
    }
        
    var lastname = document.forms["accountProfileForm"]["lname"].value;
    if (lastname == "") {
        alert("Last Name must be filled in");
        return false;
    }
}

function validateChangePasswordForm() {

    var currentPassword = document.forms["changePasswordForm"]["currentPassword"].value;
    if (currentPassword == "") {
      alert("Current Password must be filled in");
      return false;
    }
    
    var newPassword = document.forms["changePasswordForm"]["newPassword"].value;
    if (newPassword == "") {
      alert("New Password must be filled in");
      return false;
    }

    var confirmPassword = document.forms["changePasswordForm"]["confirmPassword"].value;
    if (confirmPassword == "") {
      alert("Confirm Password must be filled in");
      return false;
    }
    
    if(newPassword != confirmPassword)
    {
        alert("Password is incorrect");
        return false;
    }


}


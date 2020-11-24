<?php
// Constants for accessing our DB:
require '../vendor/autoload.php';
require_once('../../protected/configmdb.php');

$collection = $mongo->alfredng_db->users;


//Helper function that checks input for malicious or unwanted content.
function sanitize_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

// Email
if (empty($_POST["email"])) {
    $errorMsg .= "Email is required.<br>";
    $success = false;
} else {
    $email = sanitize_input($_POST["email"]);
    // Additional check to make sure e-mail address is well-formed.
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errorMsg .= "Invalid email format.";
        $success = false;
    }
}

// Password 
if (empty($_POST["password"])) {
    $errorMsg .= "Password is required.";
    $success = false;
} else {
    $password = $_POST["password"];
}

// **(remaining code from process_login.php was removed from here)**
// Create connection
    $result = $collection->findOne(array("email" => $email)); 
    if ($result != "") {
        $encryptpassword = $result["password_hash"];
        
        if (password_verify($password, $encryptpassword)) {//successful login
            session_start();
            
            $_SESSION['email'] = $result['email'];
            header('Location: admin_centre.php');
            exit();
        } else {
            pop_up_alert("Login failed. Email and Password does not match.");
        }
    } else {
        pop_up_alert("Account does not exist.");
    }
//}

function pop_up_alert($message) {
//    header("Refresh:0; url=admin_login.php");
    echo "<script>alert('$message');</script>";
}

?>
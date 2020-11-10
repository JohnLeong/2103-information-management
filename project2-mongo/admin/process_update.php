<?php

session_start();

// Constants for accessing our DB:
define("DBHOST", "161.117.122.252");
define("DBNAME", "p2_5");
define("DBUSER", "p2_5");
define("DBPASS", "rBs4CTxkDU");
$email = $fname = $lname = $mobileNumber = $errorMsg = "";

$success = true;

//first name
if (empty($_POST["fname"])) {
    $errorMsg .= "First Name is required.<br>";
    $success = false;
} else {
    $fname = sanitize_input($_POST["fname"]);
    if (!preg_match("/^[a-zA-Z'-]+$/", $fname)) {
        $errorMsg .= "Invalid First Name. It must not contain numbers or special characters.";
        $success = false;
    }
}

//Mobile Number
if (empty($_POST["mobileNumber"])) {
    $errorMsg .= "Mobile Number is required.";
    $success = false;
} else {
    $mobileNumber = sanitize_input($_POST["mobileNumber"]);
    if (!preg_match('/^[0-9]{8}+$/', $mobileNumber)) {
        $errorMsg .= "Mobile Number is not valid. Please enter only 8 digits.";
        $success = false;
    }
}

if ($success) {
    updateProfile();
    echo '<script type="text/javascript">';
    echo 'alert("Update Successful");';
    echo 'window.location.href = "admin_account.php";';
    echo '</script>';
} else {
    echo '<script type="text/javascript">';
    echo "alert(\"$errorMsg\");\n";
    echo 'window.location.href = "admin_account.php";';
    echo '</script>';
}

//Helper function that checks input for malicious or unwanted content.
function sanitize_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

/*
 * Helper function to write the data to the DB
 */

function updateProfile() {
    global $fname, $lname, $email, $mobileNumber, $errorMsg, $success;
    // Create connection
    $conn = new mysqli(DBHOST, DBUSER, DBPASS, DBNAME);
    // Check connection
    if ($conn->connect_error) {
        $errorMsg = "Connection failed: " . $conn->connect_error;
        $success = false;
    } else {
        $email = $_POST["email"];
        $fname = $_POST["fname"];
        $lname = $_POST["lname"];
        $mobileNumber = $_POST["mobileNumber"];
        $sql = "UPDATE p2_5.admin_table SET fname = '$fname', lname = '$lname', mobileNumber = '$mobileNumber'";
        $sql .= " WHERE email = '$email' ";
        // Execute the query
        if (!$conn->query($sql)) {
            $errorMsg = "Database error: " . $conn->error;
            $success = false;
        }
    }
    $conn->close();
}

?>
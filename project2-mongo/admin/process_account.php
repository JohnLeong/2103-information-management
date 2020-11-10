<!-- MySQL Connection -->
<?php
session_start();

// Constants for accessing our DB:
define("DBHOST", "161.117.122.252");
define("DBNAME", "p2_5");
define("DBUSER", "p2_5");
define("DBPASS", "rBs4CTxkDU");
$fname = $lname = $email = $newPassword = $confirmPassword = $encryptpassword = $mobileNumber = "";
$errorMsg = "";

$success = true;

//email
if (empty($_POST["email"])) {
    $errorMsg .= "Email is required.";
    $success = false;
} else {
    $email = sanitize_input($_POST["email"]);
    // Additional check to make sure e-mail address is well-formed.
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errorMsg .= "Invalid email format.\n";
        $success = false;
    }
}

//first name
if (empty($_POST["fname"])) {
    $errorMsg .= "First Name is required.";
    $success = false;
} else {
    $fname = sanitize_input($_POST["fname"]);
    if (!preg_match("/^[a-zA-Z'-]+$/", $fname)) {
        $errorMsg .= "First Name is not valid. It must not contain numbers or special characters.\n";
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
        $errorMsg .= "Mobile Number is not valid. \n";
        $success = false;
    }
}

//password & confirm pwd
if (empty($_POST["newPassword"])) {
    $errorMsg .= "Password is required.<br>";
    $success = false;
} elseif (!($_POST["newPassword"] == $_POST["confirmPassword"])) {
    $errorMsg .= "Password does not match.\n";
    $success = false;
} else {
    $newPassword = $_POST["newPassword"];
    $confirmPassword = $_POST["confirmPassword"];
}

//Hash Password
$encryptpassword = password_hash($newPassword, PASSWORD_BCRYPT);

//Helper function that checks input for malicious or unwanted content.
function sanitize_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

if ($success) {
    $fname = sanitize_input($_POST["fname"]);
    $lname = sanitize_input($_POST["lname"]);
    $email = sanitize_input($_POST["email"]);
    $mobileNumber = sanitize_input($_POST["mobileNumber"]);
    saveMemberToDB();
    pop_up_alert("Account created successfully");
} else {
    pop_up_alert("Account creation failed.");
}

/*
 * Helper function to write the data to the DB
 */

function saveMemberToDB() {
    global $fname, $lname, $email, $mobileNumber, $encryptpassword, $errorMsg, $success;
    // Create connection
    $conn = new mysqli(DBHOST, DBUSER, DBPASS, DBNAME);
    // Check connection
    if ($conn->connect_error) {
        $errorMsg = "Connection failed: " . $conn->connect_error;
        $success = false;
    } else {
        $sql = "INSERT INTO admin_table (fname, lname, email, mobileNumber, password)";
        $sql .= " VALUES ('$fname', '$lname', '$email', '$mobileNumber', '$encryptpassword')";
        // Execute the query
        if (!$conn->query($sql)) {
            $errorMsg = "Database error: " . $conn->error;
            $success = false;
        }
    }
    $conn->close();
}

function pop_up_alert($message) {
    header("Refresh:0; url=admin_account.php");
    echo "<script>alert('$message');</script>";
}
?>
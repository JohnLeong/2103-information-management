<?php

session_start();

// Constants for accessing our DB:
define("DBHOST", "161.117.122.252");
define("DBNAME", "p2_5");
define("DBUSER", "p2_5");
define("DBPASS", "rBs4CTxkDU");
$email = $currentPassword = $newPassword = $confirmPassword = $encryptpassword = $errorMsg = "";
$success = true;

//Password
if (empty($_POST["currentPassword"])) {
    $errorMsg .= "Current Password is required.";
    $success = false;
} elseif (empty($_POST["newPassword"])) {
    $errorMsg .= "New Password is required.";
    $success = false;
} elseif (empty($_POST["confirmPassword"])) {
    $errorMsg .= "Confirm Password is required.";
    $success = false;
} elseif (!($_POST["newPassword"] == $_POST["confirmPassword"])) {
    $errorMsg .= "Password does not match.";
    $success = false;
} else {
    $currentPassword = sanitize_input($_POST["currentPassword"]);
    $newPassword = sanitize_input($_POST["newPassword"]);
    $confirmPassword = sanitize_input($_POST["confirmPassword"]);
}

//Hash Password
$encryptpassword = password_hash($newPassword, PASSWORD_BCRYPT);

if ($success) {
    updatePassword();
    echo '<script type="text/javascript">';
    echo 'alert("Password Changed Successfully");';
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

function updatePassword() {
    global $email, $encryptpassword, $errorMsg, $success;
    // Create connection
    $conn = new mysqli(DBHOST, DBUSER, DBPASS, DBNAME);
    // Check connection
    if ($conn->connect_error) {
        $errorMsg = "Connection failed: " . $conn->connect_error;
        $success = false;
    } else {
        $email = $_SESSION['email'];
        $sql = "UPDATE p2_5.admin_table SET password = '$encryptpassword'";
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
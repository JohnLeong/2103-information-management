<?php
// Constants for accessing our DB:
require_once('../../protected/config.php');
$conn = new mysqli(DBHOST, DBUSER, DBPASS, DBNAME);
if ($conn->connect_error) {
    $errorMsg = "Connection failed: " . $conn->connect_error;
    $success = false;
}
$success = true;

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
//$conn = new mysqli(DBHOST, DBUSER, DBPASS, DBNAME);

// Check connection
if ($conn->connect_error) {
    $errorMsg = "Connection failed: " . $conn->connect_error;
    $success = false;
} else {
    $sql = "SELECT * FROM users WHERE ";
    $sql .= "email='$email'"; // AND password='$password'";
    // Execute the query
    $result = $conn->query($sql);
    //$conn->close(); don't close yet, still need retrieve reservations and stuff
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        (isset($result)) ? $result->free_result() : "";
        $encryptpassword = $row["password_hash"];
        //unset($row);
        if (password_verify($password, $encryptpassword)) {//successful login
            session_start();
//            $_SESSION['email'] = true;
//            $_SESSION['lname'] = $row['lname'];
            $_SESSION['email'] = $row['email'];
//            $_SESSION['mobileNumber'] = $row['mobileNumber'];
//            $_SESSION['lastLogin'] = $row['lastLogin'];
//            $_SESSION['admin_id'] = $row['admin_id'];
//
//            $sql = "SELECT COUNT(reservation_id) FROM p2_5.customer_reservation"; //count number of reservations
//            $result = $conn->query($sql);
//            $row = $result->fetch_assoc();
//
//            $_SESSION['reservations'] = $row['COUNT(reservation_id)'];
//
//
//            $sql = "SELECT COUNT(order_id) FROM p2_5.customer_order"; //count number of reservations
//            $result = $conn->query($sql);
//            $row = $result->fetch_assoc();
//
//            $_SESSION['orders'] = $row['COUNT(order_id)'];
//            $_SESSION['total'] = $_SESSION['reservations'] + $_SESSION['orders'];
//
//            $sql = "SELECT MAX(reservationDate) FROM  p2_5.customer_reservation";
//            $result = $conn->query($sql);
//            $row = $result->fetch_assoc();
//
//            $_SESSION['upcomingReservation'] = $row['MAX(reservationDate)'];

            /* Need to find upcoming order date but order date not in database
             * 
              $sql = "SELECT MAX(orderDate) FROM  p2_5.customer_order";
              $result = $conn->query($sql);
              $row = $result->fetch_assoc();


              $_SESSION['upcomingOrder'] = $row['MAX(orderDate)'];
             */

            $conn->close();

            header('Location: admin_centre.php');
            exit();
        } else {
            pop_up_alert("Login failed. Email and Password does not match.");
        }
    } else {
        pop_up_alert("Account does not exist.");
    }
}

function pop_up_alert($message) {
    header("Refresh:0; url=admin_login.php");
    echo "<script>alert('$message');</script>";
}

?>
<?php

// Constants for accessing our DB:
define("DBHOST", "161.117.122.252");
define("DBNAME", "p2_5");
define("DBUSER", "p2_5");
define("DBPASS", "rBs4CTxkDU");

//Admin_Reservation
$reservationID = $name = $mobileNumber = $reservationDate = $reservationTime = $reservationPax = $reservationRequest = $errorMsg = "";
$success = true;

//Sanitize inputs
$reservationID = sanitize_input($_POST["reservationID"]);
$name = sanitize_input($_POST["name"]);
$mobileNumber = sanitize_input($_POST["mobileNumber"]);
$reservationRequest = sanitize_input($_POST["reservationRequest"]);

//Reservation Date
if (empty($_POST["reservationDate"])) {
    $errorMsg .= "Reservation Date is required.";
    $success = false;
} else {
    $reservationDate = sanitize_input($_POST["reservationDate"]);
}

//Reservation Time
if (empty($_POST["reservationTime"])) {
    $errorMsg .= "Reservation Time is required.";
    $success = false;
} else {
    $reservationTime = sanitize_input($_POST["reservationTime"]);
}

//Reservation Pax
if (empty($_POST["reservationPax"])) {
    $errorMsg .= "Reservation Pax is required.";
    $success = false;
} else {
    $reservationPax = sanitize_input($_POST["reservationPax"]);
    if (!is_numeric($reservationPax)) {
        $errorMsg .= "Reservation Pax is invalid. Please enter only 8 digits.";
        $success = false;
    }
}

//Helper function that checks input for malicious or unwanted content.
function sanitize_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

if ($success) {
    updateReservation();
    echo '<script>';
    echo 'alert("Data has been updated successfully.");';
    echo 'window.location.href = "admin_reservation.php";';
    echo '</script>';
} else {
    echo '<script>';
    echo 'alert("Data update failed. Please try again.");';
    echo 'window.location.href = "admin_reservation.php";';
    echo '</script>';
}

function updateReservation() {

    if (isset($_POST['updatebutton'])) {
        $reservationID = $_POST['reservationID'];

        $name = $_POST['name'];
        $mobileNumber = $_POST['mobileNumber'];
        $reservationDate = $_POST['reservationDate'];
        $reservationTime = $_POST['reservationTime'];
        $reservationPax = $_POST['reservationPax'];
        $reservationRequest = $_POST['reservationRequest'];

        $conn = new mysqli(DBHOST, DBUSER, DBPASS, DBNAME);
        if ($conn->connect_error) {
            $errorMsg = "Connection failed: " . $conn->connect_error;
            $success = false;
        } else {
            $sql = "UPDATE customer_reservation SET reservationTime = '$reservationTime', reservationPax = '$reservationPax' WHERE reservation_id = '$reservationID'";
            if (!$conn->query($sql)) {
                $errorMsg = "Database error: " . $conn->error;
                $success = false;
            }
        }
    }

    $conn->close();
}

?>
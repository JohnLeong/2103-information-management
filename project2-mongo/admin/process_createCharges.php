<?php
require_once('../../protected/config.php');

//Admin_Catering
$centreCode = $class_Lic = $icharges = $amount = $frequency = "";

$success = true;

//Sanitize inputs centreName
$centreCode = sanitize_input($_POST["centreCode"]);
$centreName = sanitize_input($_POST["centreName"]);
$icharges = sanitize_input($_POST["Icharges"]);
(float)$amount = sanitize_input($_POST["Amount"]);
$frequency = sanitize_input($_POST["Frequency"]);

//Helper function that checks input for malicious or unwanted content.
function sanitize_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

if ($success) {
    addCharge();
    header("location: admin_centreServicesDt.php");
    echo '<script>alert("Data has been updated successfully."); </script>';
} else {
    echo '<script>alert("Data update failed. Please try again."); </script>';
}

function addCharge() {

    if (isset($_POST['updatebutton'])) {
        $centreCode = sanitize_input($_POST["centreCode"]);
        $centreName = sanitize_input($_POST["centreName"]);
        $icharges = sanitize_input($_POST["Icharges"]);
        (float)$amount = sanitize_input($_POST["Amount"]);
        $frequency = sanitize_input($_POST["Frequency"]);
        
        $conn = new mysqli(DBHOST, DBUSER, DBPASS, DBNAME);
        if ($conn->connect_error) {
            $errorMsg = "Connection failed: " . $conn->connect_error;
            $success = false;
        } else {
            $sql = "INSERT INTO incidental_charge (centre_code, centre_name, incidental_charges, frequency, amount)"
                    . "VALUES ('$centreCode', '$centreName', '$icharges', '$frequency', $amount);";
            
            if (!$conn->query($sql)) {
                $errorMsg = "Database error: " . $conn->error;
                $success = false;
            }
        }
    }

    $conn->close();
}
?>
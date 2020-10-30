<?php
require_once('../../protected/config.php');

//Admin_Catering
$centreCode = $class_Lic = $sCategory = "";

$success = true;

//Sanitize inputs centreName
$centreCode = sanitize_input($_POST["centreCode"]);
$centreName = sanitize_input($_POST["centreName"]);
$sCategory = sanitize_input($_POST["sCategory"]);

//Helper function that checks input for malicious or unwanted content.
function sanitize_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

if ($success) {
    addSubsidy();
    header("location: admin_centreServicesDt.php");
    echo '<script>alert("Data has been updated successfully."); </script>';
} else {
    echo '<script>alert("Data update failed. Please try again."); </script>';
}

function addSubsidy() {

    if (isset($_POST['updatebutton'])) {
        $centreCode = sanitize_input($_POST["centreCode"]);
        $centreName = sanitize_input($_POST["centreName"]);
        $sCategory = sanitize_input($_POST["sCategory"]);
        
        $conn = new mysqli(DBHOST, DBUSER, DBPASS, DBNAME);
        if ($conn->connect_error) {
            $errorMsg = "Connection failed: " . $conn->connect_error;
            $success = false;
        } else {
            $sql = "INSERT INTO centre_subsidies (centre_code, subsidy_category)"
                    . "VALUES ('$centreCode', '$sCategory');";
            
            if (!$conn->query($sql)) {
                $errorMsg = "Database error: " . $conn->error;
                $success = false;
            }
        }
    }

    $conn->close();
}
?>
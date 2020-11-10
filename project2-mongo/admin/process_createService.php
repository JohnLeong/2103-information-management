<?php
require_once('../../protected/config.php');

//Admin_Catering
$centreCode = $class_Lic = $typeService = $centreName = $fees = $lvlOffered = $citizenship = "";

$success = true;

//Sanitize inputs centreName
$centreCode = sanitize_input($_POST["centreCode"]);
$centreName = sanitize_input($_POST["centreName"]);
$class_Lic = sanitize_input($_POST["Class_Lic"]);
$typeService = sanitize_input($_POST["TypeService"]);
(int)$fees = sanitize_input($_POST["Fees"]);
$lvlOffered = sanitize_input($_POST["LvlOffered"]);
$citizenship = sanitize_input($_POST["Citizenship"]);

//Helper function that checks input for malicious or unwanted content.
function sanitize_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

if ($success) {
    addService();
    header("location: admin_centreServicesDt.php");
    echo '<script>alert("Data has been updated successfully."); </script>';
} else {
    echo '<script>alert("Data update failed. Please try again."); </script>';
}

function addService() {

    if (isset($_POST['updatebutton'])) {
        $centreCode = sanitize_input($_POST["centreCode"]);
        $centreName = sanitize_input($_POST["centreName"]);
        $class_Lic = sanitize_input($_POST["Class_Lic"]);
        $typeService = sanitize_input($_POST["TypeService"]);
        (int)$fees = sanitize_input($_POST["Fees"]);
        $lvlOffered = sanitize_input($_POST["LvlOffered"]);
        $citizenship = sanitize_input($_POST["Citizenship"]);
        $date = date('Y-m-d');
        
        $conn = new mysqli(DBHOST, DBUSER, DBPASS, DBNAME);
        if ($conn->connect_error) {
            $errorMsg = "Connection failed: " . $conn->connect_error;
            $success = false;
        } else {
            $sql = "INSERT INTO centre_service (centre_code, centre_name, class_of_licence, type_of_service, levels_offered, fees,type_of_citizenship,last_updated)"
                    . "VALUES ('$centreCode', '$centreName', '$class_Lic', '$typeService', '$lvlOffered', $fees, '$citizenship', '$date');";
            
            if (!$conn->query($sql)) {
                $errorMsg = "Database error: " . $conn->error;
                $success = false;
            }
        }
    }

    $conn->close();
}
?>
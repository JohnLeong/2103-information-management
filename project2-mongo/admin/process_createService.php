<?php
use MongoDB\BSON\Regex;
require '../vendor/autoload.php';
require_once('../../protected/configmdb.php');

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
    if (isset($_POST['updatebutton'])) {
        $collection = $mongo->alfredng_db->centre;
        $insertOneResult  = $collection->updateOne([ 'centre_code' => $centreCode], 
                (array('$push' => array("centre_service" => 
                    array("class_of_licence" => $class_Lic, "type_of_service" => $typeService, 
                    "levels_offered" => $lvlOffered, "fees" => $fees, 
                    "type_of_citizenship" => $citizenship)))));
    }
    header("location: admin_centreServicesDt.php");
    echo '<script>alert("Data has been updated successfully."); </script>';
} else {
    echo '<script>alert("Data update failed. Please try again."); </script>';
}


?>
<?php
use MongoDB\BSON\Regex;
require '../vendor/autoload.php';
require_once('../../protected/configmdb.php');

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
    if (isset($_POST['updatebutton'])) {
        $collection = $mongo->alfredng_db->centre;
        $insertOneResult  = $collection->updateOne([ 'centre_code' => $centreCode], 
                (array('$push' => array("incidental_charges" => 
                    array("incidental_charges" => $icharges, "frequency" => $frequency, 
                    "amount" => $amount)))));     
    }
    header("location: admin_centreServicesDt.php");
    echo '<script>alert("Data has been updated successfully."); </script>';
} else {
    echo '<script>alert("Data update failed. Please try again."); </script>';
}


?>
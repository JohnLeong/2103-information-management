<?php

$email_message = $InputEmail = $InputName = $comment = $errorEmailMsg = $errorNameMsg = $errorCommentMsg = $submit = "";
$success = true;

// check that the fields are not empty and required validation
if (empty($_POST["InputEmail"])) {
    $errorEmailMsg = "Email is required.<br>";
    $success = false;
} else {
    $InputEmail = sanitize_input($_POST["InputEmail"]);
    // Additional check to make sure e-mail address is well-formed.     
    if (!filter_var($InputEmail, FILTER_VALIDATE_EMAIL)) {
        $errorEmailMsg = "Invalid email format<br>";
        $success = false;
    }
}
if (empty($_POST["comment"])) {
    $errorCommentMsg = "Commment is required.<br>";
    $success = false;
} else {
    $comment = sanitize_input($_POST["comment"]);
}
if (empty($_POST["InputName"])) {
    $errorNameMsg = "Name is required.<br>";
    $success = false;
} else {
    $InputName = sanitize_input($_POST["InputName"]);
    if (preg_match("/[^a-zA-Z -]/", $InputName)) {
        $errorNameMsg .= "Name: No special cahracters and numbers allowed. <br>";
        $success = false;
     }

}


//all fields are filled and password are correctly matched, show output other errormsg
if ($success) {
    if (isset($_POST['contactSubmit'])) {
// The header row of the CSV.
        $header = "Email,Name,Comment\n";
        // The data of the CSV.
        $data = "$InputEmail,$InputName,$comment\n";
        $filename = "contact-us-feedback.csv";
        if (file_exists($filename)) {
            // Add only data. The header is already added in the existing file.
            file_put_contents($filename, $data, FILE_APPEND);
        } else {
            // Add CSV header and data.
            file_put_contents($filename, $header . $data);
        }
    }
    echo '<script type="text/javascript">alert("Feedback has been submitted!");</script>';
    //re-directed back to contact-us.php
    echo '<script>window.location = "contact-us.php";</script>';
} else {

    echo '<script type="text/javascript">alert("Feedback fail to submitted!");</script>';
    //re-directed back to contact-us.php
    echo '<script>window.location = "contact-us.php";</script>';
}

//Helper function that checks input for malicious or unwanted content. 
function sanitize_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
?>       

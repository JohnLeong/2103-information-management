<head>
    <title>Creole | (Register)</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Creole | Bringing People Together Through Fashion">
    <link href="css/bootstrap.min.css" rel="stylesheet"> 
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script> 
    <script src="js/bootstrap.min.js?v3.4.1"></script> 
    <link href="css/webcss.css" rel="stylesheet"> 
    <script src="js/contactUs.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<?php
require_once('../protected/config.php');
include 'nav.inc.php';

$email = $errorMsg = $sessid = "";
$success = true;
$listoferror = array();

if (empty($_POST["password"])) {
    $errorMsg .= "Password is required.<br>";
    $success = false;
} else {
    $password = sanitize_input($_POST["password"]);
}
if (empty($_POST["cfmpassword"])) {
    $errorMsg .= "Confirm password is required<br>";
    $success = false;
} else {
    $cfmpassword = sanitize_input($_POST["cfmpassword"]);
    if ($cfmpassword != $password) {
        $errorMsg .= "Password does not match<b>";
        $success = false;
    }
}

saveMemberToDB();
?>

<?php if ($success) { ?>
    <section class="sparce-page">
        <header><h1>Your Password Has Been Changed!</h1></header>
        <a href="profile.php" class="btn btn-default" title="Go back to your profile" role="button">Back to profile</a>
    </section>
    <?php
} else {

    echo "<h4>The following input errors were detected:</h4>";
    foreach ($listoferror as $value) {
        echo "<p>" . $value . "</p>";
    }
}

//Helper function that checks input for malicious or unwanted content.
function sanitize_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

function saveMemberToDB() {
    global $Fname, $Lname, $email, $password, $listoferror, $success, $sessid;

    //Create connection
    $conn = new mysqli(DBHOST, DBUSER, DBPASS, DBNAME);

    //Check connection
    if ($conn->connect_error) {
        array_push($listoferror, "Connection failed: " . $conn->connect_error);
        $success = false;
    } else {
        $password = hash('sha512', $password);
        $sessid = $_SESSION['email'];
        $sql = "UPDATE users_information SET password='$password' WHERE email = '$sessid'";
        if (!$conn->query($sql)) {
            array_push($listoferror, "Database error: " . $conn->error);
            $success = false;
        }
    }
    $conn->close();
}
?>
<footer>
    <?php include "footer.inc.php" ?>
</footer>
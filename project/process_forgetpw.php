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

$success = true;
$listoferror = array();

if (empty($_POST["email"])) {
    array_push($listoferror, "Email is required");
    $success = false;
} else {
    $email = sanitize_input($_POST["email"]);

    //Additional check to makre sure e-mail address is well formed.
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        array_push($listoferror, "Invalid email format");
        $success = false;
    }
}

if (isset($_POST['ForgetPw'])) {
    $question = $_POST['ForgetPw'];

    
}


if (empty($_POST["Answer"])) {
    array_push($listoferror, "Your answer is required!");
    $success = false;
} else {
    $Answer = sanitize_input($_POST["Answer"]);
    $Answer = hash('sha512', $Answer);
}

DBstuff();

if ($success) {
    header('Location: changepw.php');
} else {
    if (!isset($_SESSION['email'])) {
        //direct to normal nav bar
    }
}

function sanitize_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

function DBstuff() {
    global $email, $Answer, $question, $listoferror, $success;
    //Create connection
    $conn = new mysqli(DBHOST, DBUSER, DBPASS, DBNAME);

    //Check connection
    if ($conn->connect_error) {
        array_push($listoferror, "Connection failed: " . $conn->connect_error);
        $success = false;
    } else {
        $sql = "SELECT * FROM users_information WHERE email = '$email' AND question = '$question' AND answer = '$Answer'";
        //Execute the query
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $success = true;
            $_SESSION['email'] = $row['email'];
        } else {
            echo "<hr>";
                echo "<h1> Your email or security answer is wrong, try again!</h1>";

                echo "<br>";
                echo("<button class='btn-default btn-lg' onclick=\"location.href='forgetpw.php'\">Back</button>");
                echo "<hr>";
            //echo $Answer;
            $success = false;
        }

        $result->free_result();
    }

    $conn->close();
}
?>

<footer>
    <?php include "footer.inc.php" ?>
</footer>
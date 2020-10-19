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

if (empty($_POST["email"]))
{
    array_push($listoferror, "Email is required");
    $success = false;
}
else 
{
    $email = sanitize_input($_POST["email"]);
    
    //Additional check to makre sure e-mail address is well formed.
    if (!filter_var($email, FILTER_VALIDATE_EMAIL))
    {
        array_push($listoferror, "Invalid email format");
        $success = false;
    }
}

if (empty($_POST["password"])) {
    array_push($listoferror, "Password is required");
    $success = false;
}
else {
    $password = sanitize_input($_POST["password"]);
}

DBstuff();

if ($success) {
    header('Location: shop.php');
    }    

else {
    if(!isset($_SESSION['email'])){
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
    global $email, $password, $listoferror, $success;
    //Create connection
    $conn = new mysqli(DBHOST, DBUSER, DBPASS, DBNAME);

    //Check connection
    if ($conn->connect_error) {
        array_push($listoferror, "Connection failed: " . $conn->connect_error);
        $success = false;
    }
    else {
        $sql = "SELECT * FROM users_information WHERE email = '$email'";
        
        //Execute the query
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $password = hash('sha512', $password);
            if ($password == $row["password"]) {
                $success = true;
                $_SESSION['user_id'] = $row['user_id'];
                //for profile page
                $_SESSION['fname'] = $row['fname'];
                $_SESSION['lname'] = $row['lname'];
                $_SESSION['email'] = $row['email'];
                $_SESSION['question'] = $row['question'];
            }
            else {
                echo "<hr>";
                echo "<h1> Your password is wrong!</h1>";

                echo "<br>";
                echo("<button class='btn-default btn-lg' onclick=\"location.href='login.php'\">Back to login</button>");
                echo "<hr>";
                
                $success = false;
            }
        }
        else {
           echo "<hr>";
                echo "<h1> Email does not have an account! Please sign up!</h1>";

                echo "<br>";
                echo("<button class='btn-default btn-lg' onclick=\"location.href='login.php'\">Back to login</button>");
                echo "<hr>";
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
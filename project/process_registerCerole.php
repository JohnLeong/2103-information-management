<?php
require_once('../protected/config.php');

$checkTerms = $register_Fname = $email = $register_Lname = $register_password = $register_repassword = $errorMsg = $answer = $reAnswer = "";
$successForm = true;

// check that the fields are not empty and validation
if (empty($_POST["email"])) {
    $errorMsg .= "Email is required.<br>";
    $successForm = false;
} else {
    $email = sanitize_input($_POST["email"]);
    // Additional check to make sure e-mail address is well-formed.     
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errorMsg .= "Invalid email format.<br>";
        $successForm = false;
    }
}
if (empty($_POST["register_Fname"])) {
    $errorMsg .= "First Name is required.<br>";
    $successForm = false;
} else {
    $register_Fname = sanitize_input($_POST["register_Fname"]);
    if (preg_match("/[^a-zA-Z -]/", $register_Fname)) {
        $errorMsg .= "First Name: No special cahracters and numbers allowed. <br>";
        $successForm = false;
    }
}
if (empty($_POST["register_Lname"])) {
    $errorMsg .= "Last Name is required.<br>";
    $successForm = false;
} else {
    $register_Lname = sanitize_input($_POST["register_Lname"]);
    if (preg_match("/[^a-zA-Z -]/", $register_Lname)) {
        $errorMsg .= "Last Name: No special cahracters and numbers allowed. <br>";
        $successForm = false;
    }
}
if (empty($_POST["register_password"])) {
    $errorMsg .= "Password is required.<br>";
    $successForm = false;
} else {
    $register_password = sanitize_input($_POST["register_password"]);
    if (!preg_match("/(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?!.*\s).{8,}/", $register_password)) {
        $errorMsg .= "Password must be at least 8 characters and must contain at least 8 characters, one lower case letter, one upper case letter and one digit.<br>";
        $successForm = false;
    }
}
if (empty($_POST["register_repassword"])) {
    $errorMsg .= "Confirm password is required.<br>";
    $successForm = false;
} else {
    $register_repassword = sanitize_input($_POST["register_repassword"]);
}
//terms and condition to be checked
if (!isset($_POST["checkTerms"])) {
    $errorMsg .= "Please agree to terms and conditions.<br>";
    $successForm = false;
}
if (empty($_POST["answer"])) {
    $errorMsg .= "Answer is required.<br>";
    $successForm = false;
} else {
    $answer = sanitize_input($_POST["answer"]);
}

// check that password and confirm password matches
if ($register_password != $register_repassword) {
    $errorMsg .= "Password does not match.<br>";
    $successForm = false;
} else {
    $register_password = sanitize_input($_POST["register_password"]);
    $register_repassword = sanitize_input($_POST["register_repassword"]);
}

//Helper function that checks input for malicious or unwanted content. 
function sanitize_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
?>
<!DOCTYPE HTML>
<html lang="en">
    <head>
        <title>Creole | (Register)</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="Creole | Bringing People Together Through Fashion">
        <link href="css/bootstrap.min.css" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Roboto&display=swap" rel="stylesheet">
        <script
            src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js">
        </script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <script src="js/bootstrap.min.js">
        </script>
    </head>
    <body>
        <?php
        include 'nav.inc.php';
        ?>
        <main>
            <div class="container sparce-page">
                <div class="row">
                    <div class="col-md-12">
                        <?php
//alert when input not filled
                        if ($successForm === false) {
                            ?>
                            <h1>Oops!</h1>
                            <h2>The following input errors were detected:</h2>
                            <?php
                            echo "<p>" . $errorMsg . "</p><br>";
                            ?>
                            <a class="btn btn-default" href="register.php" >Back to Sign Up</a>
                            <?php
                        } else {

                            $conn = new mysqli(DBHOST, DBUSER, DBPASS, DBNAME);
                            if ($conn === false) {
                                die("ERROR: Could not connect. " . mysqli_connect_error());
                            } else {
                                //Check if email exists in database 
                                $sqlEmail = "SELECT * FROM users_information WHERE email = '" . $email . "'";
                                $rs = mysqli_query($conn, $sqlEmail);
                                $numEmails = mysqli_num_rows($rs);
                                // if email exists, alert error
                                if ($numEmails > 0) {

                                    echo "<h1>Oops!</h1>";
                                    echo "E-Mail already exists<br>";
                                    echo("<button class='btn btn-default' onclick=\"location.href='register.php'\">Back to Sign Up</button>");
                                } else {
                                    // Escape user inputs for security
                                    $first_name = $_POST['register_Fname'];
                                    $last_name = $_POST['register_Lname'];
                                    $email = $_POST['email'];
                                    $password = $_POST['register_password'];
                                    $password_hashed = hash('sha512', $password);
                                    $repassword = $_POST['register_repassword'];
                                    $answer_hashed = hash('sha512', $answer);
                                    $answer = $_POST['answer'];
                                    $question = $_POST['security_register'];

                                    // Attempt insert query execution
                                    $sql = "INSERT INTO users_information (fname, lname, email,password, question, answer) VALUES ('$first_name', '$last_name', '$email', '$password_hashed', '$question', '$answer_hashed')";
                                    // Save form data to database
                                    if (mysqli_query($conn, $sql)) {

                                        echo "<h1> Your registration is successful!</h1>";
                                        echo "<h2>Thank you for signing up, " . $register_Fname . "</h2>";

                                        echo "<br>";
                                        echo("<button class='btn btn-default' onclick=\"location.href='login.php'\">Login and Shop Now</button>");
                                    } else {
                                        echo "ERROR: Could not able to execute" . mysqli_error($conn);
                                        echo("<button class='btn btn-default' onclick=\"location.href='register.php'\">Registration Fail. Please try again.</button>");
                                    }
                                }
                                // Free result set
                                mysqli_free_result($rs);
                            }
// Close connection 
                            mysqli_close($conn);
                        }
                        ?>
                    </div>
                </div>
            </div>
        </main>
<?php
include 'footer.inc.php';
?>
    </body>

</html>

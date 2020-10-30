<?php
// Start session
session_start();

// Constants for accessing our DB:
define("DBHOST", "161.117.122.252");
define("DBNAME", "p2_5");
define("DBUSER", "p2_5");
define("DBPASS", "rBs4CTxkDU");
$email = $fname = $lname = $mobileNumber = $errorMsg = "";
$success = true;

//Helper function that checks input for malicious or unwanted content.
function sanitize_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

// Create connection
$conn = new mysqli(DBHOST, DBUSER, DBPASS, DBNAME);

// Check connection
if ($conn->connect_error) {
    $errorMsg = "Connection failed: " . $conn->connect_error;
    $success = false;
} else {

    $email = $_SESSION['email'];

    $sql = "SELECT * FROM admin_table WHERE ";
    $sql .= "email = '$email'";
    // Execute the query
    $result = $conn->query($sql);
    $conn->close();
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        (isset($result)) ? $result->free_result() : "";
        $fname = $row["fname"];
        $lname = $row["lname"];
        $email = $row["email"];
        $mobileNumber = $row["mobileNumber"];
        unset($row);
    } else {
        echo "No records.";
    }
}
?>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<head>
    <title>TUMMY FOR YUMMY</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/header_footer.css">
    <link rel="stylesheet" href="../css/main.css">
    <link rel="stylesheet" href="../css/admin_order.css">
    <link rel="stylesheet" href="../css/bootstrap.min.css">

    <link rel="stylesheet" href="assets/fonts/fontawesome/css/font-awesome.min.css">

    <script defer src="../js/admin.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>

</head>

<body>
    <main class="page-container">
        <?php
        include 'adminHeader.inc.php';
        ?>

        <article>
            <section class="container">
                <h1>Admin Account</h1>
                <div class="row">
                    <div class="col-md-3">
                        <ul class="nav nav-pills nav-stacked">
                            <li class="active"><a data-toggle="pill" href="#accountProfile">Account Profile</a></li>
                            <li><a data-toggle="pill" href="#changePassword">Change Password</a></li>
                            <li><a data-toggle="pill" href="#createAccount">Create Adminstrator Account</a></li>
                        </ul>
                    </div>
                    <div id="adminaccount" class="col-md-9 tab-content ">
                        <!-- Account Profile -->
                        <div class="tab-pane fade in active admin_card" id="accountProfile">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <p id="textHeadings">Adminstrator Profile</p>
                                        <hr>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <form name="accountProfileForm" action="process_update.php" onsubmit="return validateAccountForm()" method="post">
                                                    <div class="form-group row">
                                                        <label for="email" class="col-4 col-form-label">Email*</label>
                                                        <div class="col-8">
                                                            <input id="email" name="email" placeholder="Email"
                                                                   class="form-control here" type="text" value="<?php echo $_SESSION['email']; ?>" readonly>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label for="firstname" class="col-4 col-form-label">First Name*</label>
                                                        <div class="col-8">
                                                            <input id="fname" name="fname" placeholder="First Name"
                                                                   class="form-control here" type="text" value="<?php echo $_SESSION['fname']; ?>" pattern="[a-zA-Z]+"
                                                                   title="Invalid First Name. It must not contain numbers or special characters."
                                                                   size="35" aria-label="First Name">
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label for="lastname" class="col-4 col-form-label">Last Name*</label>
                                                        <div class="col-8">
                                                            <input id="lname" name="lname" placeholder="Last Name"
                                                                   class="form-control here" type="text" value="<?php echo $_SESSION['lname']; ?>"" aria-label="Last Name">
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label for="mobileNumber" class="col-4 col-form-label">Mobile
                                                            Number*</label>
                                                        <div class="col-8">
                                                            <input id="mobileNumber" name="mobileNumber"
                                                                   placeholder="Mobile Number" class="form-control here"
                                                                   required="required" type="text"
                                                                   value="<?php echo $mobileNumber; ?>"
                                                                   onkeypress="javascript:return isNumber(event)">
                                                        </div>
                                                    </div>
                                                    <div class="form-group row" style="text-align: center">
                                                        <div class="col-1">
                                                            <button name="submit" type="submit" class="btn">Confirm</button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Change Password -->
                        <div class="admin_card tab-pane fade" id="changePassword">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <p id="textHeadings">Change Password</p>
                                        <hr>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <form name="changePasswordForm" action="process_changePassword.php" onsubmit="return validateChangePasswordForm()" method="post">
                                            <div class="form-group row">
                                                <label for="currentPassword" class="col-4 col-form-label">Current
                                                    Password*</label>
                                                <div class="col-8">
                                                    <input id="currentPassword" name="currentPassword" placeholder="Current Password"
                                                           class="form-control here" type="password" required="required">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="newPassword" class="col-4 col-form-label">New Password*</label>
                                                <div class="col-8">
                                                    <input id="newPassword" name="newPassword" placeholder="New Password"
                                                           class="form-control here" type="password"
                                                           pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}"
                                                           title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters"
                                                           size="35" required="required">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="confirmPassword" class="col-4 col-form-label">Confirm
                                                    Password*</label>
                                                <div class="col-8">
                                                    <input id="confirmPassword" name="confirmPassword"
                                                           placeholder="Confirm Password" class="form-control here"
                                                           type="password" required="required">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <div id="message">
                                                    <p id="textHeadings">Password must contain the following:</p>
                                                    <p id="letter" class="invalid">A <b>lowercase</b> letter</p>
                                                    <p id="capital" class="invalid">A <b>capital (uppercase)</b> letter</p>
                                                    <p id="number" class="invalid">A <b>number</b></p>
                                                    <p id="length" class="invalid">Minimum <b>8 characters</b></p>
                                                </div>
                                            </div>
                                            <div class="form-group row" style="text-align: center">
                                                <div class="col-1">
                                                    <button name="submit" type="submit" class="btn">Confirm</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Create Adminstrator Account -->
                        <div class="admin_card tab-pane fade" id="createAccount">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <p id="textHeadings">Create Adminstrator Account</p>
                                        <hr>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <form name="createAccountForm" action="process_account.php" onsubmit="return validateForm()" method="post">
                                            <div class="form-group row">
                                                <label for="email" class="col-4 col-form-label">Email*</label>
                                                <div class="col-8">
                                                    <input id="email" name="email" placeholder="Email"
                                                           class="form-control here" type="text" required="required">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="fname" class="col-4 col-form-label">First Name*</label>
                                                <div class="col-8">
                                                    <input id="fname" name="fname" placeholder="First Name"
                                                           class="form-control here" type="text" required="required">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="lname" class="col-4 col-form-label">Last Name*</label>
                                                <div class="col-8">
                                                    <input id="lname" name="lname" placeholder="Last Name"
                                                           class="form-control here" type="text" required="required">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="mobileNumber" class="col-4 col-form-label">Mobile
                                                    Number*</label>
                                                <div class="col-8">
                                                    <input id="mobileNumber" name="mobileNumber"
                                                           placeholder="Mobile Number" class="form-control here"
                                                           required="required" type="text"
                                                           onkeypress="javascript:return isNumber(event)">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="newPassword" class="col-4 col-form-label">Password*</label>
                                                <div class="col-8">
                                                    <input id="newPassword" name="newPassword" placeholder="Password"
                                                           class="form-control here" type="password"
                                                           pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}"
                                                           title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters"
                                                           size="35" required="required">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="confirmPassword" class="col-4 col-form-label">Confirm
                                                    Password*</label>
                                                <div class="col-8">
                                                    <input id="confirmPassword" name="confirmPassword"
                                                           placeholder="Confirm Password" class="form-control here"
                                                           type="password" required="required">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <div id="message">
                                                    <p id="textHeadings">Password must contain the following:</p>
                                                    <p id="letter" class="invalid">A <b>lowercase</b> letter</p>
                                                    <p id="capital" class="invalid">A <b>capital (uppercase)</b> letter</p>
                                                    <p id="number" class="invalid">A <b>number</b></p>
                                                    <p id="length" class="invalid">Minimum <b>8 characters</b></p>
                                                </div>
                                            </div>
                                            <div class="form-group row" style="text-align: center">
                                                <div class="col-1">
                                                    <button name="submit" type="submit" class="btn">Confirm</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>

                </div>
            </section>
        </article>

        <?php
        include 'adminFooter.inc.php';
        ?>
    </main>
</body>


</html>
<!DOCTYPE html>

<html lang="en">
    <head>
        <title>Creole | (Register)</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="Creole | Bringing People Together Through Fashion">
        <link href="css/bootstrap.min.css" rel="stylesheet"> 
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script> 
        <script src="js/bootstrap.min.js?v3.4.1"></script> 
        <script src="js/contactUs.js"></script> 
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    </head>
    <body>
        <!-- navigation -->
        <?php
        require_once('../protected/config.php');
        include 'nav.inc.php';
        ?>
        <!-- navigation end -->
        <main>
            <!-- Registration Form  -->
            <div class="container-fluid">
                <div class="row">

                    <div class="col-md-6  col-md-offset-3" id="register_form">
                        <h1 class="text-center" >Registration Form</h1>
                        <form name="myForm" onsubmit="return validateFormRegister()" action="process_registerCerole.php" method="post" > 


                            <div  class="form-group">
                                <label for="register_Fname">First Name</label>
                                <input  type="text" class="form-control" name="register_Fname" pattern="^[A-Za-z -]+$" id="register_Fname"  placeholder="Enter First Name" required > 
                            </div> 

                            <div  class="form-group">

                                <label for="register_Lname">Last Name</label>
                                <input type="text" class="form-control " name="register_Lname" pattern="^[A-Za-z -]+$" id="register_Lname"  placeholder="Enter Last Name" required>
                            </div>

                            <div  class="form-group">

                                <label for="email">Email</label>
                                <input   type="email"
                                         pattern="^[\w]{1,}[\w.+-]{0,}@[\w-]{2,}([.][a-zA-Z]{2,}|[.][\w-]{2,}[.][a-zA-Z]{2,})$"
                                         name="email"  class="form-control" id="email"  placeholder="Eg. xyz@gmail.com" required>

                            </div>
                            <div  class="form-group">

                                <label for="register_password">Enter Password</label>

                                <input  type="password" class="form-control " name="register_password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" id="register_password"  placeholder="Enter Password" required>
                                <p>Password must contains 8 character, 1 upper-case, 1 lower-case and 1 digit.</p>
                            </div>

                            <div  class="form-group">

                                <label for="register_repassword">Confirm Password</label>
                                <input  type="password" class="form-control " name="register_repassword" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" id="register_repassword"  placeholder="Confirm Password" required>

                            </div>

                            <div class="form-group" >
                                <label class="form-radio-label" id="security_register">
                                    Choose a security question
                                </label>
                                <br>
                                <input  aria-labelledby="security_register rd1" type="radio" name="security_register" value="What is your oldest cousin first name?" checked>
                                <label id="rd1">What is your oldest cousin first name?</label>  
                                <br>
                                <input  aria-labelledby="security_register rd2"  type="radio" name="security_register" value="What is your oldest sibling middle name?" >
                                <label id="rd2" >What is your oldest sibling middle name?</label>  
                                <br>
                                <input  type="radio" aria-labelledby="security_register rd3" name="security_register" value="What was your first car model?" >
                                <label  id="rd3" >What was your first car model?</label>
                                <br>
                                <input aria-labelledby="security_register rd4"  type="radio" name="security_register"  value="In what city or town was your first job?" >
                                <label  id="rd4" > In what city or town was your first job?</label>
                            </div>
                            <div  class="form-group">

                                <label for="answer">Answer</label>
                                <input  type="password" class="form-control "  name="answer" id="answer"  placeholder="Enter answer" required>

                            </div>
                            <div class="form-check">
                                <input class="form-check-input " type="checkbox" value="" name="checkTerms" id="checkTerms"  required>
                                <label class="form-check-label" for="checkTerms">
                                    Agree to terms and conditions
                                </label>

                            </div>
                            <button id="registerBtn" type="submit" class="btn btn-success ">Register</button>

                        </form>
                    </div>
                </div>

            </div>
            <!-- Registration Form End  -->
        </main>
        <!-- Footer  -->
        <?php
        include 'footer.inc.php';
        ?>
        <!-- Footer End  -->
    </body>
</html>

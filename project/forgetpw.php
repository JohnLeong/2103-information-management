<!DOCTYPE html>

<html lang="en">
    <head>
        <title>Creole | (Forget Password)</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="Creole | Bringing People Together Through Fashion">
        <meta name="keywords" content="Fasion, Clothes, Dress, Tops, Bottoms">
        <link href="css/bootstrap.min.css" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Roboto&display=swap" rel="stylesheet">
        <script
            src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js">
        </script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <script src="js/bootstrap.min.js">
        </script>
        <link rel="stylesheet" href="css/main.css"/>
        <script src="js/forgetpw.js"></script> 
    </head>

    <body>

        <?php
        require_once('../protected/config.php');
        include 'nav.inc.php';
        ?>
        <main>
            <br>
            <br>
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-offset-2 col-sm-8 text-center  justify-content-center">
                        <h3>Forget your password?</h3><br>
                        <p>Input your email select the security question to recover your password!</p>
                        <form name="ForgetPw" id="ForgetPw" onsubmit="return validateForgetpw()" action="process_forgetpw.php" method="post" >
                            <h3>Enter your email:</h3>
                            <input type="email" class="form-control" name="email" id="email" placeholder="Enter email" required  aria-label="Enter email here" ><br>                
                            <h3>Select the security question tied to your account</h3>
                            <select name="ForgetPw">
                                <option value="What is your oldest cousin first name?" >What is your oldest cousin first name?</option>
                                <option value="What is your oldest sibling middle name?" >What is your oldest sibling middle name?</option>
                                <option value="What was your first car model?" >What was your first car model?</option>
                                <option value="In what city or town was your first job?" >In what city or town was your first job?</option>
                            </select>
                            <br>
                            <br>
                            <br>
                            <h3>Answer:</h3> <input type="text" class="form-control" name="Answer" id="Answer" placeholder="Your Answer" required aria-label="Enter answer area"><br>
                            <button type="submit" class="btn btn-default">Submit</button>
                        </form> 
                    </div>
                </div>
            </div>   
        </main>
        <?php include "footer.inc.php" ?>

    </body>

</html>

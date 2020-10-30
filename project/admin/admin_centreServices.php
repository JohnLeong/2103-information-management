<?php

require_once('../../protected/config.php');
$conn = new mysqli(DBHOST, DBUSER, DBPASS, DBNAME);
if ($conn->connect_error) {
    $errorMsg = "Connection failed: " . $conn->connect_error;
    $success = false;
}
$fullname = $orderid = $email = $date = $time = $price = $errorMsg = "";
$success = true;

//Helper function that checks input for malicious or unwanted content.
function sanitize_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
if (!isset( $_GET['searchvalue'] ) ) {

    //We give the value of the starting row to 0 because nothing was found in URL
    $searchvalue = '';

    //Otherwise we take the value from the URL
} else {
    $searchvalue = $_GET['searchvalue'];
}

if(isset($_SESSION['email'])) {
    $currentUserprofile = $_SESSION['email'];
}else{
    header("Location: ../homepage.php");
}

?>

<?php echo (isset($result))? $result:'';?>
<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html lang="en">

    <head>
        <title>TUMMY FOR YUMMY</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="../css/header_footer.css">
        <link rel="stylesheet" href="../css/main.css">
        <link href="../css/bootstrap.css" rel="stylesheet" type="text/css"/>
        <link rel="stylesheet" href="../css/admin_order.css">
        <link rel="stylesheet" href="../css/bootstrap.min.css">
        <!--<link rel="stylesheet" href="../assets/fonts/fontawesome/css/font-awesome.min.css">-->
        <script defer src="../js/admin.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>

    </head>

    <body>
<?php
include 'adminHeader.inc.php';
?>
        <main class="page-container">
            <article>
                <section>
                    <div class="jumbotron" style="margin: 0px; padding: 0px; height: 100px;" >
                        <h1>Manage of Childcentre</h1>
                    </div>
                    <div class="container">
                        <div class="table-responsive">
                            <form method="post">
                                    <div class="row">
                                        <div class="col-lg-9">
                                            <input name="searchInput" type="text" id="searchInput" placeholder="Centre Name Search"
                                               aria-label="Search" value="<?php 
                                               if (isset ($_POST['searchInput'])){
                                                    echo (isset($_POST['searchInput']))? htmlentities($_POST['searchInput']):'';
                                               }
                                               else{
                                                    echo (isset($_SESSION['searchvalue']))? htmlentities($_SESSION['searchvalue']):''; 
                                               }?>">
                                        </div>
                                        <div class="col-lg-3">
                                            <button type="submit" class="btn btn-primary-outline-dark btn-lg">Search</button>
                                            <button type="button" class="btn btn-primary-outline-dark btn-lg createbtn" title="Update Details">Create</button>
                                        </div>
                                </div>
                            </form>
                            
                            <table id="orderTable" class="table table-striped table-bordered table-sm" cellspacing="0" width="100%">
                                <tr>
                                    <th>#</th>
                                    <th>Code</th>
                                    <th>Name</th>
                                    <th>Contact</th>
                                    <th>Address</th>
                                    <th>Action</th>
                                   
                                </tr>
                                <?php

                                //Check if the starting row variable was passed in the URL or not
                                if ( ! isset( $_GET['startrow'] ) or ! is_numeric( $_GET['startrow'] ) ) {

                                    //We give the value of the starting row to 0 because nothing was found in URL
                                    $startrow = 0;

                                    //Otherwise we take the value from the URL
                                } else {
                                    $startrow = (int) $_GET['startrow'];
                                }

                                if (!isset($_POST['searchInput'])){
                                    $result = $conn->query("SELECT * FROM centre LIMIT $startrow, 20" );

                                } else {
                                    $searchvalue = $_POST['searchInput'];
                                    $_SESSION['searchvalue'] = $_POST['searchInput'];
                                    $sql = "SELECT * FROM centre C WHERE C.centre_name LIKE '%$searchvalue%' LIMIT $startrow, 20;";
                                    $result = $conn->query($sql) or
                                    die( mysql_error() );
                                }
                                        if ( $result->num_rows > 0 ) {
                                            foreach ($result as $row) {
                                                ?>
                                                <tbody>
                                                    <tr>
                                                        <td class="counterCell"></td>
                                                        <td><?php echo $row['centre_code']; ?></td>
                                                        <td style="display:none;"><?php echo $row['centre_code']; ?></td>
                                                        <td><?php echo $row['centre_name']; ?></td>
                                                        <td><?php echo $row['centre_contact_no']; ?></td>
                                                        <td><?php echo $row['centre_address']; ?></td>
`                                                       <td style="display:none;"><?php echo $row['organisation_code']; ?></td>
                                                        <td style="display:none;"><?php echo $row['organisation_description']; ?></td>
                                                        <td style="display:none;"><?php echo $row['service_model']; ?></td>
                                                        <td style="display:none;"><?php echo $row['centre_email_address']; ?></td>
                                                        <td style="display:none;"><?php echo $row['postal_code']; ?></td>
                                                        <td style="display:none;"><?php echo $row['centre_website']; ?></td>
                                                        <td style="display:none;"><?php echo $row['infant_vacancy']; ?></td>
                                                        <td style="display:none;"><?php echo $row['pg_vacancy']; ?></td>
                                                        <td style="display:none;"><?php echo $row['n1_vacancy']; ?></td>
                                                        <td style="display:none;"><?php echo $row['n2_vacancy']; ?></td>
                                                        <td style="display:none;"><?php echo $row['k1_vacancy']; ?></td>
                                                        <td style="display:none;"><?php echo $row['k2_vacancy']; ?></td>
                                                        <td style="display:none;"><?php echo $row['food_offered']; ?></td>
                                                        <td style="display:none;"><?php echo $row['second_languages_offered']; ?></td>
                                                        <td style="display:none;"><?php echo $row['spark_certified']; ?></td>
                                                        <td style="display:none;"><?php echo $row['weekday_full_day']; ?></td>
                                                        <td style="display:none;"><?php echo $row['saturday']; ?></td>
                                                        <td style="display:none;"><?php echo $row['scheme_type']; ?></td>
                                                        <td style="display:none;"><?php echo $row['extended_operating_hours']; ?></td>
                                                        <td style="display:none;"><?php echo $row['provision_of_transport']; ?></td>
                                                        <td style="display:none;"><?php echo $row['government_subsidy']; ?></td>
                                                        <td style="display:none;"><?php echo $row['gst_regisration']; ?></td>

                                                        <td>
                                                            <!--<form method="post" style="margin-left: 0px; margin-bottom: 0px;">-->
                                                                <button type="button" class="btn btn-primary btn-xs updatebtn" title="Update Details">
                                                                        <span class="glyphicon glyphicon-edit"></span>
                                                                    </a>
                                                                </button>
                                                            <!--</form>-->
                                                        </td>
                                                    </tr>
                <?php
            }
            (isset($result)) ? $result->free_result() : "";
            unset($row);
        } else {
            ?>    
                                                <tr>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td>No Data Available!</td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                </tr>
            <?php
        }
        ?>
                                </tbody>
                            </table>
        <?php
        $prev = $startrow - 20;
        //  only print a "Previous" link if a "Next" was clicked
        if ( $prev >= 0 ) {
            echo '<a href="' . $_SERVER['PHP_SELF'] . '?startrow=' . $prev . '">Previous     </a>';
        }
        //  Now this is the link..
        echo '<a href="' . $_SERVER['PHP_SELF'] . '?startrow=' . ( $startrow + 20 ) . '&searchvalue=' . $searchvalue .'">Next</a>';
       

        ?>
                        </div>
                    </div>
                </section>
            </article>

            <script>
                //To hide 'customer_id'
//                $("td:nth-of-type(3)").hide();
                 

                $(document).ready(function () {
                    $('.updatebtn').on('click', function () {
                       
                        $('#updateCatering').modal('show');

                        $tr = $(this).closest('tr');

                        var data = $tr.children("td").map(function () {
                            return $(this).text();
                        }).get();

                        console.log(data);
//                        document.getElementById("centretitle").innerHTML = data[1] + "| " + data[3];

                        $('#centreCode').val(data[1]);
                        $('#centreName').val(data[3]);
                        $('#orgCode').val(data[6]);
                        $('#orgDesc').val(data[7]);
                        $('#serviceModel').val(data[8]);
                        $('#contactNum').val(data[4]);
                        $('#emailAddress').val(data[9]);
                        $('#centreAddress').val(data[5]);
                        $('#postalCode').val(data[10]);
                        $('#centreWeb').val(data[11]);
                        $('#infantVac').val(data[12]);
                        $('#pgVac').val(data[13]);
                        $('#n1Vac').val(data[14]);
                        $('#n2Vac').val(data[15]);
                        $('#k1Vac').val(data[16]);
                        $('#k2Vac').val(data[17]);
                        $('#fdOffer').val(data[18]);
                        $('#secLang').val(data[19]);
                        $('#sparkCert').val(data[20]);
                        $('#wkFullDay').val(data[21]);
                        $('#saturday').val(data[22]);
                        $('#schemeType').val(data[23]);
                        $('#extendOpt').val(data[24]);
                        $('#proTransport').val(data[25]);
                        $('#govSub').val(data[26]);
                        $('#gstReg').val(data[27]);
                        
//                        $.ajax({  
//                            type: 'POST',  
//                            url: 'admin_centreServicesDt.php', 
//                            data: { album: data[3] },
//                            success: function(data) {
//                                content.html(data);
//                                window.location = "admin_centreServicesDt.php";
//                            }
//                        });
                        $.ajax({
                            type: 'POST',
                            url: 'admin_centreServicesDt.php',
                            data: {dataString: data},
                            success: function (data) {
                                $('#msg').text(data);
                                console.log(data);
                                window.location = "admin_centreServicesDt.php";
                            }
                        });
                    });
                });
            </script>

<?php
include 'adminFooter.inc.php';
?>

        </main>
    </body>


</html>

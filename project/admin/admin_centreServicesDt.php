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

if(isset($_POST['dataString'])) {
    $_SESSION['curUserData'] = $_POST['dataString'];
    echo $_SESSION['curUserData'];
}else{
//    header("Location: ../homepage.php");
}

//if(isset($_SESSION['email'])) {
//    $currentUserprofile = $_SESSION['email'];
//}else{
//    header("Location: ../homepage.php");
//}

if(isset($_POST['save'])){
    $checkbox = $_POST['check'];
    for($i=0;$i<count($checkbox);$i++){
        $del_id = $checkbox[$i]; 
        mysqli_query($conn,"DELETE FROM centre_service WHERE centre_service_id='".$del_id."'");
        $message = "Data deleted successfully !";
    }
}

if(isset($_POST['save2'])){
    $checkbox2 = $_POST['check2'];
    for($i2=0;$i2<count($checkbox2);$i2++){
        $del_id2 = $checkbox2[$i2]; 
        mysqli_query($conn,"DELETE FROM incidental_charge WHERE incidental_charges_id ='".$del_id2."'");
        $message = "Data deleted successfully !";
    }
}

if(isset($_POST['save3'])){
    $checkbox3 = $_POST['check3'];
    for($i3=0;$i3<count($checkbox3);$i3++){
        $del_id3 = $checkbox3[$i3]; 
        mysqli_query($conn,"DELETE FROM centre_subsidies WHERE centre_subsidy_id ='".$del_id3."'");
        $message = "Data deleted successfully !";
    }
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
                        <h2><?php echo $_SESSION['curUserData'][1]. " | ". $_SESSION['curUserData'][3]; ?></h2>
                        <h2><?php echo $_SESSION['curUserData'][5]; ?></h2>
                    </div>
                    <div class="container">
                        <div class="table-responsive">
                            
                        </div>
                         <div role="tabpanel">
                                <!-- Nav tabs -->
                                <ul class="nav nav-tabs" role="tablist">
                                    <li role="presentation" class="active"><a href="#uploadTab" aria-controls="uploadTab" role="tab" data-toggle="tab">
                                            Service</a>
                                    </li>
                                    <li role="presentation"><a href="#browseTab" aria-controls="browseTab" role="tab" data-toggle="tab">
                                            Incidental Charge</a>
                                    </li>
                                    <li role="presentation"><a href="#subsidiesTab" aria-controls="subsidiesTab" role="tab" data-toggle="tab">
                                            Subsidies</a>
                                    </li>
                                </ul>
                                <!-- Tab panes -->
                                <div class="tab-content">
                                    <div role="tabpanel" class="tab-pane active" id="uploadTab">
                                        <div class="pre-scrollable">
                                            <form method="post" action="">
                                            <table id="orderTable" cellspacing="0" width="100%">
                                                <thead>
                                                    <th>#</th>
                                                    <th>Class of Licence</th>
                                                    <th>Type of Service</th>
                                                    <th>Level Offered</th>
                                                    <th>Fees</th>   
                                                    <th>Citizenhip</th>
                                                    <th><input type="checkbox" id="checkAl"> Select All</th>

                                                </thead>
                                                <?php
                                                $i=0;
                                                $result = $conn->query("SELECT * FROM centre_service WHERE centre_code = '".$_SESSION['curUserData'][1]."';");
//                                                $conn->close();  
                                                if ( $result-> num_rows > 0 ) {
                                                    foreach ($result as $row) { ?>
                                                             <tr>
                                                                <td class="counterCell"></td>
                                                                <td><?php echo $row['class_of_licence'] ?></td>
                                                                <td><?php echo $row['type_of_service'] ?></td>
                                                                <td><?php echo $row['levels_offered'] ?></td>
                                                                <td><?php echo $row['fees'] ?></td>
                                                                <td><?php echo $row['type_of_citizenship'] ?></td>
                                                                <td><input type="checkbox" id="checkItem" name="check[]" value="<?php echo $row["centre_service_id"]; ?>"></td>
         `                                                      
                                                             </tr>
                                                <?php
                                                    $i++;
                                                    }
                                                    (isset($result)) ? $result->free_result() : "";
                                                    unset($row);
                                                }
                                                ?>   
                                            </table>
                                                <p align="center"><button type="submit" class="btn btn-dark" name="save">DELETE</button></p>
                                            </form>
                                        </div>
                                        
                                        <div class="row">
                                            <form action="process_createService.php" method="POST">
                                                <div class="col-md-6">
                                                    <input type="hidden" name="centreCode" id="centreCode" class="form-control" value="<?php echo $_SESSION['curUserData'][1]?>"readonly>
                                                    <input type="hidden" name="centreName" id="centreName" class="form-control" value="<?php echo $_SESSION['curUserData'][3]?>"readonly>
                                                    <div class="form-group">
                                                        <label> Class of Licence </label>
                                                        <input type="text" name="Class_Lic" id="Class_Lic" class="form-control" placeholder="e.g. 'Class B (Child Care)'" required>
                                                    </div>
                                                    <div class="form-group">
                                                        <label> Type of Service </label>
                                                        <input type="text" name="TypeService" id="TypeService" class="form-control" placeholder="e.g. 'Full Day'" required>
                                                    </div> 
                                                    <div class="form-group">
                                                        <label> Fees </label><br/>
                                                        <input type="text" name="Fees" id="Fees" class="form-control" placeholder="e.g. '53'" required>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label> Levels Offered </label>
                                                        <input type="text" name="LvlOffered" id="LvlOffered" class="form-control" placeholder="e.g. 'Nursery (4 yrs old)'" required>
                                                    </div> 
                                                    <div class="form-group">
                                                        <label> Citizenship </label>
                                                        <select name="Citizenship" id="Citizenship" class="form-control" placeholder="Citizenship" required>
                                                            <option value="SC">SC</option>
                                                            <option value="SPR">SPR</option>
                                                            <option value="Others">Others</option>
                                                        </select>
                                                    </div> 
                                                    <div class="form-group">
                                                        <button type="submit" class="btn btn-dark" name="updatebutton">Add Service</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                    <div role="tabpanel" class="tab-pane" id="browseTab">
                                        <div class="pre-scrollable">
                                            <form method="post" action="">
                                            <table id="orderTable" cellspacing="0" width="100%">
                                                <thead>
                                                    <th>#</th>
                                                    <th>Incidental Charges</th>
                                                    <th>Frequency</th>
                                                    <th>Amount</th>
                                                    <th><input type="checkbox" id="checkA2"> Select All</th>

                                                </thead>
                                                <?php
                                                $i2=0;
                                                $result2 = $conn->query("SELECT * FROM incidental_charge WHERE centre_code = '".$_SESSION['curUserData'][1]."';");
                                                if ( $result2-> num_rows > 0 ) {
                                                    foreach ($result2 as $row2) { ?>
                                                             <tr>
                                                                <td class="counterCell"></td>
                                                                <td><?php echo $row2['incidental_charges'] ?></td>
                                                                <td><?php echo $row2['frequency'] ?></td>
                                                                <td><?php echo $row2['amount'] ?></td>
                                                                <td><input type="checkbox" id="checkItem" name="check2[]" value="<?php echo $row2["incidental_charges_id"]; ?>"></td>
         `                                                      
                                                             </tr>
                                                <?php
                                                    $i2++;
                                                    }
                                                    (isset($result2)) ? $result2->free_result() : "";
                                                    unset($row2);
                                                }
                                                ?>   
                                            </table>
                                                <p align="center"><button type="submit" class="btn btn-dark" name="save2">DELETE</button></p>
                                            </form>
                                        </div>
                                        
                                        <div class="row">
                                            <form action="process_createCharges.php" method="POST">
                                                <div class="col-md-6">
                                                    <input type="hidden" name="centreCode" id="centreCode" class="form-control" value="<?php echo $_SESSION['curUserData'][1]?>"readonly>
                                                    <input type="hidden" name="centreName" id="centreName" class="form-control" value="<?php echo $_SESSION['curUserData'][3]?>"readonly>
                                                    <div class="form-group">
                                                        <label> Incidental Charges </label>
                                                        <input type="text" name="Icharges" id="Icharges" class="form-control" placeholder="e.g. 'Uniforms/PE Attire (Optional)'" required>
                                                    </div>
                                                    
                                                    <div class="form-group">
                                                        <label> Amount </label><br/>
                                                        <input type="text" name="Amount" id="Amount" class="form-control" placeholder="e.g. '53'" required>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label> Frequency </label>
                                                        <input type="text" name="Frequency" id="Frequency" class="form-control" placeholder="e.g. 'Annually'" required>
                                                    </div> 
                                                    <div class="form-group">
                                                        <button type="submit" class="btn btn-dark" name="updatebutton">Add Charges</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                    <div role="tabpanel" class="tab-pane" id="subsidiesTab">
                                        <div class="pre-scrollable">
                                            <form method="post" action="">
                                            <table id="orderTable" cellspacing="0" width="100%">
                                                <thead>
                                                    <th>#</th>
                                                    <th>Subsidy Category</th>
                                                    <th><input type="checkbox" id="checkA3"> Select All</th>

                                                </thead>
                                                <?php
                                                $i3=0;
                                                $result3 = $conn->query("SELECT * FROM centre_subsidies WHERE centre_code = '".$_SESSION['curUserData'][1]."';");
//                                                $conn->close();  
                                                if ( $result3-> num_rows > 0 ) {
                                                    foreach ($result3 as $row3) { ?>
                                                             <tr>
                                                                <td class="counterCell"></td>
                                                                <td><?php echo $row3['subsidy_category'] ?></td>
                                                                <td><input type="checkbox" id="checkItem3" name="check3[]" value="<?php echo $row3["centre_subsidy_id"]; ?>"></td>
         `                                                      
                                                             </tr>
                                                <?php
                                                    $i3++;
                                                    }
                                                    (isset($result3)) ? $result3->free_result() : "";
                                                    unset($row3);
                                                }
                                                ?>   
                                            </table>
                                                <p align="center"><button type="submit" class="btn btn-dark" name="save3">DELETE</button></p>
                                            </form>
                                        </div>
                                        
                                        <div class="row">
                                            <form action="process_createSubsidy.php" method="POST">
                                                <div class="col-md-6">
                                                    <input type="hidden" name="centreCode" id="centreCode" class="form-control" value="<?php echo $_SESSION['curUserData'][1]?>"readonly>
                                                    <input type="hidden" name="centreName" id="centreName" class="form-control" value="<?php echo $_SESSION['curUserData'][3]?>"readonly>
                                                    <div class="form-group">
                                                        <label> Subsidy Category </label>
                                                        <select name="sCategory" id="sCategory" class="form-control" required>
                                                            <option value="">Select</option>
                                                        <?php
                                                        $result4 = $conn->query("SELECT * FROM govt_subsidies;");
                                                        $conn->close();  
                                                        if ( $result4-> num_rows > 0 ) {
                                                            foreach ($result4 as $row4) { ?>
                                                                    <option value="<?php echo $row4['subsidy_category']?>"><?php echo $row4['subsidy_category']?></option>                                                                
                                                        <?php
                                                            }
                                                            (isset($result4)) ? $result4->free_result() : "";
                                                            unset($row4);
                                                        }
                                                        ?>   
                                                        </select>
<!--                                                        <input type="text"  placeholder="e.g. 'Class B (Child Care)'" required>-->
                                                    </div>
                                                   
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <button type="submit" class="btn btn-dark" name="updatebutton">Add Service</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div> 
                         </div>
                    </div>
                </section>
            </article>

            
            <script>
                //To hide 'customer_id'
//                $("td:nth-of-type(3)").hide();
                $("#checkAl").click(function () {
                    $('input:checkbox').not(this).prop('checked', this.checked);
                });
                
                $("#checkA2").click(function () {
                    $('input:checkbox').not(this).prop('checked', this.checked);
                });
                
                $("#checkA3").click(function () {
                    $('input:checkbox').not(this).prop('checked', this.checked);
                });

                $(document).ready(function () {
                    $('.updatebtn').on('click', function () {
                       
                    
                        $('#updateCatering').modal('show');

                        $tr = $(this).closest('tr');

                        var data = $tr.children("td").map(function () {
                            return $(this).text();
                        }).get();

                        console.log(data);
                        document.getElementById("centretitle").innerHTML = data[1] + "| " + data[3];

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
                        
                    });
                });
            </script>

<?php
include 'adminFooter.inc.php';
?>

        </main>
    </body>


</html>

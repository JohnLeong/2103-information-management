<?php
use MongoDB\BSON\Regex;
require '../vendor/autoload.php';
require_once('../../protected/configmdb.php');

error_reporting(E_ERROR | E_PARSE);


$fullname = $orderid = $email = $date = $time = $price = $errorMsg = "";
$success = true;

//Helper function that checks input for malicious or unwanted content.
function sanitize_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
session_start();

if(isset($_POST['dataString'])) {
    $_SESSION['curUserData'] = $_POST['dataString'];
    echo $_SESSION['curUserData'];
}else{
//    header("Location: ../homepage.php");
}



if(isset($_POST['save'])){
    
    $collection = $mongo->alfredng_db->centre;
    $result = $collection->find([ 'centre_code' => $_SESSION['curUserData'][1]]);    
    
    $checkbox = $_POST['check'];
    for($i=0;$i<count($checkbox);$i++){
        $del_id = $checkbox[$i]; 
        $deleteResult = $collection->updateOne(
            array("centre_code" => $_SESSION['curUserData'][1]),
            (array('$pull' => array("centre_service" => array("type_of_service" => $del_id))))
        );
    }
    header("location: admin_centreServicesDt.php");
    
}

if(isset($_POST['save2'])){
    $collection = $mongo->alfredng_db->centre;
    $result = $collection->find([ 'centre_code' => $_SESSION['curUserData'][1]]);    
    
    $checkbox2 = $_POST['check2'];
    for($i2=0;$i2<count($checkbox2);$i2++){
        $del_id2 = $checkbox2[$i2]; 
        $deleteResult = $collection->updateOne(
            array("centre_code" => $_SESSION['curUserData'][1]),
            (array('$pull' => array("incidental_charges" => array("incidental_charges" => $del_id2))))
        );
    }
    header("location: admin_centreServicesDt.php");
    
}

if(isset($_POST['save3'])){
    
    
    $collection = $mongo->alfredng_db->centre;
    $result = $collection->find([ 'centre_code' => $_SESSION['curUserData'][1]]);    
    $checkbox3 = $_POST['check3'];
    for($i3=0;$i3<count($checkbox3);$i3++){
        $del_id3 = $checkbox3[$i3]; 
        $deleteResult = $collection->updateOne(
            array("centre_code" => $_SESSION['curUserData'][1]),
            (array('$pull' => array("centre_subsidies" => array("subsidy_category" => $del_id3))))
        );
    }
    header("location: admin_centreServicesDt.php");
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
                                                $collection = $mongo->alfredng_db->centre;
                                                $result = $collection->find([ 'centre_code' => $_SESSION['curUserData'][1]]);
                                                if ( $result != "" ) {
                                                    foreach ($result as $entry) {
;
                                                        for ($i = 0; $i < count($entry['centre_service']); $i++){
                                                            
                                                        ?>
                                                             <tr>
                                                                <td class="counterCell"></td>
                                                                <td><?php echo $entry['centre_service'][$i]['class_of_licence'] ?></td>
                                                                <td><?php echo $entry['centre_service'][$i]['type_of_service'] ?></td>
                                                                <td><?php echo $entry['centre_service'][$i]['levels_offered'] ?></td>
                                                                <td><?php echo $entry['centre_service'][$i]['fees'] ?></td>
                                                                <td><?php echo $entry['centre_service'][$i]['type_of_citizenship'] ?></td>
                                                                <td><input type="checkbox" id="checkItem" name="check[]" value="<?php echo $entry['centre_service'][$i]['type_of_service'] ?>"></td>
         `                                                      
                                                             </tr>
                                                <?php
                                                    $i++;
                                                        }
                                                    }
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
                                                $collection = $mongo->alfredng_db->centre;
                                                $result2 = $collection->find([ 'centre_code' => $_SESSION['curUserData'][1]]);
//                                              
                                                if ( $result2 != "" ) {
                                                    foreach ($result2 as $entry) {
                                                        for ($i = 0; $i < count($entry['incidental_charges']); $i++){
                                                        
                                                            ?>
                                                            <tr>
                                                               <td class="counterCell"></td>
                                                               <td><?php echo $entry['incidental_charges'][$i]['incidental_charges'] ?></td>
                                                               <td><?php echo $entry['incidental_charges'][$i]['frequency'] ?></td>
                                                               <td><?php echo $entry['incidental_charges'][$i]['amount'] ?></td>
                                                               <td><input type="checkbox" id="checkItem" name="check2[]" value="<?php echo $entry['incidental_charges'][$i]['incidental_charges'] ?>"></td>
         `                                                  </tr>
                                                <?php
                                                    $i2++;
                                                        }
                                                    }
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
                                                $collection = $mongo->alfredng_db->centre;
                                                $result3 = $collection->find([ 'centre_code' => $_SESSION['curUserData'][1]]);
                                                
                                                if ( $result3 != "" ) {
                                                    foreach ($result3 as $entry) {
                                                        for ($i = 0; $i < count($entry['centre_subsidies']); $i++){ ?>
                                                             <tr>
                                                                <td class="counterCell"></td>
                                                                <td><?php echo $entry['centre_subsidies'][$i]['subsidy_category'] ?></td>
                                                                <td><input type="checkbox" id="checkItem3" name="check3[]" value="<?php echo $entry['centre_subsidies'][$i]['subsidy_category'] ?>"></td>
         `                                                      
                                                             </tr>
                                                <?php
                                                        }
                                                    }
                                                    $i3++;
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
                                                            $collection = $mongo->alfredng_db->govt_subsidies;
                                                            $result4 = $collection->find();
                                                        if ( $result4 != "") {
                                                            foreach ($result4 as $row4) { ?>
                                                                    <option value="<?php echo $row4['subsidy_category']?>"><?php echo $row4['subsidy_category']?></option>                                                                
                                                        <?php
                                                            }
                                                        }
                                                        ?>   
                                                        </select>
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

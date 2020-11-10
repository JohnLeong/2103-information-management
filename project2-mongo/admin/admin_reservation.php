<?php
// Constants for accessing our DB:
define("DBHOST", "161.117.122.252");
define("DBNAME", "p2_5");
define("DBUSER", "p2_5");
define("DBPASS", "rBs4CTxkDU");
$fname = $lname = $email = $mobileNumber = $reservationDate = $reservationTime = $reservationPax = $reservationRequest = $errorMsg = "";
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
    $success;
}

$ALFRED = "";
?>

<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html  lang="en">

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
                <section>
                    <div class="jumbotron">
                        <h1>View Restaurant Reservations</h1>
                    </div>
                    <div class="container">
                        <div class="table-responsive">
                            <input type="text" id="searchInput" onkeyup="tableFunction()" placeholder="Search"
                                   aria-label="Search"">
                            <table id="orderTable" class="table table-striped table-hover">
<?php
$sql = "SELECT * FROM customer_reservation";
$result = $conn->query($sql);
?>
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Reservation ID</th>
                                        <th>Customer Name</th>
                                        <th>Mobile Number</th>
                                        <th>Date</th>
                                        <th>Time</th>
                                        <th>Pax</th>
                                        <th>Request</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
<?php
if ($result->num_rows > 0) {
    foreach ($result as $row) {
        ?>
                                        <tbody>
                                            <tr>
                                                <td class="counterCell"></td>
                                                <td><?php echo $row['reservation_id']; ?></td>
                                                <td><?php echo $row['fname'], " ", $row['lname']; ?></td>
                                                <td><?php echo $row['mobileNumber']; ?></td>
                                                <td><?php echo $row['reservationDate']; ?></td>
                                                <td><?php echo $row['reservationTime']; ?></td>
                                                <td><?php echo $row['reservationPax']; ?></td>
                                                <td><?php echo $row['reservationRequest']; ?></td>
                                                <td><button type="button" class="btn btn-primary btn-xs updatebtn"title="Update Details"><span class="glyphicon glyphicon-edit"></span></button></td>
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
                                            <td>No Data Available!</td>
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
                        </div>
                    </div>
                </section>
            </article>

            <!-- View Reservation Details Modal -->
            <div class="modal fade" id="updateReservation" tab-index="-1" role="dialog">
                <div class="modal-dialog" role="document">

                    <!-- Modal content-->
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title">View Restaurant Details</h4>
                        </div>
                        <form action="process_updatedetails.php" method="POST">
                            <div class="modal-body">
                                <div class="form-group">
                                    <label> Reservation ID </label>
                                    <input type="text" name="reservationID" id="reservationID" class="form-control" placeholder="Reservation ID" readonly>
                                </div>
                                <div class="form-group">
                                    <label> Customer Name </label>
                                    <input type="text" name="name" id="name" class="form-control" placeholder="Customer Name" readonly>
                                </div> 
                                <div class="form-group">
                                    <label> Mobile Number </label>
                                    <input type="text" name="mobileNumber" id="mobileNumber" class="form-control" placeholder="Mobile Number" readonly>
                                </div>  
                                <div class="form-group">
                                    <label> Reservation Date </label>
                                    <input type="text" name="reservationDate" id="reservationDate" class="form-control" placeholder="Reservation Date (YYYY-MM-DD)" required>
                                </div>
                                <div class="form-group">
                                    <label> Reservation Time </label>
                                    <input type="text" name="reservationTime" id="reservationTime" class="form-control" placeholder="Reservation Time" required>
                                </div>
                                <div class="form-group">
                                    <label> Reservation Pax </label>
                                    <input type="text" name="reservationPax" id="reservationPax" class="form-control" placeholder="Reservation Pax" onkeypress="javascript:return isNumber(event)" required>
                                </div> 
                                <div class="form-group">
                                    <label> Reservation Request </label>
                                    <input type="text" name="reservationRequest" id="reservationRequest" class="form-control" placeholder="Reservation Request" readonly>
                                </div>       
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-dark" name="updatebutton">Update</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <script>
                $(document).ready(function () {
                    $('.updatebtn').on('click', function () {
                        $('#updateReservation').modal('show');

                        $tr = $(this).closest('tr');

                        var data = $tr.children("td").map(function () {
                            return $(this).text();
                        }).get();

                        console.log(data);

                        $('#reservationID').val(data[1]);
                        $('#name').val(data[2]);
                        $('#mobileNumber').val(data[3]);
                        $('#reservationDate').val(data[4]);
                        $('#reservationTime').val(data[5]);
                        $('#reservationPax').val(data[6]);
                        $('#reservationRequest').val(data[7]);

                    });
                });
            </script>

<?php
include 'adminFooter.inc.php';
?>

        </main>

    </body>


</html>

<?php
session_start();
$_SESSION['event_id']=9;
$id=9;
include('server/connect.php');
$check="SELECT * from event_limit where event_id='$id'";
$data=$conn->query($check);
$limit_check=$data->fetch_assoc();
$current_reg=$limit_check['current_reg'];
$limit=$limit_check['reg_limit'];
if($current_reg<$limit)
{
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Colorlib Templates">
    <meta name="author" content="Colorlib">
    <meta name="keywords" content="Colorlib Templates">

    <!-- Title Page-->
    <title>Register your events</title>

    <!-- Icons font CSS-->
    <link href="vendor/mdi-font/css/material-design-iconic-font.min.css" rel="stylesheet" media="all">
    <link href="vendor/font-awesome-4.7/css/font-awesome.min.css" rel="stylesheet" media="all">
    <!-- Font special for pages-->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i" rel="stylesheet">

    <!-- Vendor CSS-->
    <link href="vendor/select2/select2.min.css" rel="stylesheet" media="all">
    <link href="vendor/datepicker/daterangepicker.css" rel="stylesheet" media="all">

    <!-- Main CSS-->
    <link href="css/main.css" rel="stylesheet" media="all">
</head>

<body>
    <div class="page-wrapper bg-gra-03 p-t-45 p-b-50">
        <div class="wrapper wrapper--w790">
            <div class="card card-5">
                <div class="card-heading">
                    <h2 class="title">Workshop</h2>
                </div>
                <div class="card-body">
                    <form action="server/process_indi_reg.php" method="POST">
                        <div class="form-row">
                            <div class="name">College Name</div>
                            <div class="value">
                                <div class="input-group">
                                    <input class="input--style-5" type="text" placeholder="enter your College" name="collegename" required pattern="[A-Za-z\s]+" title="Only letters and spaces are allowed" required>
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="name">Department Name</div>
                            <div class="value">
                                <div class="input-group">
                                    <input class="input--style-5" type="text" placeholder="enter your department" name="department" required pattern="[A-Za-z\s]+" title="Only letters and spaces are allowed" required>
                                </div>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="name">Name</div>
                            <div class="value">
                                <div class="input-group">
                                    <input class="input--style-5" type="text" placeholder="enter your name" name="name" required pattern="[A-Za-z\s]+" title="Only letters and spaces are allowed" required>
                                </div>
                            </div>
                        </div>

                        
                      
                        <div class="form-row">
                            <div class="name">Email</div>
                            <div class="value">
                                <div class="input-group">
                                    <input class="input--style-5" type="email" placeholder="enter your email id" name="email" required pattern="[a-z0-9._%+-]+@gmail\.com" title="Please enter a valid Gmail address with only lowercase letters" required>
                                </div>
                            </div>
                        </div>
                       
                        <div class="form-row m-b-55">
                            <div class="name">Phone Number (Whatsapp)</div>
                            <div class="value">
                                <div class="row row-refine">
                                    <div class="col-9">
                                        <div class="input-group-desc">
                                            <input class="input--style-5" type="text" required pattern="\d{10}" title="Phone number must be 10 digits" placeholder="enter your phone number" name="phone">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="form-row">
                            <div class="name">To Pay: <br><h2>Rs 100/-</h2></div>
                            <div class="value">
                                <div class="input-group">
                                    <img src="images\Workshop.jpg" width=300px height=400px><br>
                                    <label style="margin-left: 10px; font-size: 16px; color: white; display: block; text-align: justify;">please save your transaction id after payment to submit below !</label>
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="name">Transaction ID</div>
                            <div class="value">
                                <div class="input-group">
                                    <input class="input--style-5" type="text" required pattern="\d{12}" title="Transaction ID must be 12 digits" placeholder="enter your 12 digit transaction id" name="transaction" required>
                                    <label style="margin-left: 10px; font-size: 16px; color: white; display: block; text-align: justify;">ensure that there are no trailing spaces or special chars</label>
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="name"><input type="checkbox" id="declaration" required style="width: 30px; height: 30px"; name="declaration" required></div>
                            <div class="value">
                                <div class="input-group">
                                    
                                    <label for="declaration" style="margin-left: 10px; font-size: 16px; color: white; display: block; text-align: justify;">I hereby certify that the information provided in this form is accurate and truthful to the best of my knowledge. I understand that any false or misleading information may result in disqualification from the event. Furthermore, I acknowledge that the payment made is non-refundable, except in cases deemed legitimate by the organizing committee. I also consent to the use of the details submitted for certificate issuance and other event-related purposes.
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="center-button">
                            <button class="btn btn--radius-2 btn--green" type="submit">Register</button>
                        </div>                        
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Jquery JS-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <!-- Vendor JS-->
    <script src="vendor/select2/select2.min.js"></script>
    <script src="vendor/datepicker/moment.min.js"></script>
    <script src="vendor/datepicker/daterangepicker.js"></script>

    <!-- Main JS-->
    <script src="js/global.js"></script>

</body><!-- This templates was made by Colorlib (https://colorlib.com) -->

</html>
<!-- end document-->
<?php
}
else{
    //header("Location:server/limit_reached.php");
    echo "<script>window.location.href='server/limit_reached.php';</script>";
}
?>

<?php
session_start();
if(isset($_SESSION['user']) && $_SESSION['user'] === "coordinator")
{
$event_name=$_SESSION['event_name'];
include('connect.php');
$sel="SELECT * from event_limit where event_name='$event_name'";
$data=$conn->query($sel);
$event_limit=$data->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
            color: #495057;
            font-family: Arial, sans-serif;
        }
        .header {
            background-color: #007bff;
            color: #fff;
            padding: 20px;
            text-align: center;
            border-radius: 10px 10px 0 0;
            margin-bottom: 20px;
        }
        .dashboard-container {
            margin: 0 auto;
            max-width: 600px;
        }
        .card {
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            transition: transform 0.2s ease-in-out, box-shadow 0.2s ease-in-out;
            background-color: #fff;
        }
        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.2);
        }
        .card-title {
            font-weight: bold;
            margin-bottom: 20px;
        }
        .btn-group {
            width: 100%;
        }
        .btn-group button {
            width: 50%;
            border-radius: 50px;
            transition: background-color 0.2s ease-in-out;
        }
        .btn-group button:hover {
            background-color: #007bff;
            color: #fff;
        }
        .btn-danger:hover {
            background-color: #dc3545;
            color: #fff;
        }
        .btn-success:hover {
            background-color: #28a745;
            color: #fff;
        }
        .current-value, .limit-value {
            font-size: 2rem;
            font-weight: bold;
        }
        .alert-custom {
            background-color: #fff3cd;
            color: #856404;
            border-color: #ffeeba;
        }
    </style>
</head>
<body>
    <header class="header">
        <h1><?php echo($event_name) ?> Dashboard</h1>
        <p>Manage and Monitor Event Participation</p>
    </header>
   <form method="POST">
    <div class="container dashboard-container">
        <!-- Alert Message -->
        <div class="alert alert-custom alert-dismissible fade show" role="alert">
            <strong>Notice:</strong> Use this feature only after reviewing pending event registration requests because when you reject an event registration request, the count is decremented by 1.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>

        <!-- Current Number of Participants -->
         
        <div class="card">
            <h5 class="card-title">Current Number of Participants</h5>
            <div class="row mb-3">
                <div class="col-md-6">
                    <button class="btn btn-danger btn-sm btn-block" name="sub_current">-</button>
                </div>
                <div class="col-md-6">
                    <button class="btn btn-success btn-sm btn-block" name="add_current">+</button>
                </div>
            </div>
            <h3 id="currentParticipants" class="current-value"><?php echo($event_limit['current_reg'])?></h3>
        </div>

        <!-- Participant Limit -->
        <div class="card">
            <h5 class="card-title">Participant Limit</h5>
            <div class="row mb-3">
                <div class="col-md-6">
                    <button class="btn btn-danger btn-sm btn-block" name="sub_limit">-</button>
                </div>
                <div class="col-md-6">
                    <button class="btn btn-success btn-sm btn-block" name="add_limit">+</button>
                </div>
            </div>
            <h3 id="participantLimit" class="limit-value"><?php echo($event_limit['reg_limit'])?></h3>
        </div>
    </div>
    </form>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
<?php
if(isset($_POST['sub_current'])){
    $sub_current="UPDATE event_limit set current_reg=current_reg-1 where event_name='$event_name'";
    if($conn->query($sub_current))
    {
         echo "<script>window.location.href='/admin/coordinator.php';</script>";
    }
    
}
else if(isset($_POST['add_current']))
    {
        $add_current="UPDATE event_limit set current_reg=current_reg+1 where event_name='$event_name'";
        if($conn->query($add_current))
        {
             echo "<script>window.location.href='/admin/coordinator.php';</script>";
        }
        
    }
else if(isset($_POST['sub_limit']))
    {
        $sub_limit="UPDATE event_limit set reg_limit=reg_limit-1 where event_name='$event_name'";
        if($conn->query($sub_limit))
        {
             echo "<script>window.location.href='/admin/coordinator.php';</script>";
        }
       
    }
else if(isset($_POST['add_limit']))
    {
        $add_limit="UPDATE event_limit set reg_limit=reg_limit+1 where event_name='$event_name'";
        if($conn->query($add_limit))
        {
             echo "<script>window.location.href='/admin/coordinator.php';</script>";
        }
       
    }
}
    else{
    header("Location:restricted.php");
 }
?>

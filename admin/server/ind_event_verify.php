<?php
session_start();
if(isset($_SESSION['user']))
{
$id=$_GET['id'];
include('connect.php');
$update_status="UPDATE individual_events set status='verified' where reg_id ='$id'";
if($conn->query($update_status))
    {
         if($_SESSION['user']=="super_user")
            {
               echo "<script>window.location.href = '/admin/aaddmmiinn.php';</script>";
    
            }
        else{
            echo "<script>window.location.href = '/admin/coordinator.php';</script>";
        }
    }
else{
    echo($conn->error);

    }
}
else{
    header("restricted.php");
}
?>

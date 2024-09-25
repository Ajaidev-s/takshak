<?php
session_start();
if(isset($_SESSION['user']))
{
include('connect.php');
$id=$_GET['id'];
$update_status="UPDATE group_event set status='verified' where reg_id ='$id'";
if($conn->query($update_status))
    {   if($_SESSION['user']=="super_user")
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

<?php
session_start();
if(isset($_SESSION['user']))
{
include('connect.php');
$id=$_GET['id'];
$update_status="UPDATE group_event set status='deleted' where reg_id ='$id'";
if($conn->query($update_status))
    {
        header("delete_participant.php");
    }
else{
    echo($conn->error);

}
}
?>

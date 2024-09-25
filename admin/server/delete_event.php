<?php
include('connect.php');
$id=$_GET['id'];
$delete_query="DELETE from event_details  where event_id='$id'";
echo($delete_query);
if($conn->query($delete_query))
    {   //header("Location:event_list.php");
        echo "<script>window.location.href = 'event_list.php';</script>";
        
    }
else{
    echo($conn->error);

}
?>

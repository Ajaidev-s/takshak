<?php
include('connect.php');
$id=$_GET['id'];
$delete_query="DELETE from users  where id='$id'";
//echo($delete_query);
if($conn->query($delete_query))
    {  // header("Location:users_list.php");
     echo "<script>window.location.href = 'users_list.php';</script>";
        
    }
else{
    echo($conn->error);

}
?>

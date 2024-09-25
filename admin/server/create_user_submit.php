<?php
if(isset($_POST['btn1']))
        {
            include('connect.php');
            $user_name=$_POST['username'];
            $pass=$_POST['password'];
            $event_name=$_POST['eventname'];
            $event_id=$_POST['eventid'];
            $insert_query="INSERT into users(event_id,event_name,user_name,pass) values('$event_id','$event_name','$user_name','$pass')";
            if($conn->query($insert_query))
                {
                    //header("Location:/takshak/admin/aaddmmiinn.php");
                     echo "<script>window.location.href = '/admin/aaddmmiinn.php';</script>";
                }
            else
                {
                    //header("Location:user_creation_failed.php");
                    echo "<script>window.location.href = 'user_creation_failed.php';</script>";
                }


        }
?>

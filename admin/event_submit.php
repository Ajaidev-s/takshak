<?php

include('server/connect.php');

$id = $_POST['event-id'];
$event_name = $_POST['event-name'];
$cod_name = $_POST['coordinator-name'];
$cod_phn = $_POST['coordinator-phone'];
$subcod_name = $_POST['subcoordinator-name'];
$subcod_phn = $_POST['subcoordinator-phone'];
$participants = $_POST['participants'];
$img = $_POST['image-url'];
$grp_strenght = $_POST['grp_strenght'];

//echo($id . $event_name . $cod_name . $cod_phn . $subcod_name . $subcod_phn . $participants . $img);

$insert_query = "INSERT INTO event_details(event_id, event_name, cod_name, cod_phn, subcod_name, subcod_phn, participants, grp_strenght, img) 
VALUES ('$id', '$event_name', '$cod_name', '$cod_phn', '$subcod_name', '$subcod_phn', $participants, '$grp_strenght', '$img')";

//echo($insert_query);

// Execute query and check for errors
if ($conn->query($insert_query)) {
    $set_limit="INSERT into event_limit(event_id,event_name,reg_limit) values('$id','$event_name','$participants')";
    $conn->query($set_limit);
    echo("event reg sucess");
    echo "<script>
        setTimeout(function() {
            window.location.href = '/admin/server/event_reg_sucess.php';
        }, 600);
    //header("Location:server/event_reg_sucess.php");
} else {
    echo("\n\nFailed to insert data: " . $conn->error); // Display the database error
}
?>


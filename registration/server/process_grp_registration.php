<?php 
session_start();

$event_id = $_SESSION['event_id'];

include('connect.php');

// Prepare the select query
$select_strength = "SELECT grp_strenght, event_name FROM event_details WHERE event_id = ?";

if ($stmt = $conn->prepare($select_strength)) {
    // Bind the event ID
    $stmt->bind_param("s", $event_id); // "s" for string
    $stmt->execute();
    $result = $stmt->get_result();
    $event_details = $result->fetch_assoc();
    $stmt->close(); // Close the statement
}

// Get limit and event_name from the result
$limit = $event_details['grp_strenght'];
$event_name = $event_details['event_name'];

$clg = $_POST['collegename'];
$dpt_name = $_POST['department'];
$t_name = $_POST['teamname'];
$t_cap = $_POST['teamcaptain'];
$mail = $_POST['email'];
$phn = $_POST['phone'];
$alt_phn = $_POST['altphone'];
$t_members = "";
$trans_id = $_POST['transaction'];

// Process the team members
for ($i = 2; $i <= $limit; $i++) {
    $name = "member" . $i;
    $temp_name = $_POST[$name];
    $t_members = $t_members . "," . $temp_name;
}

// Prepare the insert query
$insert_query = "INSERT INTO group_event (clg_name, dept_name, team_name, captain_name, mail, phone, alt_phone, team_members, event_name, event_id, transaction_id) 
                 VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

if ($stmt = $conn->prepare($insert_query)) {
    // Bind the parameters
    $stmt->bind_param("sssssssssss", $clg, $dpt_name, $t_name, $t_cap, $mail, $phn, $alt_phn, $t_members, $event_name, $event_id, $trans_id);

    try {
        // Execute the insert query
        if ($stmt->execute()) {
            // Update the event limit
            $update_limit = "UPDATE event_limit SET current_reg = current_reg + 1 WHERE event_id = ?";
            if ($stmt_update = $conn->prepare($update_limit)) {
                $stmt_update->bind_param("s", $event_id);
                if ($stmt_update->execute()) {
                    // Close connections and redirect to success page
                    $stmt_update->close();
                    mysqli_close($conn);
                    echo "<script>window.location.href = 'reg_sucess.php';</script>";
                } else {
                    mysqli_close($conn);
                    echo "<script>window.location.href = 'reg_sucess.php';</script>";
                }
            }
        } else {
            // Error handling and redirection to the failed page
            echo($conn->error);
            mysqli_close($conn);
            echo "<script>window.location.href = 'reg_failed.php';</script>";
        }
    } catch (Throwable $e) {
        echo "<script>window.location.href = 'reg_failed.php';</script>";
    }
    
    $stmt->close(); // Close the insert statement
}

$conn->close(); // Close the database connection

?>

<?php
include('connect.php');
$event_limit_details="SELECT * from event_limit";
$data=$conn->query($event_limit_details);
function verified_count($id, $conn) {
    // IDs for group events
    $grp_ids = array(1, 2, 5, 6);  // Group event IDs

    // Determine the table based on the event ID
    if (in_array($id, $grp_ids)) {
        // Use the group_event table
        $table = 'group_event';
    } else {
        // Use the individual_events table
        $table = 'individual_events';
    }

    // Use COUNT() function to count the number of verified registrations
    $query = "SELECT COUNT(*) AS verified_count FROM `$table` WHERE status = 'verified' AND event_id = $id";

    // Execute the query and check for results
    $result = $conn->query($query);

    // Check if data exists and fetch the count
    if ($result && $result->num_rows > 0) {
        $row = $result->fetch_assoc();
        return $row['verified_count'];  // Return the count from COUNT()
    } else {
        return 0;  // Return 0 if no verified records found
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrations Limits</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            align-items: center;
        }
        header {
            width: 100%;
            background-color: #333;
            color: #fff;
            padding: 15px;
            text-align: center;
            position: relative;
        }
        header button {
            background-color: #f44336;
            color: white;
            padding: 10px 20px;
            border: none;
            cursor: pointer;
            position: absolute;
            left: 15px;
            top: 50%;
            transform: translateY(-50%);
        }
        header button:hover {
            background-color: #d32f2f;
        }
        h1 {
            margin: 20px 0;
        }
        table {
            width: 80%;
            border-collapse: collapse;
            margin: 20px 0;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 12px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>

<header>
    <button onclick="history.back()">Back</button>
    <h1>Registrations Limits</h1>
</header>

<table>
    <thead>
        <tr>
            <th>Event ID</th>
            <th>Event Name</th>
            <th>Current Registrations</th>
            <th>Registration Limit</th>
            <th>Registration Fee</th>
            <th>Verified Users</th>
            <th>Total Amount Collected</th>
        </tr>
    </thead>
    <tbody>
        <?php while($event_details=$data->fetch_assoc())
    {
        $amount = verified_count($event_details['event_id'], $conn)*$event_details['reg_fee'];

?>
        <tr>
            <td><?php echo($event_details['event_id']) ?></td>
            <td><?php echo($event_details['event_name']) ?></td>
            <td><?php echo($event_details['current_reg']) ?></td>
            <td><?php echo($event_details['reg_limit']) ?></td>
            <td><?php echo($event_details['reg_fee']) ?></td>
            <td><?php echo verified_count($event_details['event_id'], $conn); ?></td>
            <td><?php echo($amount) ?></td>
        </tr>
       <?php
          }
?>
        <!-- Add more rows as needed -->
    </tbody>
</table>

</body>
</html>

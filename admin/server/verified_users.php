<?php
session_start();
if(isset($_SESSION['user']) && $_SESSION['user'] === "coordinator") {
    $event_name = $_SESSION['event_name'];
    include('connect.php');

    // Group Events query
    $sel_grp_events = "SELECT * FROM group_event WHERE event_name='$event_name' AND status='verified' ORDER BY time";
    $pre_grp_events = $conn->query($sel_grp_events);

    // Individual Events query
    $sel_ind_events = "SELECT * FROM individual_events WHERE event_name='$event_name' AND status='verified' ORDER BY time";
    $pre_ind_events = $conn->query($sel_ind_events);

    mysqli_close($conn);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verified Registrations</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background: linear-gradient(135deg, #6e85b7, #b4c3ff);
            margin: 0;
            padding: 20px;
            color: #333;
        }

        h1, h2 {
            text-align: center;
            margin-bottom: 20px;
            color: white;
            text-shadow: 2px 2px 10px rgba(0, 0, 0, 0.3);
        }

        h1 {
            font-size: 2.5rem;
        }

        h2 {
            font-size: 1.8rem;
            margin-top: 40px;
        }

        .home-btn {
            display: block;
            margin: 0 auto 20px auto;
            padding: 12px 24px;
            font-size: 16px;
            color: white;
            background-color: #4CAF50;
            border: none;
            border-radius: 50px;
            cursor: pointer;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.3);
            transition: background 0.3s ease, transform 0.2s ease;
        }

        .home-btn:hover {
            background-color: #45a049;
            transform: translateY(-3px);
        }

        table {
            width: 100%;
            max-width: 1200px;
            margin: 20px auto;
            border-collapse: collapse;
            background-color: white;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
        }

        th, td {
            padding: 15px;
            text-align: left;
        }

        th {
            background-color: #6e85b7;
            color: white;
            font-size: 1.1rem;
            text-transform: uppercase;
        }

        td {
            font-size: 1rem;
            color: #333;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        tr:hover {
            background-color: #d1d9ff;
            transition: background 0.3s ease;
        }

        .action-btn {
            padding: 8px 16px;
            font-size: 14px;
            color: white;
            background-color: #dc3545;
            border: none;
            border-radius: 50px;
            cursor: pointer;
            transition: background 0.3s ease, transform 0.2s ease;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
        }

        .action-btn:hover {
            background-color: #c82333;
            transform: translateY(-3px);
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            table, th, td {
                font-size: 0.9rem;
            }

            .home-btn {
                width: 100%;
                padding: 14px 0;
            }
        }
    </style>
</head>
<body>

    <h1>Verified Registrations</h1>
    <button class="home-btn" onclick="window.location.href='/admin/coordinator.php';">Go to Home</button>

    <!-- Group Events Table -->
    <h2>Group Events</h2>
    <table>
        <tr>
            <th>College Name</th>
            <th>Department Name</th>
            <th>Team Name</th>
            <th>Captain Name</th>
            <th>Team Members</th>
            <th>Phone Number</th>
            <th>Email ID</th>
            <th>Alternate Phone Number</th>
            <th>Event Name</th>
            <th>Transaction ID</th>
            <th>Status</th>
            
        </tr>
        <!-- Fetching and displaying group events data -->
        <?php while($grp_events = $pre_grp_events->fetch_assoc()) { ?>
        <tr>
            <td><?php echo($grp_events['clg_name']); ?></td>
            <td><?php echo($grp_events['dept_name']); ?></td>
            <td><?php echo($grp_events['team_name']); ?></td>
            <td><?php echo($grp_events['captain_name']); ?></td>
            <td><?php echo($grp_events['team_members']); ?></td>
            <td><?php echo($grp_events['phone']); ?></td>
            <td><?php echo($grp_events['mail']); ?></td>
            <td><?php echo($grp_events['alt_phone']); ?></td>
            <td><?php echo($grp_events['event_name']); ?></td>
            <td><?php echo($grp_events['transaction_id']); ?></td>
            <td><?php echo($grp_events['status']); ?></td>
            
        </tr>
        <?php } ?>
    </table>

    <!-- Individual Events Table -->
    <h2>Individual Events</h2>
    <table>
        <tr>
            <th>Name</th>
            <th>College Name</th>
            <th>Department Name</th>
            <th>Email ID</th>
            <th>Phone Number</th>
            <th>Transaction ID</th>
            <th>Event Name</th>
            <th>Status</th>
        </tr>
        <!-- Fetching and displaying individual events data -->
        <?php while($ind_events = $pre_ind_events->fetch_assoc()) { ?>
        <tr>
            <td><?php echo($ind_events['name']); ?></td>
            <td><?php echo($ind_events['clg_name']); ?></td>
            <td><?php echo($ind_events['dept_name']); ?></td>
            <td><?php echo($ind_events['mail']); ?></td>
            <td><?php echo($ind_events['phone']); ?></td>
            <td><?php echo($ind_events['transaction_id']); ?></td>
            <td><?php echo($ind_events['event_name']); ?></td>
            <td><?php echo($ind_events['status']); ?></td>
            
        </tr>
        <?php } ?>
    </table>

</body>
</html>

<?php
} else {
    //header("Location: restricted.php");
    echo "<script>window.location.href='restricted.php';</script>";
    exit();
}
?>

<?php
session_start();

// Set Content Security Policy to prevent execution of any scripts
//header("Content-Security-Policy: script-src 'none';");

// Check if the user is logged in and is a super user
if (isset($_SESSION['user']) && $_SESSION['user'] === "super_user") {
    // Reinforce the session variable
    $_SESSION['user'] = "super_user";
    
    // Include the database connection
    include('server/connect.php');

    // SQL queries to select group and individual events, ordered by time
    $sel_grp_events = "SELECT * FROM group_event ORDER BY time";
    $sel_ind_events = "SELECT * FROM individual_events ORDER BY time";

    // Execute the queries
    $pre_grp_events = $conn->query($sel_grp_events);
    $pre_ind_events = $conn->query($sel_ind_events);
    
    // Check for query execution errors
    if (!$pre_grp_events || !$pre_ind_events) {
        // Log the error message and display a user-friendly message
        error_log("Database Query Error: " . $conn->error);
        die("An error occurred while fetching event data. Please try again later.");
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Page</title>
    <style>
        /* Existing CSS Styles */
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        header {
            background-color: #333;
            padding: 15px;
            text-align: center;
        }

        header button {
            margin: 0 10px;
            padding: 10px 20px;
            background-color: #4CAF50;
            border: none;
            color: white;
            cursor: pointer;
            border-radius: 5px;
            font-size: 16px;
            transition: background-color 0.3s ease, transform 0.3s ease;
        }

        header button:hover {
            background-color: #45a049;
            transform: scale(1.05);
        }

        h1, h2 {
            text-align: center;
            margin-top: 20px;
        }

        table {
            width: 80%;
            margin: 20px auto;
            border-collapse: collapse;
            background-color: white;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        table, th, td {
            border: 1px solid #ddd;
            padding: 12px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
            font-size: 16px;
        }

        td {
            font-size: 14px;
        }

        tr:hover {
            background-color: #f5f5f5;
        }

        .btn {
            padding: 10px 15px;
            border: none;
            border-radius: 5px;
            font-size: 14px;
            cursor: pointer;
            transition: background-color 0.3s ease, transform 0.3s ease;
        }

        .btn-verify {
            background-color: #4CAF50; /* Green */
            color: white;
        }

        .btn-verify:hover {
            background-color: #45a049;
            transform: scale(1.05);
        }

        .btn-reject {
            background-color: #f44336; /* Red */
            color: white;
        }

        .btn-reject:hover {
            background-color: #e53935;
            transform: scale(1.05);
        }

        .btn-pending {
            background-color: orange; /* Orange */
            color: white;
        }

        .btn-pending:hover {
            background-color: darkorange;
            transform: scale(1.05);
        }
    </style>
</head>
<body>

    <!-- Header with Buttons -->
    <header>
        <button onclick="location.href='server/event_dashboard.php'">View Registrations Limits</button>
        <button onclick="location.href='create_user.php'">Add New User</button>
        <!--<button onclick="location.href='event_reg.php'">Add New Event</button>-->
        <button onclick="location.href='server/event_list.php'">My Events</button>
        <button onclick="location.href='server/users_list.php'">Manage Users</button>
        <button onclick="location.href='/index.html'">Logout</button>
    </header>

    <!-- Group Events Section -->
    <h1>Admin Dashboard</h1>
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
            <th>Action</th>
        </tr>

        <!-- Group Events Rows -->
        <?php while ($grp_events = $pre_grp_events->fetch_assoc()) { ?>
        <tr>
            <td><?php echo htmlspecialchars($grp_events['clg_name'], ENT_QUOTES, 'UTF-8'); ?></td>
            <td><?php echo htmlspecialchars($grp_events['dept_name'], ENT_QUOTES, 'UTF-8'); ?></td>
            <td><?php echo htmlspecialchars($grp_events['team_name'], ENT_QUOTES, 'UTF-8'); ?></td>
            <td><?php echo htmlspecialchars($grp_events['captain_name'], ENT_QUOTES, 'UTF-8'); ?></td>
            <td><?php echo htmlspecialchars($grp_events['team_members'], ENT_QUOTES, 'UTF-8'); ?></td>
            <td><?php echo htmlspecialchars($grp_events['phone'], ENT_QUOTES, 'UTF-8'); ?></td>
            <td><?php echo htmlspecialchars($grp_events['mail'], ENT_QUOTES, 'UTF-8'); ?></td>
            <td><?php echo htmlspecialchars($grp_events['alt_phone'], ENT_QUOTES, 'UTF-8'); ?></td>
            <td><?php echo htmlspecialchars($grp_events['event_name'], ENT_QUOTES, 'UTF-8'); ?></td>
            <td><?php echo htmlspecialchars($grp_events['transaction_id'], ENT_QUOTES, 'UTF-8'); ?></td>
            <td><?php echo htmlspecialchars($grp_events['status'], ENT_QUOTES, 'UTF-8'); ?></td>
            <td>
                <?php
                   if ($grp_events['status'] === 'pending') {
                ?>
                <a href="server/grp_event_verify.php?id=<?php echo urlencode($grp_events['reg_id']); ?>" style="text-decoration: none;">
                    <button class="btn btn-verify">Verify</button>
                </a>
                <?php } else { ?>
                <a href="server/grp_event_to_pending.php?id=<?php echo urlencode($grp_events['reg_id']); ?>" style="text-decoration: none;">
                    <button class="btn btn-pending">To Pending</button>
                </a>
                <?php } ?>
                <a href="server/grp_event_reject.php?id=<?php echo urlencode($grp_events['reg_id']); ?>" style="text-decoration: none;">
                    <button class="btn btn-reject">Reject</button>
                </a>
            </td>
        </tr>
        <?php } ?>
    </table>

    <!-- Individual Events Section -->
    <h2>Individual Events</h2>
    <table>
        <tr> 
            <th>Name</th>
            <th>College Name</th>
            <th>Department Name</th>
            <th>Mail</th>
            <th>Phone Number</th>
            <th>Transaction ID</th>
            <th>Event Name</th>
            <th>Status</th>
            <th>Action</th>
        </tr>
        <?php while ($ind_events = $pre_ind_events->fetch_assoc()) { ?>
        <tr>
            <td><?php echo htmlspecialchars($ind_events['name'], ENT_QUOTES, 'UTF-8'); ?></td>
            <td><?php echo htmlspecialchars($ind_events['clg_name'], ENT_QUOTES, 'UTF-8'); ?></td>
            <td><?php echo htmlspecialchars($ind_events['dept_name'], ENT_QUOTES, 'UTF-8'); ?></td>
            <td><?php echo htmlspecialchars($ind_events['mail'], ENT_QUOTES, 'UTF-8'); ?></td>
            <td><?php echo htmlspecialchars($ind_events['phone'], ENT_QUOTES, 'UTF-8'); ?></td>
            <td><?php echo htmlspecialchars($ind_events['transaction_id'], ENT_QUOTES, 'UTF-8'); ?></td>
            <td><?php echo htmlspecialchars($ind_events['event_name'], ENT_QUOTES, 'UTF-8'); ?></td>
            <td><?php echo htmlspecialchars($ind_events['status'], ENT_QUOTES, 'UTF-8'); ?></td>
            <td>
                <?php
                  if ($ind_events['status'] === 'pending') {
                ?>
                <a href="server/ind_event_verify.php?id=<?php echo urlencode($ind_events['reg_id']); ?>" style="text-decoration: none;">
                    <button class="btn btn-verify">Verify</button> 
                </a>
                <?php } else { ?>
                <a href="server/ind_event_to_pending.php?id=<?php echo urlencode($ind_events['reg_id']); ?>" style="text-decoration: none;">
                    <button class="btn btn-pending">To Pending</button>
                </a>
                <?php } ?>
                <a href="server/ind_event_reject.php?id=<?php echo urlencode($ind_events['reg_id']); ?>" style="text-decoration: none;">
                    <button class="btn btn-reject">Reject</button>
                </a>
            </td>
        </tr>
        <?php } ?>
    </table>

</body>
</html>
<?php
} else {
    // Redirect to a restricted access page if user is not a super user
    header("Location: server/restricted.php");
    exit();
}
?>

<?php
session_start();

// Set Content Security Policy to prevent execution of any scripts
//header("Content-Security-Policy: script-src 'none';");

// Check if the user is logged in and has the role of "coordinator"
if (isset($_SESSION['user']) && $_SESSION['user'] === "coordinator") {
    // Retrieve the event name from the session
    if (!isset($_SESSION['event_name'])) {
        // If event_name is not set in the session, redirect to an appropriate page
        header("Location: server/restricted.php");
        exit();
    }

    $event_name = $_SESSION['event_name'];

    // Include the database connection
    include('server/connect.php');

    // **Security Enhancement:** Use prepared statements to prevent SQL injection
    // Prepare the SQL query for group events
    $sel_grp_events = $conn->prepare("SELECT * FROM group_event WHERE event_name = ? AND status != 'deleted' ORDER BY time");
    $sel_grp_events->bind_param("s", $event_name);
    $sel_grp_events->execute();
    $pre_grp_events = $sel_grp_events->get_result();

    // Prepare the SQL query for individual events
    $sel_ind_events = $conn->prepare("SELECT * FROM individual_events WHERE event_name = ? AND status != 'deleted' ORDER BY time");
    $sel_ind_events->bind_param("s", $event_name);
    $sel_ind_events->execute();
    $pre_ind_events = $sel_ind_events->get_result();

    // Check for query execution errors
    if (!$pre_grp_events || !$pre_ind_events) {
        // Log the error message for debugging
        error_log("Database Query Error: " . $conn->error);
        die("An error occurred while fetching event data. Please try again later.");
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Coordinator Page</title>
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
        <button onclick="location.href='server/verified_users.php'">Verified Registrations</button>
        <button onclick="location.href='server/parti_dashboard.php'">Registrations Limit</button>
        <button onclick="location.href='server/delete_participant.php'">Delete Registrations</button>
        <button onclick="location.href='/index.html'">Logout</button>
    </header>

    <!-- Coordinator Dashboard -->
    <h1>Coordinator Dashboard</h1>

    <!-- Group Events Section -->
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
    // Redirect to a restricted access page if user is not a coordinator
    header("Location: server/restricted.php");
    exit();
}
?>

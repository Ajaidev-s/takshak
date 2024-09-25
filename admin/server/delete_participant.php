<?php

session_start();
$hostname = "testing123ajai-server.mysql.database.azure.com";
$username = "dglktgierk";
$password = 'EzVMnQnSNI$kJwT3'; // Ensure the password is correct
$database = "thakshak"; // Ensure this matches the database name

// Initialize MySQLi
$conn = mysqli_init();

// Connect to the MySQL server
if (!mysqli_real_connect($conn, $hostname, $username, $password, $database, 3306)) {
    die("Connection failed: " . mysqli_connect_error());
}



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
    

    // **Security Enhancement:** Use prepared statements to prevent SQL injection

    // Prepare the SQL query for group events
    $sel_grp_events = $conn->prepare("SELECT * FROM group_event WHERE event_name = ? AND status != 'deleted' ORDER BY time");
    if ($sel_grp_events === false) {
        error_log("Prepare failed: (" . $conn->errno . ") " . $conn->error);
        die("An error occurred while preparing the group events query.");
    }
    $sel_grp_events->bind_param("s", $event_name);
    $sel_grp_events->execute();
    $pre_grp_events = $sel_grp_events->get_result();

    // Prepare the SQL query for individual events
    $sel_ind_events = $conn->prepare("SELECT * FROM individual_events WHERE event_name = ? AND status != 'deleted' ORDER BY time");
    if ($sel_ind_events === false) {
        error_log("Prepare failed: (" . $conn->errno . ") " . $conn->error);
        die("An error occurred while preparing the individual events query.");
    }
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
    <title>Delete Registrations</title>
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
            background-color: #dc3545; /* Red */
            border: none;
            border-radius: 50px;
            cursor: pointer;
            transition: background 0.3s ease, transform 0.2s ease;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
            text-decoration: none;
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

    <h1>Delete Registrations</h1>
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
                <a href="grp_event_delete.php?id=<?php echo urlencode($grp_events['reg_id']); ?>" class="action-btn">Delete</a>
            </td>
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
            <th>Action</th>
        </tr>
        <!-- Individual Events Rows -->
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
                <a href="ind_event_delete.php?id=<?php echo urlencode($ind_events['reg_id']); ?>" class="action-btn">Delete</a>
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

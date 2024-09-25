<?php
session_start();
if(isset($_SESSION['user']) && $_SESSION['user'] === "super_user")
    {
include('connect.php');
$sel="SELECT * from event_details";
$data=$conn->query($sel);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Events</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f9f9f9;
            color: #333;
            padding: 30px;
            margin: 0;
        }

        h2 {
            text-align: center;
            color: #2c3e50;
            margin-bottom: 30px;
            font-size: 28px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 30px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            border-radius: 8px;
        }

        th, td {
            padding: 15px;
            text-align: center;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #2c3e50;
            color: white;
            text-transform: uppercase;
        }

        tr {
            transition: background-color 0.2s ease-in-out;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        tr:hover {
            background-color: #dcdde1;
        }

        td {
            font-size: 14px;
        }

        .delete-btn, .update-btn {
            padding: 8px 15px;
            border: none;
            cursor: pointer;
            border-radius: 4px;
            font-size: 14px;
            transition: background-color 0.3s ease-in-out;
        }

        .delete-btn {
            background-color: #e74c3c;
            color: white;
        }

        .delete-btn:hover {
            background-color: #c0392b;
        }

        .update-btn {
            background-color: #3498db;
            color: white;
            margin-right: 10px;
        }

        .update-btn:hover {
            background-color: #2980b9;
        }

        .delete-btn:focus, .update-btn:focus {
            outline: none;
        }

        /* Responsive design for mobile */
        @media (max-width: 768px) {
            table {
                font-size: 12px;
            }

            th, td {
                padding: 10px;
            }

            .delete-btn, .update-btn {
                padding: 6px 12px;
                font-size: 12px;
            }
        }
    </style>
</head>
<body>

    <h2>Manage Events</h2>

    <table>
        <thead>
            <tr>
                <th>Event ID</th>
                <th>Event Name</th>
                <th>Coordinator Name</th>
                <th>Coordinator Phone</th>
                <th>Sub-coordinator Name</th>
                <th>Sub-coordinator Phone</th>
                <th>Registration Limit</th>
                <th>Group Strength</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <!-- Example row, replace this with PHP/JS to dynamically fetch event details -->
             <?php
                   while($event_details=$data->fetch_assoc())
                   {
             ?>
            <tr>
                <td><?php echo($event_details['event_id'])?></td>
                <td><?php echo($event_details['event_name'])?></td>
                <td><?php echo($event_details['cod_name'])?></td>
                <td><?php echo($event_details['cod_phn'])?></td>
                <td><?php echo($event_details['subcod_name'])?></td>
                <td><?php echo($event_details['subcod_phn'])?></td>
                <td><?php echo($event_details['participants'])?></td>
                <td><?php echo($event_details['grp_strenght'])?></td>
                <td>
                    <button class="update-btn" >Update</button>
                    <a href="delete_event.php?id=<?php echo $event_details['event_id'];?>" style="text-decoration: none;">
                    <button class="delete-btn" >Delete</button></a>
                </td>
            </tr>
            <?php } ?>
            
        </tbody>
    </table>

    
</body>
</html>
<?php }
else{
    header("Location:restricted.php");
 }
?>
<?php session_start();
if(isset($_SESSION['user']) && $_SESSION['user'] === "super_user")
    {
        ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create User</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #6a1b9a, #ab47bc);
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .create-user-container {
            background-color: #fff;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 400px;
            text-align: center;
        }

        h2 {
            margin-bottom: 20px;
            color: #333;
            font-size: 24px;
        }

        .input-group {
            margin-bottom: 15px;
            text-align: left;
        }

        .input-group label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
            color: #555;
        }

        .input-group input {
            width: calc(100% - 20px);
            padding: 12px;
            border: 1px solid #ddd;
            border-radius: 8px;
            font-size: 16px;
        }

        button {
            width: 100%;
            padding: 12px;
            background-color: #6a1b9a;
            color: #fff;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-size: 18px;
            transition: background-color 0.3s;
        }

        button:hover {
            background-color: #4a148c;
        }
    </style>
</head>
<body>
    <div class="create-user-container">
        <h2>Create User</h2>
        <form action="server/create_user_submit.php" method="post">
            <div class="input-group">
                <label for="username">Username:</label>
                <input type="text" id="username" name="username" required>
            </div>
            <div class="input-group">
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required>
            </div>
            <div class="input-group">
                <label for="eventname">Event Name:</label>
                <input type="text" id="eventname" name="eventname" required>
            </div>
            <div class="input-group">
                <label for="eventid">Event ID:</label>
                <input type="text" id="eventid" name="eventid" required>
            </div>
            <button type="submit" name="btn1">Create User</button>
        </form>
    </div>
</body>
</html>
<?php
    }
    else{
          header("Location:server/restricted.php");
    }
?>
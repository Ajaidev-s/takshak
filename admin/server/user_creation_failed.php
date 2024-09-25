<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Creation Failed</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f0f0f0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .message-box {
            background-color: #fff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
            text-align: center;
            max-width: 400px;
            width: 100%;
        }

        h2 {
            color: #e74c3c;
            margin-bottom: 15px;
            font-size: 24px;
        }

        p {
            font-size: 16px;
            color: #555;
            margin-bottom: 20px;
        }

        .btn {
            display: inline-block;
            padding: 10px 20px;
            background-color: #3498db;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }

        .btn:hover {
            background-color: #2980b9;
        }

        .icon {
            font-size: 40px;
            color: #e74c3c;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>

    <div class="message-box">
        <div class="icon">❌</div>
        <h2>User Creation Failed</h2>
        <p>It seems the username is already taken. Please use a unique username.</p>
        <a href="/takshak/admin/create_user.php" class="btn">Go Back to Registration</a>
    </div>

</body>
</html>

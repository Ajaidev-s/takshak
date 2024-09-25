<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #4a90e2, #50e3c2);
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .login-container {
            background-color: #fff;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 350px;
            text-align: center;
        }

        h2 {
            margin-bottom: 20px;
            color: #333;
            font-size: 24px;
        }

        .input-group {
            margin-bottom: 20px;
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
            background-color: #4a90e2;
            color: #fff;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-size: 18px;
            transition: background-color 0.3s;
        }

        button:hover {
            background-color: #357abd;
        }

        .forgot-password {
            margin-top: 15px;
            font-size: 14px;
            color: #4a90e2;
        }

        .forgot-password a {
            text-decoration: none;
            color: inherit;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <h2>Login</h2>
        <form action="server/login_process.php" method="post">
            <div class="input-group">
                <label for="username">Username:</label>
                <input type="text" id="username" name="username" required>
            </div>
            <div class="input-group">
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required>
            </div>
            <button type="submit">Login</button>
            <div class="forgot-password">
                <a href="#">Forgot Password?</a>
            </div>
        </form>
    </div>
</body>
</html>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Success</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f8ff;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .container {
            text-align: center;
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        h1 {
            color: #4CAF50;
            font-size: 24px;
            margin-bottom: 20px;
        }
        p {
            font-size: 18px;
            color: #333;
        }
        .loader {
            border: 8px solid #f3f3f3;
            border-radius: 50%;
            border-top: 8px solid #4CAF50;
            width: 60px;
            height: 60px;
            animation: spin 2s linear infinite;
            margin: 20px auto;
        }
        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Registration Successful!</h1>
        <p>Thank you for registering. Please wait until the coordinators contact you.<br>You will be redirected in 3 seconds...</p>
        <div class="loader"></div>
    </div>
</body>
</html>
<?php
//header("Refresh: 3; url=/index.html");
 echo "<script>
        setTimeout(function() {
            window.location.href = '/check.php';
        }, 3000);
    </script>";
?>

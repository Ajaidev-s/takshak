<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invalid Credentials</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: 'Arial', sans-serif;
            background-color: #f4f4f9;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .container {
            background-color: white;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            text-align: center;
        }
        h1 {
            color: #d9534f;
            font-size: 2rem;
            margin-bottom: 20px;
        }
        p {
            color: #333;
            font-size: 1.2rem;
            margin-bottom: 30px;
        }
        .contact-btn {
            padding: 10px 20px;
            font-size: 1rem;
            color: white;
            background-color: #5bc0de;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }
        .contact-btn:hover {
            background-color: #31b0d5;
        }
    </style>
</head>
<body>

    <div class="container">
        <h1>Invalid Credentials</h1>
        <p>It looks like the credentials you entered are incorrect.<br>
           Please contact the site administrator for assistance.</p>
        <button class="contact-btn" onclick="window.location.href='mailto:ajaidev5194@gmail.com';">Contact Admin</button>
    </div>

</body>
</html>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Event Registration Success</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f0f8f0; /* Light green background */
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .success-container {
            text-align: center;
            background-color: #d4edda;
            border: 2px solid #c3e6cb;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            animation: fadeIn 1.5s ease-in-out;
        }

        .success-container h1 {
            color: #155724; /* Dark green for text */
        }

        .success-container p {
            color: #155724;
        }

        @keyframes fadeIn {
            0% { opacity: 0; transform: scale(0.8); }
            100% { opacity: 1; transform: scale(1); }
        }
    </style>
</head>
<body>
    <div class="success-container">
        <h1>Registration Successful!</h1>
        <p>Your registration has been completed successfully.</p>
    </div>

    <script>
        setTimeout(function() {
            window.location.href = '/admin/event_reg.php'; // Change 'next-page.php' to the desired redirect page
        }, 3000); // 1.5 second delay before redirect
    </script>
</body>
</html>

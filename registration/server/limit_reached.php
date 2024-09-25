<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Limit Reached</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .container {
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .alert-custom {
            background-color: #f8d7da;
            color: #721c24;
            border-color: #f5c6cb;
        }
        .alert-custom .alert-heading {
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="alert alert-custom text-center">
            <h4 class="alert-heading">Registration Limit Reached</h4>
            <p class="mb-0">We're sorry, but the registration limit for this event has been reached. Please try again later or contact the event organizer for more information.</p>
        </div>
    </div>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
<?php
echo "<script>
        setTimeout(function() {
            window.location.href = '/index.html';
        }, 3000);
    </script>";
?>

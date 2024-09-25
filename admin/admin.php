
<!DOCTYPE html>
<html class="no-js" lang="zxx">
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Access Denied</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <style>
        body {
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background: linear-gradient(135deg, #ff7e5f, #feb47b);
            font-family: 'Poppins', sans-serif;
        }

        .container {
            text-align: center;
            background: rgba(255, 255, 255, 0.15); /* Transparent effect */
            padding: 40px;
            border-radius: 15px;
            box-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.37);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.18);
            animation: fadeIn 1.5s ease;
        }

        h1 {
            font-size: 60px;
            color: #ffffff;
            margin-bottom: 20px;
        }

        p {
            font-size: 20px;
            color: #ffffff;
            margin-bottom: 30px;
        }

        .warning-icon {
            font-size: 100px;
            color: #ff4f4f;
            margin-bottom: 20px;
            animation: bounce 2s infinite;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
            }
            to {
                opacity: 1;
            }
        }

        @keyframes bounce {
            0%, 20%, 50%, 80%, 100% {
                transform: translateY(0);
            }
            40% {
                transform: translateY(-20px);
            }
            60% {
                transform: translateY(-10px);
            }
        }
    </style>
</head>

<body>

<div class="container">
    <div class="warning-icon">🚫</div>
    <h1>Oops!</h1>
    <p>Don't be oversmart, you don't have access to this page.</p>
    <a href="../../index.html"><h4>Go back Kido !</h4></a>
</div>
</body>
</html>

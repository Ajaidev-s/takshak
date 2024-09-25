<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Failed</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #e0eafc, #cfdef3);
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .container {
            text-align: center;
            background-color: #fff;
            padding: 40px;
            border-radius: 15px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
            animation: fadeIn 1s ease-in-out;
        }
        h1 {
            color: #f44336;
            font-size: 28px;
            margin-bottom: 20px;
            animation: slideInDown 0.6s ease;
        }
        p {
            font-size: 18px;
            color: #333;
            margin-bottom: 20px;
            animation: fadeIn 1.5s ease-in-out;
        }
        .contact {
            margin-top: 20px;
            font-size: 16px;
            color: #555;
            animation: fadeInUp 1.2s ease;
        }
        .contact span {
            font-weight: bold;
            color: #000;
        }
        /* Animation Keyframes */
        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }
        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        @keyframes slideInDown {
            from { opacity: 0; transform: translateY(-20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .contact-details {
            margin-top: 30px;
            display: flex;
            justify-content: space-around;
        }
        .contact-card {
            background-color: #f9f9f9;
            padding: 15px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        .contact-card:hover {
            transform: scale(1.05);
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
        }
        .contact-card h2 {
            color: #f44336;
            font-size: 20px;
            margin-bottom: 10px;
        }
        .contact-card p {
            margin: 0;
            color: #333;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Registration Failed</h1>
        <p>We are sorry, but your registration could not be completed.</p>
        <p>Please contact the coordinator or site administrator for assistance.</p>
        
        <div class="contact-details">
            <h2>Site Administrator</h2><br>
            <div class="contact-card">
                <p>Name: <span>Akhil Rock Babu</span></p>
                <p>Phone: <span>+91 8111896096</span></p>
            </div>
            
            <div class="contact-card">
                <p>Name: <span>Ajaidev S</span></p>
                <p>Phone: <span>+91 8138892815</span></p>
            </div>
        </div>
    </div>
</body>
</html>

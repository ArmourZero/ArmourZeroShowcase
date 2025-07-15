<!DOCTYPE html>
<html>
<head>
    <title>ArmourZero’s Automated Vulnerability Management (AVM) platform</title>
    <link rel="shortcut icon" href="Resources/hmbct.png" />
    <link rel="stylesheet" href="Resources/button.css">
    <style>
        body {
            font-family: 'Inter', Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
            animation: fadeIn 0.5s ease-in;
        }
        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }
        .header {
            background: linear-gradient(180deg, #757575, #656565);
            padding: 20px;
            text-align: center;
            border-radius: 80px 80px 0 0;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.15);
        }
        .header h1 {
            font-size: 28px;
            color: #fff;
            margin: 0;
            font-weight: 600;
            letter-spacing: 0.5px;
        }
        .main-container {
            background-color: #d9d9d9;
            padding: 40px;
            margin: 0 auto;
            width: 80%;
            max-width: 600px;
            text-align: center;
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            margin-bottom: 20px;
        }
        .main-container h2 {
            font-size: 22px;
            color: #333;
            margin-bottom: 15px;
            font-weight: 500;
        }
        .main-container p {
            font-size: 16px;
            color: #333;
            margin-bottom: 20px;
            line-height: 1.5;
        }
        .main-container form {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 15px;
        }
        .main-container input[type="text"] {
            padding: 12px;
            font-size: 16px;
            border: 2px solid #757575;
            border-radius: 6px;
            width: 80%;
            max-width: 400px;
            box-sizing: border-box;
            transition: border-color 0.3s;
        }
        .main-container input[type="text"]:focus {
            border-color: #555;
            outline: none;
        }
        .main-container input[type="submit"] {
            padding: 12px 24px;
            font-size: 16px;
            background-color: #757575;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            color: white;
            transition: background-color 0.3s, transform 0.2s;
        }
        .main-container input[type="submit"]:hover {
            background-color: #656565;
            transform: translateY(-2px);
        }
        .footer {
            background-color: #afafaf;
            padding: 20px;
            text-align: center;
            border-radius: 0 0 80px 80px;
            box-shadow: 0 -4px 8px rgba(0, 0, 0, 0.15);
        }
        .footer button {
            padding: 12px 24px;
            font-size: 16px;
            background-color: #fff;
            border: 2px solid #757575;
            border-radius: 6px;
            cursor: pointer;
            color: #757575;
            font-weight: 500;
            transition: background-color 0.3s, color 0.3s, transform 0.2s;
        }
        .footer button:hover {
            background-color: #757575;
            color: #fff;
            transform: translateY(-2px);
        }
        @media (max-width: 600px) {
            .header h1 {
                font-size: 22px;
            }
            .main-container {
                width: 90%;
                padding: 20px;
            }
            .main-container h2 {
                font-size: 18px;
            }
            .main-container p {
                font-size: 14px;
            }
            .main-container input[type="text"] {
                width: 90%;
            }
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>ArmourZero’s Automated Vulnerability Management (AVM) platform</h1>
    </div>
    <div class="main-container">
        <h2>Securr Website After Using ArmourZero's AVM</h2>
        <p>Vulnerabilities are resolved on this website using ArmourZero’s AVM platform.</p>
       
    </div>
    <div class="footer">
        <button type="button" name="homepagebutton" onclick="location.href='homepage.html'">Explore Now</button>
    </div>
</body>
</html>
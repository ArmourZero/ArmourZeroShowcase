
<!DOCTYPE html>
<html> 
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../Resources/hmbct.png" />
    <title>SCA Vulnerability</title>
    <script src="https://code.jquery.com/jquery-1.4.2.min.js"></script>
    <style>
        body {
            font-family: 'Inter', Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #ffffff;
            animation: fadeIn 0.5s ease-in;
        }
        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }
        .header {
            background: linear-gradient(180deg, #FF6962, #E55A54);
            padding: 20px;
            text-align: center;
            width: 100%;
            border-radius: 20px 20px 0 0;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.15);
        }
        .header-content {
            max-width: 600px;
            margin: 0 auto;
        }
        .header button {
            padding: 12px 24px;
            font-size: 16px;
            background-color: #fff;
            border: 2px solid #fff;
            border-radius: 6px;
            cursor: pointer;
            color: #FF6962;
            font-weight: 500;
            transition: background-color 0.3s, color 0.3s, transform 0.2s;
        }
        .header button:hover {
            background-color: #FF6962;
            color: #fff;
            transform: translateY(-2px);
        }
        .main-container {
            background-color: #FFB6B3;
            padding: 30px 0;
            width: 100%;
        }
        .main-content {
            max-width: 600px;
            margin: 0 auto;
            text-align: center;
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.1);
            padding: 20px;
        }
        .main-content h1 {
            font-size: 24px;
            color: #333;
            margin-bottom: 20px;
            font-weight: 600;
        }
        .main-content p {
            font-size: 16px;
            color: #333;
            margin-bottom: 20px;
            line-height: 1.5;
        }
        .main-content .exploit-example {
            font-style: italic;
        }
        .main-content form {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 15px;
        }
        .main-content label {
            font-size: 18px;
            color: #333;
            font-weight: 500;
        }
        .main-content input[type="text"] {
            padding: 12px;
            font-size: 16px;
            border: 2px solid #FF6962;
            border-radius: 6px;
            width: 80%;
            max-width: 400px;
            box-sizing: border-box;
            transition: border-color 0.3s;
        }
        .main-content input[type="text"]:focus {
            border-color: #E55A54;
            outline: none;
        }
        .main-content input[type="submit"] {
            padding: 12px 24px;
            font-size: 16px;
            background-color: #FF6962;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            color: white;
            transition: background-color 0.3s, transform 0.2s;
        }
        .main-content input[type="submit"]:hover {
            background-color: #E55A54;
            transform: translateY(-2px);
        }
        .output-container {
            background-color: #ecf2d0;
            padding: 20px 0;
            width: 100%;
            border-radius: 0 0 20px 20px;
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.1);
        }
        .output-content {
            max-width: 600px;
            margin: 0 auto;
            text-align: center;
            padding: 20px;
            font-size: 16px;
            color: #333;
        }
        @media (max-width: 600px) {
            .main-content h1 {
                font-size: 20px;
            }
            .main-content {
                padding: 15px;
            }
            .main-content p, .main-content label, .output-content {
                font-size: 14px;
            }
            .main-content input[type="text"] {
                width: 90%;
            }
        }
    </style>
</head>
<body>
    <div class="header">
        <div class="header-content">
            <button type="button" name="homeButton" onclick="location.href='../homepage.html';">Home Page</button>
        </div>
    </div>
    <div class="main-container">
        <div class="main-content">
            <h1>SCA Vulnerability</h1>
            <p class="exploit-example">
                This webpage includes the use of an outdated jQuery library (1.4.2), which has known XSS vulnerabilities (e.g., CVE-2011-4969).
            </p>
          
        </div>
    </div>
    
    <script>
        // Simple jQuery usage to demonstrate library inclusion
        $(document).ready(function() {
            $("input[name='feature']").on("input", function() {
                console.log("Feature input changed: " + $(this).val());
            });
        });
    </script>
</body>
</html>

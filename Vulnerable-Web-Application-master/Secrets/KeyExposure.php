<?php
// Process PHP logic before any output
$output = "";
$exploit_example = "private_key";
$safe_exploit_example = htmlspecialchars($exploit_example, ENT_QUOTES, 'UTF-8');

if (isset($_GET["key"])) {
    if (!empty($_GET["key"])) {
        $key = $_GET["key"];
        if ($key === "private_key") {
            // Vulnerable: Expose a hardcoded private key
            $output = "Private Key Exposed: -----BEGIN RSA PRIVATE KEY-----\nMIICXQIBAAKBgQCqGKukO1De7zhZj6+H0qtjTkVxwTCpvKe4eCZ0FPqri0cb2JZfXJ/DgYSF6vUp\nwmJG8wVQZKjeGcjDOL5UlsuusFncCzWBQ7RKNUSesmQRMSGkVb1/3j+skZ6UtW+5u09lHNsj6tQ51s1SPrCBkedbNf0Tp0GbMJDyR4e9T04ZZwIDAQAB\n-----END RSA PRIVATE KEY-----";
        } else {
            // Vulnerable: Output unsanitized input (potential for secondary XSS)
            $output = "Key identifier: " . $key;
        }
    } else {
        $output = "Please enter a key identifier.";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../Resources/hmbct.png" />
    <title>Private Key Exposure</title>
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
        .output-content pre {
            text-align: left;
            background-color: #f9f9f9;
            padding: 10px;
            border-radius: 6px;
            overflow-x: auto;
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
            <h1>Private Key Exposure Vulnerability</h1>
            <p class="exploit-example">
                <b>Exploit Example:</b> <?php echo $safe_exploit_example; ?><br>
                When the attacker submits the key identifier "private_key", the server responds with the private key, exposing sensitive cryptographic data.
            </p>
            <form method="GET" action="" name="form">
                <label>Key Identifier:</label>
                <input type="text" name="key">
                <input type="submit" name="submit" value="Submit">
            </form>
        </div>
    </div>
    <div class="output-container">
        <div class="output-content">
            <?php echo $output; ?>
        </div>
    </div>
</body>
</html>
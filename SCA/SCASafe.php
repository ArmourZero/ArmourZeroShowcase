<?php
// Process PHP logic before any output
$output = "";
$status_code = 200; // Default status code

// Whitelist of allowed feature names
$allowed_features = ['Feature1', 'Feature2', 'Feature3'];

if (isset($_GET["feature"]) && !empty($_GET["feature"])) {
    $feature = $_GET["feature"];
    // Strict validation: only allow predefined values
    if (in_array($feature, $allowed_features, true)) {
        $output = "Selected feature: " . htmlspecialchars($feature, ENT_QUOTES, 'UTF-8');
        if ($feature === "Feature1") {
            $output .= "<br>Welldone! You selected the first feature.";
        }
    } else {
        $status_code = 400;
        $output = "Invalid input. Please select a valid feature name.";
    }
} else {
    $output = "Please enter a feature name.";
}

// Set HTTP response code before any output
http_response_code($status_code);
?>
<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../Resources/hmbct.png" />
    <title>SCA - Secured</title>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
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
            background: linear-gradient(180deg, #77DD76, #66CC65);
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
            color: #77DD76;
            font-weight: 500;
            transition: background-color 0.3s, color 0.3s, transform 0.2s;
        }
        .header button:hover {
            background-color: #77DD76;
            color: #fff;
            transform: translateY(-2px);
        }
        .main-container {
            background-color: #BDE7BD;
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
            border: 2px solid #77DD76;
            border-radius: 6px;
            width: 80%;
            max-width: 400px;
            box-sizing: border-box;
            transition: border-color 0.3s;
        }
        .main-content input[type="text"]:focus {
            border-color: #66CC65;
            outline: none;
        }
        .main-content input[type="submit"] {
            padding: 12px 24px;
            font-size: 16px;
            background-color: #77DD76;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            color: white;
            transition: background-color 0.3s, transform 0.2s;
        }
        .main-content input[type="submit"]:hover {
            background-color: #66CC65;
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
            <h1>SCA - Secured</h1>
            <p class="exploit-example">
                Vulnerability is fixed; the page uses an updated jQuery library (3.7.1) with no known vulnerabilities.
            </p>
           
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
<?php
// Process PHP logic before any output
$output = "";
$status_code = 200; // Default status code

// Whitelist of allowed command values
$allowed_values = ['Trochilidae', 'Apodidae', 'Strigidae'];

if (isset($_GET["typeBox"]) && !empty($_GET["typeBox"])) {
    $safe_target = $_GET["typeBox"];

    // Strict validation: only allow predefined values
    if (in_array($safe_target, $allowed_values, true)) {
        // Sanitize the input using escapeshellarg
        $safe_target = escapeshellarg($safe_target);

        // Execute the sanitized command
        $command_output = shell_exec("echo Selected: " . $safe_target);

        // Display both the selected input and the result of the command
        $output = "Selected bird family: " . htmlspecialchars($_GET["typeBox"], ENT_QUOTES, 'UTF-8');
        $output .= "<br>Command output: <pre>" . htmlspecialchars($command_output, ENT_QUOTES, 'UTF-8') . "</pre>";

        if ($_GET["typeBox"] === "Trochilidae") {
            $output .= "<br>Welldone! You did great job.";
        }
    } else {
        $output = "Invalid input.";
    }
} else {
    $output = "Please enter a value.";
}

// Set HTTP response code before any output
http_response_code($status_code);
?>





<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../Resources/hmbct.png" />
    <title>CommandExec-2</title>
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
            <h1>Command Exploitation Vulnerability Solved</h1>
            <p>
                <b>Try Command Execution again by using:</b> http://example.com/script.php?typeBox=whoami|id<br>
                Vulnerability is fixed, the attacker failed to extract server data.
            </p>
            <form action="CommandExec-2.php" method="GET">
                <label>Input here:</label>
                <input type="text" name="typeBox" value="">
                <input type="submit" value="Submit">
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

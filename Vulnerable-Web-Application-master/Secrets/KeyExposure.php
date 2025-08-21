<?php
session_start();

$config = require 'config.php';

// ✅ Set default role & message if not already set
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    $_SESSION['role'] = 'Attacker';
    $_SESSION['message'] = "⚠️ You are currently an <strong>Attacker</strong>. Try to exploit the API key exposure.";
}


// ✅ Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['api_key'])) {
    $user_api_key = $_POST['api_key'];

    if ($user_api_key === $config['API_KEY']) {
        $_SESSION['role'] = 'Admin';
        $_SESSION['message'] = "✅ Access granted! Your role is now: <strong>Admin</strong>.";
    } else {
        $_SESSION['role'] = 'Attacker';
        $_SESSION['message'] = "❌ Invalid API key. Access denied.";
    }
}

// ✅ Current session state
$currentRole = $_SESSION['role'];
$message = $_SESSION['message'];
?>

<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../Resources/hmbct.png" />
    <title>Private Key Exposure</title>
    <style>
        :root {
            --primary: #ff9500;
            --accent:  #ff8c00;
            --black:   #121212;
            --white:   #FFFFFF;
        }
        body {
            background: var(--black);
            color: var(--white);
            font-family: 'Inter', sans-serif;
            padding: 20px;
            font-size: 17px;
        }
        .main-content {
            background: #1e1e1e;
            padding: 30px;
            border-radius: 8px;
            border: 1px solid #333;
            text-align: center;
        }
        h1 {
            color: var(--primary);
            font-size: 32px;
            margin-bottom: 20px;
        }
        input[type="text"] {
            padding: 12px;
            font-size: 16px;
            border-radius: 6px;
            border: 2px solid var(--primary);
            width: 80%;
            max-width: 400px;
            box-sizing: border-box;
            margin-bottom: 15px;
        }
        button[type="submit"] {
            padding: 12px;
            font-size: 16px;
            background: linear-gradient(to bottom, var(--primary), var(--accent));
            color: #000;
            cursor: pointer;
            border: none;
            border-radius: 6px;
            box-shadow: 0 0 10px var(--primary);
            transition: all 0.3s ease;
            font-weight: bold;
        }
        button[type="submit"]:hover {
            transform: translateY(-3px);
            box-shadow: 0 0 20px var(--primary);
        }

        .disabled { 
            background-color: #7b623fff !important;
            color: #666 !important; 
            cursor: not-allowed; 
            box-shadow: none !important;
            transform: none !important;
        }
        .output {
            background: #121212;
            padding: 20px;
            border-radius: 8px;
            color: var(--primary);
            border: 1px solid #333;
            margin-top: 20px;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="main-content">
        <h1>Access Control Challenge</h1>
        <p>
            Enter the API key below to escalate your role from <strong>Attacker</strong> 
            ➝ <strong>Admin</strong>. This demonstrates how insecure secret handling 
            directly impacts authentication and authorization in an application.
        </p>
        <p style="color:red;">
            ⚠️ This API key is intentionally exposed in the source code. 
            In a real-world scenario, attackers could harvest this secret from 
            the repository history, logs, or even from leaked files.
        </p>
        <p><strong>API Key:</strong> <?php echo htmlspecialchars($config['API_KEY']); ?></p>
        
        <form action="Secrets/KeyExposure.php" method="POST" >
            <input type="text" name="api_key" placeholder="Enter API Key" required
                <?php if ($currentRole === 'Admin') echo 'disabled';?>>
            <button type="submit"
                <?php if ($currentRole === 'Admin') echo 'disabled class="disabled"'; ?>>
                Submit
            </button>
            <!-- <input type="submit" name="submit" value="Submit"> -->
        </form>
        
    </div>
    <div class="output">
        <?php echo "<p>$message</p>"; ?>
    </div>
</body>
</html>

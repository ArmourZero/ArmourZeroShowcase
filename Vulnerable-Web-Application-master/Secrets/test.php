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
    <title>Secret Scanning + Private Key Exposure Demo</title>
    <style>
        body { font-family: 'Inter', Arial, sans-serif; margin: 0; padding: 0; background-color: #ffffff; }
        .header { background: linear-gradient(180deg, #FF6962, #E55A54); padding: 20px; text-align: center; border-radius: 20px 20px 0 0; }
        .header button { padding: 12px 24px; font-size: 16px; border-radius: 6px; cursor: pointer; color: #FF6962; font-weight: 500; border: 2px solid #fff; background-color: #fff; }
        .main-container { background-color: #FFB6B3; padding: 30px 0; }
        .main-content { max-width: 800px; margin: 0 auto; text-align: center; background: #fff; border-radius: 12px; padding: 20px; }
        .main-content input, .main-content button { padding: 12px; font-size: 16px; border-radius: 6px; margin-top: 10px; }
        .output-container { background-color: #ecf2d0; padding: 20px; text-align: center; border-radius: 0 0 20px 20px; }
        .disabled { background-color: #ccc !important; color: #666 !important; cursor: not-allowed; }
    </style>
</head>
<body>
    <div class="header">
        <button onclick="location.href='../homepage.html';">Home Page</button>
    </div>

    <div class="main-container">
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
            
            <form method="POST">
                <input type="text" name="api_key" placeholder="Enter API Key" required
                    <?php if ($currentRole === 'Admin') echo 'disabled';?>>
                <button type="submit"
                    <?php if ($currentRole === 'Admin') echo 'disabled class="disabled"'; ?>>
                    Submit
                </button>
            </form>
        </div>
    </div>


    <div class="output-container">
        <?php echo "<p>$message</p>"; ?>
    </div>

</body>
</html>

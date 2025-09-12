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
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Figtree:wght@300..900&display=swap"
      rel="stylesheet"
    />
    <style>
        body {
            background: var(--black);
            color: var(--white);
            font-family: 'Figtree', sans-serif;
            padding: 20px;
            font-size: 20px;
            font-weight: 400; 
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
        </form>
    </div>
    <div class="output">
        <?php echo $message; ?>
    </div>
</body>
</html>
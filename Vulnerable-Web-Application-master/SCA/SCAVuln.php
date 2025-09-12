<?php
require './vendor/phpmailer/phpmailer/class.phpmailer.php';
require './vendor/phpmailer/phpmailer/class.smtp.php';

function sanitize($data) {
    return htmlspecialchars($data, ENT_QUOTES, 'UTF-8');
}
function normalizeInput($data) {
    return str_replace(["\r", "\n"], ['\\r', '\\n'], urldecode($data));
}

$output = ""; // initialize

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['to'])) {
    $to = $_POST['to'];
    $output = "Simulating email header injection for: " . sanitize($to);
}
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
        <h1>PHPMailer Header Injection</h1>
        <p>This demonstrates how a vulnerable PHPMailer version may allow header injection through user input.</p>

        <em><strong>Exploit Example Input:</strong>
        <code>victim@example.com%0ABcc:attacker@example.com</code></em>

        <form method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
            <br><h4 for="to">Enter Recipient Email:</h4>
            <input type="text" name="to" id="to" placeholder="example@example.com" value="<?php echo isset($_POST['to']) ? sanitize($_POST['to']) : ''; ?>" required><br>
            <button type="submit">Simulate Email Headers</button>
        </form>
    </div>
    <div class="output">
        <?php if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['to'])): ?>
<pre>
To: <?php echo sanitize(urldecode($_POST['to'])) . "\n"; ?>
From: admin@example.com
Subject: PHPMailer Injection Demo
X-Mailer: PHPMailer 5.2.2 (vulnerable)
</pre>
        <p><strong>⚠️ Vulnerability:</strong> Older versions of PHPMailer (like 5.2.2) may allow attackers to inject email headers using line breaks in user input.</p>
        <?php else: echo "Please enter a value.";endif ?>
    </div>
</body>
</html>
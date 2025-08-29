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
    <title>PHPMailer Header Injection Demo</title>
    <link rel="shortcut icon" href="../Resources/hmbct.png" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Figtree:wght@300..900&display=swap"
      rel="stylesheet"
    />
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
            font-family: 'Figtree', sans-serif;
            padding: 20px;
            font-size: 20px;
            font-weight: 400;
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
            font-size: 34px;
            margin-bottom: 20px;
            font-weight: 700;
        }
        code {
            background: #000;
            padding: 2px 6px;
            border-radius: 4px;
            color: #ff9500;
            font-size: 20px;
        }
        b, strong, em {
            font-weight: 700;
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
        input[type="submit"], button {
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
        input[type="submit"]:hover, button:hover {
            transform: translateY(-3px);
            box-shadow: 0 0 20px var(--primary);
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
        pre {
            text-align: left;
            background: #000;
            padding: 15px;
            border-radius: 6px;
            color: #ff9500;
            overflow-x: auto;
        }
        @media (max-width: 656px) {
            code {
                background: #000;
                padding: 2px 6px;
                border-radius: 4px;
                color: #ff9500;
                font-size: 14px;
            }
        }
    </style>
</head>
<body>
    <div class="main-content">
        <h1>PHPMailer Header Injection Demo</h1>
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
X-Mailer: PHPMailer 5.2.2 (vulnerable)</pre>
                <p><strong>⚠️ Vulnerability:</strong> Older versions of PHPMailer (like 5.2.2) may allow attackers to inject email headers using line breaks in user input.</p>
            <?php else: echo "Please enter a value.";endif ?>
        </div>
    </div>
</body>
</html>
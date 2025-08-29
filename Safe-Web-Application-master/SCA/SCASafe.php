<?php
require './vendor/phpmailer/phpmailer/src/PHPMailer.php';
require './vendor/phpmailer/phpmailer/src/SMTP.php';

use PHPMailer\PHPMailer\PHPMailer;

function sanitize($data) {
    return htmlspecialchars($data, ENT_QUOTES, 'UTF-8');
}
function normalizeInput($data) {
    return str_replace(["\r", "\n"], ['\\r', '\\n'], urldecode($data));
}

$version = PHPMailer::VERSION ?? 'Unknown';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../Resources/hmbct.png" />
    <title>SCA - Secured</title>
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
      <h1>PHPMailer Injection Protection Demo</h1>
      <div class="container">
          <p>This demo shows how <strong>modern PHPMailer (v<?= sanitize($version) ?>)</strong> protects against header injection vulnerabilities by sanitizing user input.</p>
          <div class="example-input">
              <p><b><em>Example Injection Attempt: </em></b><br> 
              <code><em>victim@example.com%0ABcc:attacker@example.com</em></code></p>
          </div>
          <form method="POST" action="SCA/SCASafe.php">
              <label for="to"><br><strong>Enter Recipient Email:</strong></label> <br><br>
              <input type="text" id="to" name="to" placeholder="example@example.com" required>
              <button type="submit" >Simulate Mail Headers</button>
          </form>
      </div>
    </div>
    <div class="output">
        <?php if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['to'])):
            $rawInput = normalizeInput($_POST['to']);
            $safeEmail = filter_var($rawInput, FILTER_SANITIZE_EMAIL);
        ?>
            <pre>
To: <?= sanitize($safeEmail) . "\n" ?>
From: admin@example.com
Subject: PHPMailer Injection Demo (Safe)
X-Mailer: PHPMailer <?= sanitize($version) ?> (patched)
            </pre>
            <div class="note">
                <span class="safe">✔ Safe:</span> Any header injection attempts are neutralized. Input is sanitized before use.
            </div>
            <?php else: ?>
            Please enter a value.
        <?php endif; ?>
    </div>
</body>
</html>
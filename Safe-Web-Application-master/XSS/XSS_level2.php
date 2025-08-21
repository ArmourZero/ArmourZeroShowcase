<?php
$output = "";
$status_code = 200;
$current_mode = (isset($_GET['mode']) && $_GET['mode'] === 'vulnerable') ? 'vulnerable' : 'safe';

if (isset($_GET["username"])) {
  if (!empty($_GET["username"])) {
    $user = htmlspecialchars($_GET["username"], ENT_QUOTES, 'UTF-8');
    $output = "Your name is " . $user;
  } else {
    $output = "Please enter a value.";
  }
} else {
  $output = "Please enter a value.";
}

http_response_code($status_code);
?>
<!DOCTYPE html>
<html>
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>XSS 2</title>
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
    input[type="submit"] {
      padding: 12px;
      font-size: 20px;
      background: linear-gradient(to bottom, var(--primary), var(--accent));
      color: #000;
      cursor: pointer;
      border: none;
      border-radius: 6px;
      box-shadow: 0 0 10px var(--primary);
      transition: all 0.3s ease;
      font-weight: bold;
      font-size: 16px;
    }
    input[type="submit"]:hover {
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
    }
  </style>
</head>
<body>
  <div class="main-content">
    <h1>XSS Vulnerability Exploitation <?= $current_mode === 'safe' ? 'Solved' : 'Demo'; ?></h1>
    <p>
      <b>Try XSS Exploit again by using:</b><br>
      http://example.com/script.php?username=&lt;img src=x onerror=alert('XSS')&gt;<br>
      <?= $current_mode === 'safe'
        ? 'No pop-up alert occurred. Successfully prevented attempted XSS exploitation.'
        : 'This demo shows how reflected XSS can be triggered when user input is not sanitized.'; ?>
    </p>
    <form action="XSS/XSS_level2.php" method="GET">
      <input type="hidden" name="mode" value="<?= $current_mode; ?>">
      <label for="username">Input here:</label>
      <input type="text" name="username" id="username" value="">
      <input type="submit" value="Submit">
    </form>
    <div class="output"><?= $output; ?></div>
  </div>
</body>
</html>
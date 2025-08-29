<?php
// Your PHP logic remains the same...
$output = "";
$status_code = 200;
$current_mode = (isset($_GET['mode']) && $_GET['mode'] === 'vulnerable') ? 'vulnerable' : 'safe';
$allowed_values = ['Armour', 'Zero'];

if (isset($_GET["typeBox"]) && !empty($_GET["typeBox"])) {
  $safe_target = $_GET["typeBox"];
  if (in_array($safe_target, $allowed_values, true)) {
    $output = "Well Done! Secret word is: " . htmlspecialchars($safe_target, ENT_QUOTES, 'UTF-8');
  } else {
    $output = "Invalid input.";
  }
} else {
  $output = "Please enter a value.";
}

http_response_code($status_code);
?><!DOCTYPE html>
<html>
<head>
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
            font-weight: 400; /* This is optional but can be used for clarity */
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
            font-weight: 700;
        }
        b {
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
            text-align: center; 
        }
    </style>
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link
    href="https://fonts.googleapis.com/css2?family=Figtree:wght@300..900&display=swap"
    rel="stylesheet"
  />
</head>
<body>
    <div class="main-container">
        <div class="main-content">
            <h1>Command Exploitation Vulnerability Solved</h1>
            <p>
                <b>Try Command Execution again by using:</b><br>
                <b>Mac user:</b> http://example.com/script.php?typeBox=whoami|id<br>
                <b>Window user:</b> http://example.com/script.php?typeBox=whoami&dir<br><br>
                Vulnerability is fixed, the attacker failed to extract server data.
            </p>
            <form action="CommandExecution/CommandExec-2.php" method="GET">
                <label>Input here:</label>
                <input type="text" name="typeBox" value="">
                <input type="submit" value="Submit">
            </form>
      </div>
            <div class="output">
                <?php echo $output; ?>
            </div>
        </div>
    </div>
</body>
</html>
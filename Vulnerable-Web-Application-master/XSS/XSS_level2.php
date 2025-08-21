<?php
// --- PHP: keep it intentionally vulnerable for XSS demo ---
$output = "";

if (isset($_GET["username"])) {
    $user = $_GET["username"];                 // no sanitization on purpose
    $output = $user === "" ? "Please enter a value." : "Your name is " . $user;
} else {
    $output = "Please enter a value.";
}

// Post back to THIS script even if it's included in a layout/router
$self = htmlspecialchars(strtok($_SERVER["REQUEST_URI"], "?"), ENT_QUOTES, "UTF-8");
?>
<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../Resources/hmbct.png" />
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
        <h1>XSS Vulnerability Exploitation</h1>
        <p class="exploit-example">
            <b>XSS Exploit example:</b> http://example.com/script.php?username=&lt;img src=x onerror=alert('XSS')&gt; <br><br>
                When the victim clicks the link, their browser sends the GET request to script.php, and the server responds with the injected JavaScript. The alert('XSS') executes immediately, demonstrating the vulnerability.
        </p>
        <form method="GET" action="<?php echo $self; ?>" name="form">
            <label>Input here:</label>
            <input type="text" name="username">
            <input type="submit" name="submit" value="Submit">
        </form>
        <div class="output">
            <?php echo $output; ?>
        </div>
    </div>
</body>
</html>

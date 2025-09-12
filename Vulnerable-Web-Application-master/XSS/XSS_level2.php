<?php
// --- PHP: keep it intentionally vulnerable for XSS demo ---
$output = "";

if (isset($_GET["username"])) {
    $user = $_GET["username"];           // no sanitization on purpose
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
            font-weight: 400; /* This is optional but can be used for clarity */
        }
    </style>
</head>
<body>
    <div class="main-content">
        <h1>XSS Vulnerability Exploitation</h1>
        <b>XSS Exploit example:</b> http://example.com/script.php?username=&lt;img src=x onerror=alert('XSS')&gt; <br><br>
        <p> When the victim clicks the link, their browser sends the GET request to script.php, and the server responds with the injected JavaScript. The alert('XSS') executes immediately, demonstrating the vulnerability. </p>
        
        <form method="GET" action="<?php echo $self; ?>" name="form">
            <label>Input here:</label>
            <input type="text" name="username">
            <input type="submit" name="submit" value="Submit">
        </form>
    </div>
        <div class="output">
            <?php echo $output; ?>
        </div>
    </div>
</body>
</html>
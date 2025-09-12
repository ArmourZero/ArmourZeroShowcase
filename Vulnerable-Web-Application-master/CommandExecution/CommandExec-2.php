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
        <h1>Command Execution Vulnerability Exploitation</h1>
        <p>
            <b>Example Execution:</b> <br>
            <b>Mac user:</b> http://example.com/script.php?typeBox=whoami|id<br>
            <b>Window user:</b> http://example.com/script.php?typeBox=whoami&dir<br> <br>
            The attacker sees the output of the id command, revealing the server user context.
            The attacker sees the output of the id command, revealing the server user context.
        </p>
        <form action="CommandExecution/CommandExec-2.php" method="GET">
            <label>Input here:</label>
            <input type="text" name="typeBox" value="">
            <input type="submit" value="Submit">
        </form>
    </div>
    <div class="output">
        <?php
        if (isset($_GET["typeBox"]) && !empty($_GET["typeBox"])) {
            $target = $_GET["typeBox"];
            $substitutions = array('&&' => '', ';' => '', '/' => '', '\\' => '');
            $target = str_replace(array_keys($substitutions), $substitutions, $target);
            if (shell_exec($target) !== null) {
                echo shell_exec($target);
            } else {
                echo "Error: Invalid command.";
            }
        } else {
            echo "Please enter a value.";
        }
        ?>
    </div>
</body>
</html>
<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../Resources/hmbct.png" />
    <title>CommandExec-2</title>
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
            text-align: center; 
        }
    </style>
</head>
<body>
    <div class="main-content">
        <h1>Command Execution Vulnerability Exploitation</h1>
        <p>
            <b>Example Execution:</b> <br>
            <b>Mac user:</b> http://example.com/script.php?typeBox=whoami|id<br>
            <b>Window user:</b> http://example.com/script.php?typeBox=whoami&dir<br>
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
            if ($target !== '') {
                echo shell_exec($target);
            } else {
                echo "Error: Invalid or empty command.";
            }
        } else {
            echo "Please enter a value.";
        }
        ?>
    </div>
</body>
</html>

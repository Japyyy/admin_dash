<?php
session_start();
require_once __DIR__ . '/db.php'; // DB connection

// If already logged in, redirect directly to dashboard
if (isset($_SESSION['username']) && isset($_SESSION['role'])) {
    if ($_SESSION['role'] === 'Admin') {
        header("Location: admindashboard.php");
        exit;
    } elseif ($_SESSION['role'] === 'Owner') {
        header("Location: ownerdashboard.php");
        exit;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LaundroLink Login</title>
    <style>
        body { 
            margin: 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #74ebd5 0%, #ACB6E5 100%);
            height: 100vh; 
            display: flex; 
            justify-content: center; 
            align-items: center; 
        }

        .login-box {
            background: #fff; 
            padding: 40px; 
            border-radius: 15px; 
            box-shadow: 0px 6px 20px rgba(0,0,0,0.2); 
            width: 350px;
            text-align: center;
            position: relative;
            overflow: hidden;
        }

        .login-box::before {
            content: "";
            position: absolute;
            top: -80px;
            right: -80px;
            width: 200px;
            height: 200px;
            background: rgba(0, 183, 255, 0.2);
            border-radius: 50%;
            z-index: 0;
        }

        .login-box::after {
            content: "";
            position: absolute;
            bottom: -80px;
            left: -80px;
            width: 200px;
            height: 200px;
            background: rgba(173, 216, 230, 0.3);
            border-radius: 50%;
            z-index: 0;
        }

        .login-box h2 {
            margin-bottom: 20px;
            color: #0077b6;
            font-size: 28px;
            position: relative;
            z-index: 1;
        }

        .login-box p {
            margin-bottom: 20px;
            color: #555;
            font-size: 14px;
            position: relative;
            z-index: 1;
        }

        input {
            width: 100%; 
            padding: 12px; 
            margin: 12px 0; 
            border: 1px solid #ccc; 
            border-radius: 8px;
            font-size: 14px;
            position: relative;
            z-index: 1;
        }

        button {
            width: 100%; 
            padding: 12px; 
            margin-top: 10px;
            background: #00b4d8; 
            color: white; 
            border: none; 
            border-radius: 8px;
            cursor: pointer;
            font-size: 16px;
            font-weight: bold;
            position: relative;
            z-index: 1;
            transition: background 0.3s ease;
        }
        button:hover { background: #0096c7; }

        .error {
            color: red; 
            font-size: 0.9em; 
            margin-bottom: 10px;
            position: relative;
            z-index: 1;
        }
    </style>
</head>
<body>
    <div class="login-box">
        <h2>🧺 LaundroLink</h2>
        <p>Login</p>

        <?php
        if (isset($_GET['error'])) {
            echo "<p class='error'>Invalid username, password, or role.</p>";
        }
        ?>

        <form action="login.php" method="POST">
            <input type="text" name="username" placeholder="👤 Username" required />
            <input type="password" name="password" placeholder="🔑 Password" required />
            <button type="submit">Login</button>
        </form>
    </div>
</body>
</html>

<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: index.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>LaundroLink Owner Dashboard</title>
    <style>
        body {
            margin: 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: #f0f8ff;
            color: #333;
        }

        .sidebar {
            width: 230px;
            height: 100vh;
            background: linear-gradient(180deg, #0077b6, #0096c7); /* same as admin */
            color: white;
            position: fixed;
            top: 0;
            left: 0;
            padding-top: 30px;
            box-shadow: 3px 0 10px rgba(0,0,0,0.1);
        }

        .sidebar h2 {
            text-align: center;
            margin-bottom: 40px;
            font-size: 22px;
            letter-spacing: 1px;
        }

        .sidebar a {
            display: block;
            color: white;
            padding: 14px 20px;
            margin: 8px 15px;
            text-decoration: none;
            border-radius: 8px;
            font-weight: 500;
            transition: background 0.3s ease;
        }

        .sidebar a:hover {
            background: rgba(255, 255, 255, 0.2);
        }

        .main-content {
            margin-left: 230px;
            padding: 30px;
            min-height: 100vh;
            background: #f9fbfd;
        }

        .main-content h2 {
            margin-top: 0;
            font-size: 26px;
            color: #0077b6;
        }

        /* Dashboard header */
        .dashboard-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background: white;
            padding: 15px 25px;
            border-radius: 10px;
            margin-bottom: 25px;
            box-shadow: 0px 4px 12px rgba(0,0,0,0.05);
        }

        .dashboard-header h1 {
            margin: 0;
            font-size: 22px;
            color: #0077b6;
        }

        /* Subtle bubble accents */
        .bubble {
            position: absolute;
            border-radius: 50%;
            background: rgba(0, 183, 255, 0.15);
            animation: float 6s infinite ease-in-out;
        }

        .bubble.small {
            width: 40px; height: 40px;
            bottom: 20px; right: 30px;
        }

        .bubble.large {
            width: 80px; height: 80px;
            bottom: 100px; right: 100px;
        }

        @keyframes float {
            0% { transform: translateY(0); opacity: 1; }
            50% { transform: translateY(-20px); opacity: 0.7; }
            100% { transform: translateY(0); opacity: 1; }
        }
    </style>
</head>
<body>
    <div class="sidebar">
        <h2>🧺 LaundroLink</h2>
        <a href="ownerdashboard.php?page=manage_shop">Manage Shop Details</a>
        <a href="ownerdashboard.php?page=view_orders">View Orders</a>
        <a href="ownerdashboard.php?page=manage_employees">Manage Employees</a>
        <a href="ownerdashboard.php?page=view_sales">View Sales</a>
        <a href="ownerdashboard.php?page=reports">Generate Reports</a>
        <a href="ownerdashboard.php?page=reviews">View Customer Reviews</a>
        <a href="logout.php">Logout</a>
    </div>

    <div class="main-content">
        <div class="dashboard-header">
            <h1>Welcome, <?php echo htmlspecialchars($_SESSION['username']); ?>!</h1>
        </div>
        <div class="content">
            <?php
            if (isset($_GET['page'])) {
                $page = $_GET['page'];
                $file = "owner_pages/" . $page . ".php"; // separate folder for owner
                if (file_exists($file)) {
                    include($file);
                } else {
                    echo "<h2>Page not found</h2>";
                }
            } else {
                echo "<h2>Welcome to the Owner Dashboard</h2><p>Select an option from the sidebar.</p>";
            }
            ?>
        </div>
    </div>

    <!-- Decorative bubbles -->
    <div class="bubble small"></div>
    <div class="bubble large"></div>
</body>
</html>

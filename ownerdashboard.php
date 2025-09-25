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
    <title>Owner Dashboard</title>
    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: #f9f9f9;
        }
        .sidebar {
            width: 220px;
            height: 100vh;
            background: #1e3d59; /* darker blue for owners */
            color: white;
            position: fixed;
            padding-top: 20px;
        }
        .sidebar h2 {
            text-align: center;
            margin-bottom: 30px;
            font-size: 22px;
            font-weight: bold;
        }
        .sidebar a {
            display: block;
            color: white;
            padding: 12px 18px;
            text-decoration: none;
            transition: 0.3s;
        }
        .sidebar a:hover {
            background: #2a4d6f;
            padding-left: 25px;
        }
        .main-content {
            margin-left: 220px;
            padding: 20px;
        }
        .header {
            background: #fff;
            padding: 15px 20px;
            border-bottom: 1px solid #ddd;
            font-size: 18px;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="sidebar">
        <h2>LaundroLink Owner</h2>
        <a href="ownerdashboard.php?page=manage_shop">Manage Shop Details</a>
        <a href="ownerdashboard.php?page=view_orders">View Orders</a>
        <a href="ownerdashboard.php?page=manage_employees">Manage Employees</a>
        <a href="ownerdashboard.php?page=view_sales">View Sales</a>
        <a href="ownerdashboard.php?page=reports">Generate Reports</a>
        <a href="ownerdashboard.php?page=reviews">View Customer Reviews</a>
        <a href="logout.php">Logout</a>
    </div>

    <div class="main-content">
        <div class="header">
            Welcome, <?php echo htmlspecialchars($_SESSION['username']); ?>!
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
</body>
</html>

<?php
require_once __DIR__ . '/../db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username   = $_POST['username'];
    $email      = $_POST['email'];
    $password   = $_POST['password']; // you may use password_hash() later
    $first_name = $_POST['first_name'];
    $last_name  = $_POST['last_name'];
    $dob        = $_POST['dob'];
    $address    = $_POST['address'];
    $contact    = $_POST['contact'];

    $check = $conn->prepare("SELECT userID FROM users WHERE username = ?");
    $check->bind_param("s", $username);
    $check->execute();
    $check->store_result();

    if ($check->num_rows > 0) {
        echo "<script>alert('⚠️ Username already exists. Please choose another one.');</script>";
    } else {
        // ✅ Step 2: Insert new owner
        $stmt = $conn->prepare("INSERT INTO users 
            (username, email, password, first_name, last_name, dob, address, contact, created_at, role, status) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, NOW(), 'Owner', 'Active')");
        $stmt->bind_param("ssssssss", $username, $email, $password, $first_name, $last_name, $dob, $address, $contact);

        if ($stmt->execute()) {
            echo "<script>alert('✅ Owner account created successfully!'); window.location.href='admindashboard.php?page=manage_users';</script>";
        } else {
            echo "<script>alert('❌ Error creating owner account: " . addslashes($stmt->error) . "');</script>";
        }
    }

}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Create Owner Account</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #74ebd5 0%, #ACB6E5 100%);
            height: 100vh;
            margin: 0;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .form-container {
            background: #fff;
            padding: 30px 40px;
            border-radius: 15px;
            box-shadow: 0px 6px 20px rgba(0,0,0,0.2);
            width: 500px;
            max-width: 95%;
            text-align: center;
            position: relative;
            overflow: hidden;
        }
        .form-container::before {
            content: "";
            position: absolute;
            top: -80px;
            right: -80px;
            width: 200px;
            height: 200px;
            background: rgba(0, 183, 255, 0.15);
            border-radius: 50%;
            z-index: 0;
        }
        .form-container::after {
            content: "";
            position: absolute;
            bottom: -80px;
            left: -80px;
            width: 200px;
            height: 200px;
            background: rgba(173, 216, 230, 0.2);
            border-radius: 50%;
            z-index: 0;
        }
        h2 {
            margin-bottom: 20px;
            color: #0077b6;
            font-size: 26px;
            position: relative;
            z-index: 1;
        }
        form {
            position: relative;
            z-index: 1;
            text-align: left;
        }
        label {
            font-weight: bold;
            font-size: 14px;
            color: #333;
        }
        input {
            width: 100%;
            padding: 12px;
            margin: 8px 0 16px 0;
            border: 1px solid #ccc;
            border-radius: 8px;
            font-size: 14px;
        }
        button {
            width: 100%;
            padding: 12px;
            background: #00b4d8;
            color: white;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-size: 16px;
            font-weight: bold;
            transition: background 0.3s ease;
        }
        button:hover {
            background: #0096c7;
        }
    </style>
</head>
<body>
    <div class="form-container">
        <h2>🧺 Create Owner Account</h2>
        <form method="POST">
            <label>Username:</label>
            <input type="text" name="username" required>

            <label>Email:</label>
            <input type="email" name="email" required>

            <label>Password:</label>
            <input type="password" name="password" required>

            <label>First Name:</label>
            <input type="text" name="first_name" required>

            <label>Last Name:</label>
            <input type="text" name="last_name" required>

            <label>Date of Birth:</label>
            <input type="date" name="dob">

            <label>Address:</label>
            <input type="text" name="address">

            <label>Contact:</label>
            <input type="text" name="contact">

            <button type="submit">➕ Create Owner</button>
        </form>
    </div>
</body>
</html>

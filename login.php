<?php
session_start();
require_once __DIR__ . '/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    $stmt = $conn->prepare("SELECT * FROM users WHERE username = ? AND password = ?");
    $stmt->bind_param("ss", $username, $password);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $user = $result->fetch_assoc();

        $_SESSION['username'] = $user['username'];
        $_SESSION['role'] = $user['role'];

        if ($user['role'] === 'Admin') {
            header("Location: admindashboard.php");
            exit;
        } elseif ($user['role'] === 'Owner') {
            header("Location: ownerdashboard.php");
            exit;
        } else {
            header("Location: index.php?error=1");
            exit;
        }
    } else {
        header("Location: index.php?error=1");
        exit;
    }
}

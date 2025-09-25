<?php
require_once __DIR__ . '/../db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $userID = intval($_POST['userID']);

    $stmt = $conn->prepare("DELETE FROM users WHERE userID = ?");
    $stmt->bind_param("i", $userID);

    if ($stmt->execute()) {
        echo "<script>
                alert('User deleted successfully!');
                window.location.href = '../admindashboard.php?page=manage_users';
              </script>";
        exit;
    } else {
        echo "<script>
                alert('Error deleting user!');
                window.location.href = '../admindashboard.php?page=manage_users';
              </script>";
        exit;
    }
}
?>

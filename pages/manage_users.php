<?php
require_once __DIR__ . '/../db.php';

$sql = "SELECT * FROM users";
$result = $conn->query($sql);
?>

<h2 class="page-title">👥 Manage Users</h2>

<?php if ($result->num_rows > 0): ?>
    <div class="table-container">
        <table class="styled-table">
            <thead>
                <tr>
                    <th>UserID</th>
                    <th>Username</th>
                    <th>Email</th>
                    <th>Password</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>DOB</th>
                    <th>Address</th>
                    <th>Contact</th>
                    <th>Date Created</th>
                    <th>Role</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?= $row['userID'] ?></td>
                    <td><?= htmlspecialchars($row['username']) ?></td>
                    <td><?= htmlspecialchars($row['email']) ?></td>
                    <td><?= htmlspecialchars($row['password']) ?></td>
                    <td><?= htmlspecialchars($row['first_name']) ?></td>
                    <td><?= htmlspecialchars($row['last_name']) ?></td>
                    <td><?= $row['dob'] ?></td>
                    <td><?= htmlspecialchars($row['address']) ?></td>
                    <td><?= htmlspecialchars($row['contact']) ?></td>
                    <td><?= $row['created_at'] ?></td>
                    <td>
                        <form action="/admin_dash/pages/update_role.php" method="post" class="inline-form">
                            <input type="hidden" name="userID" value="<?= $row['userID'] ?>">
                            <select name="role" class="role-select">
                                <option value="Customer" <?= $row['role'] == 'Customer' ? 'selected' : '' ?>>Customer</option>
                                <option value="Staff" <?= $row['role'] == 'Staff' ? 'selected' : '' ?>>Staff</option>
                                <option value="Admin" <?= $row['role'] == 'Admin' ? 'selected' : '' ?>>Admin</option>
                                <option value="Owner" <?= $row['role'] == 'Owner' ? 'selected' : '' ?>>Owner</option>
                            </select>
                            <button type="submit" class="btn update-btn">Update</button>
                        </form>
                    </td>
                    <td>
                        <span class="status <?= strtolower($row['status']) ?>">
                            <?= htmlspecialchars($row['status']) ?>
                        </span>
                    </td>
                    <td>
                        <form action="/admin_dash/pages/delete_user.php" method="post" class="inline-form" onsubmit="return confirm('Are you sure you want to delete this user?');">
                            <input type="hidden" name="userID" value="<?= $row['userID'] ?>">
                            <button type="submit" class="btn delete-btn">Delete</button>
                        </form>
                    </td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
<?php else: ?>
    <p>No users found.</p>
<?php endif; ?>

<?php $conn->close(); ?>

<!-- CSS Styling -->
<style>
.page-title {
    font-size: 26px;
    color: #0077b6;
    margin-bottom: 20px;
}

.table-container {
    background: white;
    padding: 20px;
    border-radius: 12px;
    box-shadow: 0px 4px 12px rgba(0,0,0,0.05);
    overflow-x: auto;
}

.styled-table {
    width: 100%;
    border-collapse: collapse;
    font-size: 14px;
    min-width: 1000px;
}

.styled-table thead tr {
    background: #0096c7;
    color: #ffffff;
    text-align: left;
}

.styled-table th, 
.styled-table td {
    padding: 12px 15px;
    border-bottom: 1px solid #ddd;
}

.styled-table tbody tr:nth-child(even) {
    background-color: #f3f9fb;
}

.styled-table tbody tr:hover {
    background-color: #e6f7ff;
}

.inline-form {
    display: flex;
    align-items: center;
    gap: 6px;
}

.role-select {
    padding: 6px;
    border: 1px solid #ccc;
    border-radius: 6px;
    font-size: 13px;
}

.btn {
    border: none;
    padding: 6px 12px;
    border-radius: 6px;
    font-size: 13px;
    cursor: pointer;
    transition: background 0.3s ease;
}

.update-btn {
    background: #0077b6;
    color: white;
}
.update-btn:hover {
    background: #005f87;
}

.delete-btn {
    background: #e63946;
    color: white;
}
.delete-btn:hover {
    background: #c1121f;
}

/* Status badge */
.status {
    padding: 5px 10px;
    border-radius: 20px;
    font-size: 12px;
    font-weight: bold;
    text-transform: capitalize;
}

.status.active {
    background: #d1f7c4;
    color: #2a9d8f;
}

.status.inactive {
    background: #ffe0e0;
    color: #d62828;
}
</style>

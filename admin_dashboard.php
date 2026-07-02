<?php
session_start();
include("config/db.php");

if (!isset($_SESSION['admin'])) {
    header("Location: admin_login.php");
}
?>

<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="css/style.css">
    <title>Admin Dashboard</title>
</head>
<body class="bg-image">

<div class="page-overlay">

<div class="navbar">
    <h2>Admin Panel</h2>
    <div>
        <a href="admin_dashboard.php">Home</a>
        <a href="logout.php">Logout</a>
    </div>
</div>

<div style="text-align: center; margin-top: 20px;">

    <h2 style="color: white;">Admin Dashboard</h2>

    <div style="margin-top: 10px;">
        <a href="index.html" style="color: white; margin: 0 10px;">🏠 Home</a>
        <a href="admin_login.php" style="color: white; margin: 0 10px;">🔐 Login</a>
    </div>

</div>

<br><br>

<table border="1" style="margin:auto; background:white;">
<tr>
    <th>ID</th>
    <th>User ID</th>
    <th>Date</th>
    <th>Time</th>
    <th>Status</th>
    <th>Action</th>
</tr>

<?php
$sql = "SELECT * FROM appointments";
$result = $conn->query($sql);

while ($row = $result->fetch_assoc()) {
    echo "<tr>
        <td>{$row['id']}</td>
        <td>{$row['user_id']}</td>
        <td>{$row['date']}</td>
        <td>{$row['time']}</td>
        <td>{$row['status']}</td>
        <td>
            <a href='update_status.php?id={$row['id']}&status=Approved'>Approve</a> |
            <a href='update_status.php?id={$row['id']}&status=Rejected'>Reject</a>
        </td>
    </tr>";
}
?>

</table>
</div>
</body>
</html>
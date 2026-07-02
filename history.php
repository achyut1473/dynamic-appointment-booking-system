<?php
session_start();
include("config/db.php");

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

$sql = "SELECT * FROM appointments WHERE user_id='$user_id'";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>My Booking History</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body class="bg-image">

<div class="page-overlay">

<!-- NAVBAR -->
<div class="navbar">
    <h2>MyBooking</h2>
    <div>
        <a href="dashboard.php">Home</a>
        <a href="book.php">Book</a>
        <a href="logout.php">Logout</a>
    </div>
</div>

<h2 style="color:white; margin-left:20px;">My Booking History</h2>

<div style="margin-left:20px;">
    <a href="dashboard.php" style="color:white;">⬅ Back to Dashboard</a>
</div>

<br>

<?php
if ($result->num_rows > 0) {
?>
    <table>
        <tr>
            <th>ID</th>
            <th>Service</th>
            <th>Location</th>
            <th>Date</th>
            <th>Time</th>
            <th>Status</th>
        </tr>

        <?php while ($row = $result->fetch_assoc()) { ?>
            <tr>
                <td><?php echo $row['id']; ?></td>
                <td><?php echo $row['service']; ?></td>
                <td><?php echo $row['location']; ?></td>
                <td><?php echo $row['date']; ?></td>
                <td><?php echo $row['time']; ?></td>
                <td>
                    <span class="status <?php echo $row['status']; ?>">
                        <?php echo $row['status']; ?>
                    </span>
                </td>
            </tr>
        <?php } ?>

    </table>

<?php
} else {
    echo "<div class='no-data-card'>No Bookings Found 😔</div>";
}
?>

</div>

</body>
</html>
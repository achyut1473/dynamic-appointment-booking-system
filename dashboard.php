<?php
session_start();
include("config/db.php");

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// GET values
$search = isset($_GET['search']) ? $_GET['search'] : "";
$service = isset($_GET['service']) ? $_GET['service'] : "";

// Base query
$sql = "SELECT * FROM appointments WHERE 1=1";

// Apply filters
if ($search != "") {
    $sql .= " AND location LIKE '%$search%'";
}

if ($service != "") {
    $sql .= " AND LOWER(service)=LOWER('$service')";
}

$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
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
        <a href="history.php">My Bookings</a>
        <a href="logout.php">Logout</a>
    </div>
</div>

<!-- WELCOME -->
<h1 class="welcome-text">
    Welcome <?php echo $_SESSION['user_name']; ?> 👋
</h1>

<!-- ACTION BUTTONS -->
<div class="quick-actions">
    <a href="book.php" class="btn">+ Book Appointment</a>
    <a href="history.php" class="btn secondary">My Bookings</a>
</div>

<h2 class="section-title">Available Appointments</h2>

<!-- SEARCH + FILTER -->
<div class="search-box">
    <form method="GET">

        <select name="search">
        <option value="">All Locations</option>
        <option value="Shivajinagar">Shivajinagar</option>
        <option value="Hinjewadi">Hinjewadi</option>
        <option value="Kothrud">Kothrud</option>
        <option value="Wakad">Wakad</option>
        <option value="Baner">Baner</option>
        </select>

        

        <select name="service">
            <option value="">All Services</option>
            <option value="Doctor" <?php if($service=="Doctor") echo "selected"; ?>>Doctor</option>
            <option value="Dentist" <?php if($service=="Dentist") echo "selected"; ?>>Dentist</option>
            <option value="Salon" <?php if($service=="Salon") echo "selected"; ?>>Salon</option>
            <option value="Gym Trainer" <?php if($service=="Gym Trainer") echo "selected"; ?>>Gym Trainer</option>
        </select>

        <button type="submit">Search</button>

    </form>
</div>

<!-- CARDS -->
<?php
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {

        // Dynamic image
        $img = "https://via.placeholder.com/150";

        if ($row['service'] == "Doctor") {
            $img = "https://cdn-icons-png.flaticon.com/512/3774/3774299.png";
        } elseif ($row['service'] == "Dentist") {
            $img = "https://cdn-icons-png.flaticon.com/512/2966/2966327.png";
        } elseif ($row['service'] == "Salon") {
            $img = "images/salon.png";
        } elseif ($row['service'] == "Gym Trainer") {
            $img = "https://cdn-icons-png.flaticon.com/512/1048/1048949.png";
        }

        echo "
        <div class='card'>

            <div class='card-left'>
                <img src='$img'>
            </div>

            <div class='card-right'>
                <h3>{$row['service']}</h3>
                <p><b>Location:</b> {$row['location']}</p>
                <p><b>Date:</b> {$row['date']}</p>
                <p><b>Time:</b> {$row['time']}</p>
                <p>Status: <span class='status {$row['status']}'>{$row['status']}</span></p>
            </div>

        </div>
        ";
    }
} else {
    echo "<p style='text-align:center; color:white;'>No results found</p>";
}
?>

</div>
</body>
</html>
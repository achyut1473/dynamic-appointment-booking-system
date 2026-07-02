<?php
session_start();
include("config/db.php");

// ✅ TIMEZONE FIX
date_default_timezone_set("Asia/Kolkata");

// ✅ LOGIN CHECK
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$error = "";

if (isset($_POST['book'])) {

    $user_id = $_SESSION['user_id'];
    $service = $_POST['service'];
    $location = $_POST['location'];
    $date = $_POST['date'];
    $time = $_POST['time'];

    // ✅ VALIDATE EMPTY
    if (empty($date) || empty($time)) {
        $error = "Please select date and time!";
    } else {

        // ✅ DATE VALIDATION (FIXED)
        $selectedDate = strtotime($date);
        $currentDate = strtotime(date("Y-m-d"));

        if ($selectedDate < $currentDate) {
            $error = "Cannot book past dates!";
        } else {

            // ✅ TIME SLOT CONFLICT CHECK
            $check = "SELECT * FROM appointments 
                      WHERE date='$date' AND time='$time'";

            $result_check = $conn->query($check);

            if ($result_check->num_rows > 0) {
                $error = "Time slot already booked!";
            } else {

                // ✅ INSERT BOOKING
                $sql = "INSERT INTO appointments 
                (user_id, service, location, date, time, status) 
                VALUES ('$user_id', '$service', '$location', '$date', '$time', 'Pending')";

                if ($conn->query($sql)) {
                    echo "<script>alert('Appointment Booked Successfully!'); window.location='dashboard.php';</script>";
                    exit();
                } else {
                    $error = "Database Error!";
                }
            }
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Book Appointment</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body class="light-bg">

<div class="light-overlay">

<!-- NAVBAR -->
<div class="navbar">
    <h2>MyBooking</h2>
    <div>
        <a href="dashboard.php">Home</a>
        <a href="history.php">My Bookings</a>
        <a href="logout.php">Logout</a>
    </div>
</div>

<h2 style="text-align:center;">Book Appointment</h2>

<!-- ERROR MESSAGE -->
<?php if ($error != "") { ?>
    <p style="color:red; text-align:center; font-weight:bold;">
        <?php echo $error; ?>
    </p>
<?php } ?>

<!-- FORM -->
<form method="POST">

<label>Select Service:</label><br>
<select name="service" required>
    <option value="">-- Select Service --</option>
    <option value="Doctor">Doctor</option>
    <option value="Dentist">Dentist</option>
    <option value="Salon">Salon</option>
    <option value="Gym Trainer">Gym Trainer</option>
</select><br><br>

<label>Select Location:</label><br>
<select name="location" required>
    <option value="">-- Select Location --</option>
    <option value="Shivajinagar">Shivajinagar</option>
    <option value="Hinjewadi">Hinjewadi</option>
    <option value="Kothrud">Kothrud</option>
    <option value="Wakad">Wakad</option>
    <option value="Baner">Baner</option>
</select><br><br>

<label>Select Date:</label><br>
<input type="date" name="date" required><br><br>

<label>Select Time:</label><br>
<input type="time" name="time" required><br><br>

<button type="submit" name="book">Book Appointment</button>

</form>

<br>
<div style="text-align:center;">
    <a href="dashboard.php">⬅ Back to Dashboard</a>
</div>

</div>

</body>
</html>
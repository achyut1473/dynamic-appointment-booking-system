<?php include("config/db.php"); ?>

<!DOCTYPE html>
<html>
<head>
    <title>Register</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body class="bg-image login-page">

<div class="page-overlay">

<div class="login-container">

    <h2>Register</h2>

    <form method="POST">
        <input type="text" name="name" placeholder="Enter Name" required>
        <input type="email" name="email" placeholder="Enter Email" required>
        <input type="password" name="password" placeholder="Enter Password" required>
        <button type="submit" name="register">Register</button>
    </form>

    <p>Already have an account? <a href="login.php">Login here</a></p>

    <a href="index.html" class="back-home">⬅ Back to Home</a>

</div>

</div>

</body>
</html>

<?php
if (isset($_POST['register'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql = "INSERT INTO users (name, email, password) VALUES ('$name', '$email', '$password')";

    if ($conn->query($sql)) {
        header("Location: login.php");
    } else {
        echo "Error: " . $conn->error;
    }
}
?>
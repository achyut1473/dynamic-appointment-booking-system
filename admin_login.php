<?php
session_start();

$error = "";

if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    if ($username == "admin" && $password == "admin123") {
        $_SESSION['admin'] = true;
        header("Location: admin_dashboard.php");
        exit();
    } else {
        $error = "Invalid Admin Credentials!";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Login</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body class="bg-image login-page">

<div class="page-overlay">

<div class="login-container">

    <h2>Admin Login</h2>

    <?php if ($error != "") { ?>
        <p style="color: red; font-weight: bold;"><?php echo $error; ?></p>
    <?php } ?>

    <form method="POST">
        <input type="text" name="username" placeholder="Enter Username" required>
        <input type="password" name="password" placeholder="Enter Password" required>
        <button type="submit" name="login">Login</button>
    </form>

    <a href="index.html" class="back-home">⬅ Back to Home</a>

</div>

</div>

</body>
</html>
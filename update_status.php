<?php
include("config/db.php");

$id = $_GET['id'];
$status = $_GET['status'];

$sql = "UPDATE appointments SET status='$status' WHERE id=$id";

if ($conn->query($sql)) {
    header("Location: admin_dashboard.php");
}
?>
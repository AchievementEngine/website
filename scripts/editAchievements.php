<?php
include_once "connect.php";
session_start();

$username = $_SESSION["username"];
$featuredAch = $db->real_escape_string($_POST['achList']);

$query = "UPDATE users SET featuredAch = '$featuredAch' WHERE username = '$username'";
$results = $db->query($query);
$_SESSION['profile_updated'] = "Profile successfully updated!";
header("location: ../editProfile.php");
?>
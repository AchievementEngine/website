<?php
include_once "connect.php";
session_start();

$username = $_SESSION["username"];
$dispName = $db->real_escape_string($_POST['dispName']);
$email = $db->real_escape_string($_POST['email']);
$fname = $db->real_escape_string($_POST['fname']);
$lname = $db->real_escape_string($_POST['lname']);
$country = $db->real_escape_string($_POST['country']);
$discord = $db->real_escape_string($_POST['discord']);

$query = "UPDATE users SET dispName = '$dispName', email = '$email', fname = '$fname', lname = '$lname', country = '$country', discord = '$discord' WHERE username = '$username'";
$results = $db->query($query);
$_SESSION['profile_updated'] = "Profile successfully updated!";
header("location: ../editProfile.php");
?>
<?php
	include_once "connect.php";
	session_start();

	$username = $_SESSION["username"];
	$featuredAch = $db->real_escape_string($_POST['achList']);

	$query1 = "SELECT * FROM achievements WHERE achName = '$featuredAch'";
	$queryResults = $db->query($query1);
	while ($queryRow = $queryResults->fetch_assoc()) {
		$achStr = $queryRow['achStr'];
	}

	$query = "UPDATE users SET featuredAch = '$achStr' WHERE username = '$username'";
	$results = $db->query($query);
	$_SESSION['profile_updated'] = "Profile successfully updated!";
	header("location: ../editProfile.php");
?>
<?php
	session_start();
	include_once "connect.php";

	if (!isset($_SESSION['username'])) {
		$_SESSION['msg'] = "You must log in first";
		header('location: login.php');
	}
		
	if (isset($_GET['logout'])) {
		session_destroy();
		unset($_SESSION['username']);
		header("location: login.php");
	}

	$sender = $_SESSION['username'];
	$recipient = $db->real_escape_string($_POST['recipient']);

	//Check recipient exists
	$sql = "SELECT * FROM users WHERE username = '$recipient'";
	$results = $db->query($sql);
	if($results->num_rows == 1) {
		$query = "SELECT * FROM conversation";
		$qresults = $db->query($query);
		
		while($qrow = $qresults->fetch_assoc()) {
			/* if already a convo between these 2 users, say nah */
			if (($qrow['sUsername'] == $sender && $qrow['rUsername'] == $recipient) || ($qrow['sUsername'] == $recipient && $qrow['rUsername'] == $sender)) {
				header("Location: ../messages.php?convoAlreadyExists=true");
				exit();
			}
		}
		
		$lastSent = date("L-m-d H:i:s");
		$sql = "INSERT INTO conversation (id, sUsername, rUsername, lastSent) VALUES (NULL, '$sender', '$recipient', UTC_TIMESTAMP());";
		$results = $db->query($sql);
		if($results == true) {
			header("Location: ../messages.php?create=success");
			exit();
		} else {
			header("Location: ../messages.php?create=failure");
			exit();
		}
	} else {
		header("Location: ../messages.php?error=badUser");
		exit();
	}
?>
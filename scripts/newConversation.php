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
			$user1 = $qrow['sUsername'];
			$user2 = $qrow['rUsername'];
			
			/* if already a convo between these 2 users, say nah */
			if (($user1 == $sender && $user2 == $recipient) || ($user1 == $recipient && $user2 == $sender)) {
				header("Location: ../messages.php?error=convoAlreadyExists");
				exit();
			}
		}
		
		/* make sure can only initiate conversation with friend */
		$query2 = "SELECT * FROM friends WHERE user1 = '$sender' and user2 = '$recipient'";
		$result2 = $db->query($query2);
		
		if ($result2->num_rows != 1) {
			header("Location: ../messages.php?error=notFriends");
			exit();
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
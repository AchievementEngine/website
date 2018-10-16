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

	$contents = $db->real_escape_string($_POST['contents']);
	$cid = $db->real_escape_string($_POST['cid']);
	$sender = $_SESSION['username'];

	//Check that conversation exists
	$sql = "SELECT * FROM conversation WHERE id = '$cid'";
	$result = $db->query($sql);
	if($results->num_rows == 0) {
		//Conversation exists
		$sql = "INSERT INTO messages (id, sender, contents, sendTime) VALUES ('$cid', '$sender', '$contents', UTC_TIMESTAMP());";
		$result = $db->query($sql);
		
		$sql2 = "UPDATE conversation SET lastSent = UTC_TIMESTAMP() WHERE id = '$cid'";
		$result2 = $db->query($sql2);
		
		if($result == true) {
			header("Location: ../messages.php?cid=".$cid."&message=success");
			exit();
		} else {
			header("Location: ../messages.php?cid=".$cid."&message=failure");
			exit();
		}
	}
?>
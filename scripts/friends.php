<?php
	include_once "connect.php";
	session_start();
	
	$username1 = $_SESSION['username'];
	
	if(isset($_GET['usernameGET'])) {
		$username2 = $_GET['usernameGET'];
		
		if (isset($_GET['friendReqGET'])) {
			$friendRequest = "INSERT INTO friendrequest (user1, user2) VALUES ('$username1', '$username2')";
			$result = $db->query($friendRequest);
			header("location: ../profile.php?username=$username2");
		}
		
		if (isset($_GET['friendNotifGET'])) {
			$friendApproved = "INSERT INTO friends (user1, user2) VALUES ('$username1', '$username2')";
			$friendApproved2 = "DELETE FROM friendrequest WHERE user2 = '$username1' AND user1 = '$username2'";
			$result2 = $db->query($friendApproved);
			$result3 = $db->query($friendApproved2);
			header("location: ../profile.php");
		}
		
		if (isset($_GET['unfriendGET'])) {
			$friendDelete = "DELETE FROM friends WHERE (user1 = '$username1' AND user2 = '$username2') OR (user2 = '$username1' AND user1 = '$username2')";
			$result4 = $db->query($friendDelete);
			header("location: ../profile.php?username=$username2");
		}
	}
?>
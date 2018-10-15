<?php
	include_once "connect.php";
	session_start();
	
	$usernameSESSION = $_SESSION['username'];
	
	if(isset($_GET['username'])) {
		$usernameGET = $_GET['username']; 
		
		//send friend request
		if (isset($_GET['friendReq'])) {
			$friendRequest = "INSERT INTO friendrequest (user1, user2) VALUES ('$usernameSESSION', '$usernameGET')";
			$result = $db->query($friendRequest);
			header("location: ../profile.php?username=$usernameGET");
		}
		
		//accept friend request
		if (isset($_GET['friendNotif'])) {
			if ($_GET['friendNotif'] == "true") {
				$friendApproved1 = "INSERT INTO friends (user1, user2) VALUES ('$usernameSESSION', '$usernameGET')";
				$friendApproved2 = "INSERT INTO friends (user2, user1) VALUES ('$usernameSESSION', '$usernameGET')";
				$friendApproved3 = "DELETE FROM friendrequest WHERE user1 = '$usernameGET' AND user2 = '$usernameSESSION'";
				$result1 = $db->query($friendApproved1);
				$result2 = $db->query($friendApproved2);
				$result3 = $db->query($friendApproved3);
				header("location: ../profile.php");
			} else {
				$friendDeclined = "DELETE FROM friendrequest WHERE user2 = '$usernameSESSION' AND user1 = '$usernameGET'";
				$result4 = $db->query($friendDeclined);
				header("location: ../profile.php");
			}
		}
		
		if (isset($_GET['unfriend'])) {
			$friendDelete1 = "DELETE FROM friends WHERE (user1 = '$usernameSESSION' AND user2 = '$usernameGET') OR (user2 = '$usernameSESSION' AND user1 = '$usernameGET')";
			$friendDelete2 = "DELETE FROM friends WHERE (user2 = '$usernameSESSION' AND user1 = '$usernameGET') OR (user2 = '$usernameSESSION' AND user1 = '$usernameGET')";
			$result5 = $db->query($friendDelete1);
			$result6 = $db->query($friendDelete2);
			header("location: ../profile.php?username=$usernameGET");
		}
		
		if (isset($_GET['cancelRequest'])) {
			$friendReqCancel = "DELETE FROM friendrequest WHERE user1 = '$usernameSESSION' AND user2 = '$usernameGET'";
			$result7 = $db->query($friendReqCancel);
			header("location: ../profile.php?username=$usernameGET");
		}
		
	} else {
		header("location: ../profile.php");
	}
?>
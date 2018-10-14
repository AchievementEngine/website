<?php
	include_once "connect.php";
	session_start();
	
	$usernameSESSION = $_SESSION['username'];
	
	if(isset($_GET['usernameGET'])) {
		$usernameGET = $_GET['usernameGET']; 
		
		//send friend request
		if (isset($_GET['friendReqGET'])) {
			$friendRequest = "INSERT INTO friendrequest (user1, user2) VALUES ('$usernameSESSION', '$usernameGET')";
			$result = $db->query($friendRequest);
			header("location: ../profile.php?username=$usernameGET");
		}
		
		//accept friend request
		if (isset($_GET['friendNotifGET'])) {
			if ($_GET['friendNotifGET'] == "true") {
				$friendApproved = "INSERT INTO friends (user1, user2) VALUES ('$usernameSESSION', '$usernameGET')";
				$friendApproved2 = "DELETE FROM friendrequest WHERE user1 = '$usernameGET' AND user2 = '$usernameSESSION'";
				$result2 = $db->query($friendApproved);
				$result3 = $db->query($friendApproved2) or die(mysqli_error($db));
				header("location: ../profile.php");
			} else {
				$friendDeclined = "DELETE FROM friendrequest WHERE user2 = '$usernameSESSION' AND user1 = '$usernameGET'";
				$result4 = $db->query($friendDeclined);
				header("location: ../profile.php");
			}
		}
		
		if (isset($_GET['unfriendGET'])) {
			$friendDelete = "DELETE FROM friends WHERE (user1 = '$usernameSESSION' AND user2 = '$usernameGET') OR (user2 = '$usernameSESSION' AND user1 = '$usernameGET')";
			$result5 = $db->query($friendDelete);
			header("location: ../profile.php?username=$usernameGET");
		}
		
		if (isset($_GET['cancelRequest'])) {
			$friendReqCancel = "DELETE FROM friendrequest WHERE user1 = '$usernameSESSION' AND user2 = '$usernameGET'";
			$result6 = $db->query($friendReqCancel);
			header("location: ../profile.php?username=$usernameGET");
		}
		
	} else {
		header("location: ../profile.php");
	}
?>
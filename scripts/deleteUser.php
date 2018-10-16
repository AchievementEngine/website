<?php
	include_once "connect.php";
	session_start();
	
	if(isset($_GET['deleteUser'])) {
		$username1 = $_SESSION['username'];		//admin
		$username2 = $_GET['deleteUser'];		//to be deleted
		//make sure that not vulnerable to sql injection, by once again checking that the user deleting the other person is greater in admin rights
		$userAdmin1 = "SELECT * FROM users WHERE username = '$username1'";
		$userAdmin2 = "SELECT * FROM users WHERE username = '$username2'";
		$admin1Results = $db->query($userAdmin1);
		$admin2Results = $db->query($userAdmin2);
		while ($admin1Row = $admin1Results->fetch_assoc()) {
			$admin1 = $admin1Row['admin'];
		} 
		while ($admin2Row = $admin2Results->fetch_assoc()) {
			$admin2 = $admin2Row['admin'];
		} 
		if ($admin1 > $admin2) { 		
			$deleteUser1 = "DELETE FROM ugames WHERE username = '$username2'";
			$deleteUser2 = "DELETE FROM uachievements WHERE username = '$username2'";
			$deleteUser3 = "DELETE FROM friendrequest WHERE user1 = '$username2' OR user2 = '$username2'";
			$deleteUser4 = "DELETE FROM friends WHERE user1 = '$username2' OR user2 = '$username2'";
			$deleteUser5 = "DELETE FROM users WHERE username = '$username2'";
			
			$db->query($deleteUser1);
			$db->query($deleteUser2);
			$db->query($deleteUser3);
			$db->query($deleteUser4);
			$db->query($deleteUser5);
		}
		header("location: ../profile.php");
	}
	
	if(isset($_GET['deleteSelf'])) {
		$username = $_SESSION['username'];
		$delete1 = "DELETE FROM ugames WHERE username = '$username'";
		$delete2 = "DELETE FROM uachievements WHERE username = '$username'";
		$delete3 = "DELETE FROM friendrequest WHERE user1 = '$username' OR user2 = '$username'";
		$delete4 = "DELETE FROM friends WHERE user1 = '$username' OR user2 = '$username'";
		$delete5 = "DELETE FROM users WHERE username = '$username'";
		
		$db->query($delete1);
		$db->query($delete2);
		$db->query($delete3);
		$db->query($delete4);
		$db->query($delete5);
		
		header("location: logout.php");
	}
?>
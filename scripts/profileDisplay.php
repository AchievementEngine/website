<?php
	if(isset($_GET['username'])) {
		$username = $_GET['username'];
	} else {
		$username = $_SESSION['username'];
	}
	$user = "SELECT * FROM users WHERE username='$username'";
	$results = $db->query($user);
	$row = $results->fetch_array(MYSQLI_ASSOC);
	
	$dispName = $row['dispName'];
	$fname = $row['fname'];
	$lname = $row['lname'];
	$country = $row['country'];
	$about = $row['about'];		
	
	$featuredAch = $row['featuredach'];
	if (empty($row['featuredach'])) {
		$featuredAch = "no_ach";
		$achName = "No achievement";
		$gameName = "No achievement";
		$gameStr = "no_ach";
	} else {
		$ach = "SELECT * FROM achievements WHERE achStr='$featuredAch'";
		$achResults = $db->query($ach);
		$achRow = $achResults->fetch_array(MYSQLI_ASSOC);
		$achName = $achRow['achName'];
	
		$gameID = $achRow['gameID'];
		$game = "SELECT * FROM games WHERE gameID='$gameID'";
		$gameResults = $db->query($game);
		$gameRow = $gameResults->fetch_array(MYSQLI_ASSOC);
		$gameName = $gameRow['gameName'];
		$gameStr = $gameRow['gameStr'];
	}
?>
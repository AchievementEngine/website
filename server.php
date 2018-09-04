<?php
	session_start();

	// initializing variables
	$username = "";
	$email = "";

	$hostname = 'localhost';
	$username = 'root';
	$password = '';
	$database = 'login';
	
	// connect to the database
	$db = new mysqli($hostname, $username, $password, $database);

	/*if(!empty($_POST['username'])) {
		echo "COOL = ".$_POST['username'];
	} else {
		echo "NAYUSTY";
	} 

	if($db->ping()) {
		echo "CONNEKTED";
	} else {
		echo "NEIN";
	}*/

	
	// EDIT USER PROFILE
	if (isset($_POST['edit_profile'])) {
		$username = $_SESSION["username"];
		$dispName = mysqli_real_escape_string($db, $_POST['dispName']);
		$email = mysqli_real_escape_string($db, $_POST['email']);
		$fname = mysqli_real_escape_string($db, $_POST['fname']);
		$lname = mysqli_real_escape_string($db, $_POST['lname']);
		$country = mysqli_real_escape_string($db, $_POST['country']);
		$about = mysqli_real_escape_string($db, $_POST['about']);
		
		$query = "UPDATE users SET dispName = '$dispName', email = '$email', fname = '$fname', lname = '$lname', country = '$country', about = '$about' WHERE username = '$username'";
		$results = $db->query($user);
		mysqli_query($db, $query);
		
		header("location: profile.php?username=$username");
	}
	
	// VISIT USER PROFILE
	if (isset($_POST['profile'])) {
		$username = $_SESSION["username"];
		header("location: profile.php?username=$username");
	}	
?>
<?php
include_once "connect.php";
session_start();

if (isset($_POST['login_user'])) {

	$username = strtolower($db->real_escape_string($_POST['username']));
	$password = $db->real_escape_string($_POST['password']);
			
	//if no error
	if (count($errors) == 0) {
		//get user from database
		$user = "SELECT * FROM users WHERE username='$username'";
		$results = $db->query($user);

		if ($results->num_rows == 1) {
			$row = $results->fetch_assoc();

			//check correct username/password combination
			if (password_verify($password, $row['pword'])) {
				$_SESSION['username'] = $username;
				
				//open profile page of user logging in
				header("Location: profile.php?username=$username");
				exit();
			} else {
				$login_error = "Username and password do not match";
			}
		} else {	//if no results (or somehow multiple results)
			$login_error = "Username and password do not match";
		}
	}
}
?>
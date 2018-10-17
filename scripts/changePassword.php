<?php
	include_once "connect.php";
	session_start();

	$username = $_SESSION["username"];
	$currentPass = $db->real_escape_string($_POST['currentPass']);
	$newPass1 = $db->real_escape_string($_POST['newPass1']);
	$newPass2 = $db->real_escape_string($_POST['newPass2']);
	
	$user = "SELECT * FROM users WHERE username='$username'";
	$results = $db->query($user);

	if ($results->num_rows == 1) {
		$row = $results->fetch_assoc();
		if (password_verify($currentPass, $row['pword'])) {
			if ($newPass1 == $newPass2) {
				$options = ['cost' => 10];	//algorithmic cost for password. default 10. salt created automatically.
				$hashed_password = password_hash($newPass1, PASSWORD_DEFAULT, $options);	//encrypt the password before saving in the database

				//create user in database
				$queryPass = "UPDATE users SET pword = '$hashed_password' WHERE username = '$username'";
				$resultPass = $db->query($queryPass);
				$_SESSION['password_success'] = "Password has been successfully changed.";
			} else {
				$_SESSION['password_error2'] = "Password cannot be updated. Passwords do not match.";
			}
		} else {
			$_SESSION['password_error1'] = "Password cannot be updated. Current password incorrect.";
		}
	}
	header("location: ../editProfile.php");
?>
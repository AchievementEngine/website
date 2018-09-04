<?php
include_once "connect.php";
session_start();

// receive all input values from the form
if (isset($_POST['reg_user'])) {
	$dispName = $db->real_escape_string($_POST['username']);
	$username = strtolower($db->real_escape_string($_POST['username']));	//remove special characters so sql injection minimised
	$email = $db->real_escape_string($_POST['email']);
	$password_1 = $db->real_escape_string($_POST['password_1']);
	$password_2 = $db->real_escape_string($_POST['password_2']);
	$errors = 0;

	// form validation: ensure that the form is correctly filled ...
	if ($password_1 != $password_2) {
		$pass_error = "The two passwords do not match";
	}

	// ensure username or password does not exist yet
	$user_check_query = "SELECT * FROM users WHERE username='$username' OR email='$email'";
	$result = $db->query($user_check_query);
	$user = $result->fetch_assoc();

	if ($user) { // if user exists
		$errors++;
		if ($user['username'] === $username) {
			$name_error = "Username already exists";
		}

		if ($user['email'] === $email) {
			$email_error = "Email already exists";
		}
	}
	
	// Finally, register user if there are no errors in the form
	if ($errors == 0) {
		$options = ['cost' => 10];	//algorithmic cost for password. default 10. salt created automatically.
		$hashed_password = password_hash($password_1, PASSWORD_DEFAULT, $options);	//encrypt the password before saving in the database

		//create user in database
		$query = "INSERT INTO users (username, email, pword, dispName) VALUES('$username', '$email', '$hashed_password', '$dispName')";
		$result = $db->query($query);
		
		$_SESSION['registered'] = "You have successfully registered!";
		
		//create default profile image
		$file = dirname(__DIR__)."/data/uploads/defaultProfile.png";			//
		$newfile = dirname(__DIR__)."/data/uploads/$username.png";
		if (!copy($file, $newfile)) {
			echo "failed to copy";
		}
		
		//redirect user to login page
		header("location: login.php");
		exit();
	}
}
?>
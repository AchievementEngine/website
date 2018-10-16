<?php
include_once "connect.php";
session_start();

if(isset($_POST['submit_password']) && $_POST['email'] && $_POST['password']) {
	$email=$_POST['email'];
	$pass=$_POST['password'];
	$options = ['cost' => 10];
	$hashed_password = password_hash($pass, PASSWORD_DEFAULT, $options);
	
	$select="update users set pword='$hashed_password' where MD5(email)='$email'";
	$results = $db->query($select);
	
	echo "Password succcessfully reset <br>";
	echo "<a href='../login.php' class='button'>Sign in</a>";
}
?>
<?php
include_once "connect.php";
session_start();

if(isset($_POST['submit_email']) && $_POST['email']) {
	$email = $_POST['email'];
	$select = "select * from users where email='$email'";
	$results = $db->query($select);
	
	if(mysqli_num_rows($results) == 1) {
		while ($row = $results->fetch_assoc()) {
			$md5email=md5($row['email']);
			$md5pass=md5($row['pword']);
		}
		$to = $email;
		$subject = "Password reset";
		$msg = "Click to Reset password\n http://www.achievement-engine.com/website/scripts/reset.php?key=".$md5email."&reset=".$md5pass."'";
		$header = "From: noreply@achievement-engine.com";
		$params = "-f noreply@achievement-engine.com";

		mail($to, $subject, $msg, $header, $params);
		
		/*
		todo include a token
		generate rand 12 length string, add to users table
		include in email, make it part of the address
		if token no match, could be someone else changing 
		*/
	}	
}
?>

<html>
<p>Click the link we sent to your email, to reset your password</p>
</html>
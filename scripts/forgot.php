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
<<<<<<< HEAD
		
		//echo "Click the link sent to your email to reset your password";		
	}	
}
?>
<!DOCTYPE html>
<html>
<head>
	<link rel="icon" href="../data/teamae.png">
	<link rel="stylesheet" type="text/css" href="../data/style.css">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous">
	<link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet"> 
	<title>Forgot Password</title>
</head>
<body>
	<header>
		
	</header>
	
	<div class="body">
		<div>
			<img src='../data/AELogo2Light.png' align='right' height='80px'>
		</div>
		
		<br><br><br><br><br><br>
		<div class="content">
			<div class="topInfo" style="margin-left:7%;">
				<div class="username" style="text-align:left">Reset Password</div>
			</div>
			
			<div class="inputInfo" style="padding-left: 5%;">
				Click the link sent to your email to reset your password
			</div>
			
		</div>
	</div>
</body>
</html> 
=======
	}	
}
?>

<html>
<p>Click the link we sent to your email, to reset your password</p>
</html>
>>>>>>> 6fcef672386923dd16a457623aa2eda7ac74f9c9

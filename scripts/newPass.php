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
	
	//echo "Password succcessfully reset <br>";
	//echo "<a href='../login.php' class='button'>Sign in</a>";
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
				Password succcessfully reset <br>
				<a href='../login.php' class='button'>Sign in</a>
			</div>
			
		</div>
	</div>
</body>
</html> 

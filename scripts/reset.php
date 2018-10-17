<?php
include_once "connect.php";
session_start();

if($_GET['key'] && $_GET['reset'])
{
	$email=$_GET['key'];
	$pass=$_GET['reset'];
	$md5email = md5($email);
	$md5pass = md5($pass);
	
	$select="select * from users where MD5(email)='$email' and MD5(pword)='$pass'";
	$results = $db->query($select);
	
	if (mysqli_num_rows($results) == 1) {
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
						<form method="post" action="newPass.php">
							<input type="hidden" name="email" value="<?php echo $email;?>">
							
							<p>Enter New password</p>
							<input type="password" name='password'>
							
							<input type="submit" name="submit_password">
						</form>
					</div>
					
				</div>
			</div>
		</body>
		</html> 
	<?php }
} ?>
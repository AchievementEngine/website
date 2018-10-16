<?php include('scripts/login.php') ?>
<!DOCTYPE html>
<html>
<head>
	<link rel="icon" href="data/teamae.png">
	<link rel="stylesheet" type="text/css" href="data/style.css">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous">
	<link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet"> 
	<title>Forgot Password</title>
</head>
<body>
	<header>
		
	</header>
	
	<div class="body">
		<div>
			<img src='data/AELogo2Light.png' align='right' height='80px'>
		</div>
		
		<br><br><br><br><br><br>
		<div class="content">
			<div class="topInfo">
				<div class="username" style="text-align:left">Reset Password</div>
			</div>
			
			<form method="post" action="forgot.php">				
				
				<div class="inputInfo">
					<label>Email</label>
					<input type="text" name="username" required>
					<br><br>
				</div>
				
				<div class="inputInfo">
					<label><button type="submit" class="button" name="reset_pass">Reset</button></label>
				</div>
				<br><br><br><br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(this sends you an email)
			</form>
			<br><br><br><br><br><br>
			<div class="inputInfo">
				<p style="padding-left: 70px">Remembered your password? 
					<a href="login.php" class="button">Sign in</a>
				</p>
			</div>
		</div>
	</div>
</body>
</html> 
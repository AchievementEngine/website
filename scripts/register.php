<?php include('scripts/signup.php') ?>
<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="data/style.css">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous">
	<link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet"> 
	<title>Register</title>
</head>
<body>
	<div id="mySidenav" class="sidenav">
	  <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
	  <a href="Achievements.php">My Achievements</a>
	  <a href="index.php">About</a>
	</div>
	
	<header>
		
	</header>
	
	<div class="body">
		<div>
			<img src='data/AELogo2Light.png' align='right' height='80px'>
		</div>
		
		<br><br><br><br><br><br>
		<div class="content">
			<div class="topInfo">
				<div class="username" style="text-align:left">Register</div>
			</div>
			<form method="post" action="register.php">
				<div class="inputInfo">
					<?php if (isset($name_error)): ?>
						<p style="padding-left: 200px; color: red"><?php echo $name_error; unset($name_error);?></p>
					<?php endif ?>
					<label>Username</label>
					<input type="text" name="username" required>
					<br><br>
				</div>
				
				<div class="inputInfo">
					<?php if (isset($email_error)): ?>
						<p style="padding-left: 200px; color: red"><?php echo $email_error; unset($email_error); ?></p>
					<?php endif ?>
					<label>Email</label>
					<input type="email" name="email" required><br><br>
				</div>
				
				<div class="inputInfo">
					<?php if (isset($pass_error)): ?>
						<p style="padding-left: 200px; color: red"><?php echo $pass_error; unset($pass_error); ?></p>
					<?php endif ?>
					<label>Password</label>
					<input type="password" name="password_1" required><br><br>
				</div>
				
				<div class="inputInfo">
					<label>Confirm password</label>
					<input type="password" name="password_2" required><br><br>
				</div>
				
				<div class="inputInfo">
					<label><button type="submit" class="button" name="reg_user">Register</button></label>
				</div>
			</form>
			<br><br><br><br><br><br>
			<div class="inputInfo">
				<p style="padding-left: 70px">Already a member? 
					<a href="login.php" class="button">Sign in</a>
				</p>
			</div>
		</div>
	</div>
</body>
</html> 
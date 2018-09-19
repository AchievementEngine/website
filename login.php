<?php include('scripts/login.php') ?>
<!DOCTYPE html>
<html>
<head>
	<link rel="icon" href="data/teamae.png">
	<link rel="stylesheet" type="text/css" href="data/style.css">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous">
	<link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet"> 
	<title>Login</title>
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
				<div class="username" style="text-align:left">Login</div>
			</div>
			<?php  if (isset($_SESSION['registered'])) : ?>
				<div class="success">
					<p style="padding-left: 200px; color: green; font-size: 15pt">
						<?php 
							echo $_SESSION['registered']; 
							unset($_SESSION['registered']);
						?>
					</p>
				</div>
			<?php endif ?>	
			<form method="post" action="login.php">				
				<?php if (isset($login_error)): ?>
					<p style="padding-left: 200px; color: red; font-size: 15pt">
						<?php
							echo $login_error; 
							unset($login_error); 
						?>
					</p>
				<?php endif ?>
				<div class="inputInfo">
					<label>Username</label>
					<input type="text" name="username" required>
					<br><br>
				</div>
				
				<div class="inputInfo">
					<label>Password</label>
					<input type="password" name="password" required>
					<br><br>
				</div>
				
				<div class="inputInfo">
					<label><button type="submit" class="button" name="login_user">Login</button></label>
				</div>
			</form>
			<br><br><br><br><br><br>
			<div class="inputInfo">
				<p style="padding-left: 70px">Not yet a member? 
					<a href="register.php" class="button">Sign up</a>
				</p>
			</div>
		</div>
	</div>
</body>
</html> 
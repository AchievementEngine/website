<!--
<html>
  <body>
    <form method="post" action="scripts/forgot.php">
      <p>Enter Email Address To Send Password Link</p>
      <input type="text" name="email">
      <input type="submit" name="submit_email">
    </form>
  </body>
</html>

-->

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
		
			<form method="post" action="scripts/forgot.php">
			  <p>Please enter the email address associated with your account.</p>
			  <br>
			  <input type="text" name="email"><br><br><br>
			  <button type="submit" class ="button" name="submit_email">Submit</button>
			</form>
		</div>
	</div>
</body>
</html> 

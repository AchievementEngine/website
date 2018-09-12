<?php 
	session_start();
	include_once "scripts/connect.php";
	
	$username = $_SESSION['username'];
	$user = "SELECT * FROM users WHERE username='$username'";
	$results = $db->query($user);
	$row = $results->fetch_array(MYSQLI_ASSOC);
	$dispName = $row['dispName'];
	$email = $row['email'];
	$fname = $row['fname'];
	$lname = $row['lname'];
	$country = $row['country'];
	$discord = $row['discord'];

	$achArray = array();
	$query = "SELECT a.achName FROM uachievements u INNER JOIN achievements a ON u.achStr = a.achStr AND u.gameID = a.gameID INNER JOIN games g ON a.gameID = g.gameID WHERE u.username='$username' AND u.progress = a.achValue";
	$queryResults = $db->query($query);
	while ($queryRow = $queryResults->fetch_assoc()) {
		array_push($achArray, $queryRow['achName']);
	}
	
	//check user is logged in
	if (!isset($_SESSION['username'])) {
		$_SESSION['msg'] = "You must log in first";
		header('location: login.php');
	}
	
	if (isset($_GET['logout'])) {
		session_destroy();
		unset($_SESSION['username']);
		header("location: login.php");
	}
?>

<!DOCTYPE html>
<html>
<head>
	<?php include ('include/header.php'); ?>
	<title>Edit Profile</title>
</head>
<body>
	<?php include ('include/sideNav.php'); ?>
	<?php include ('include/header2.php'); ?>
	
	<div class="body">
		<div class="profilePic">
			<?php echo "<img src='data/uploads/".$username.".png' height='200px'>"; ?> <!-- User profile pic -->
		</div>
		
		<div class="content" style="overflow:hidden">	<!-- overflow makes sure the grey box actually covers the content. temporary hopefully -->
			<div class="topInfo">
				<div class="username" style="text-align:left">Edit Profile</div>
			</div>
			
			<?php  if (isset($_SESSION['profile_updated'])) : ?>
				<div>
					<p style="padding-left: 200px; color: green; font-size: 15pt">
						<?php 
							echo $_SESSION['profile_updated']; 
							unset($_SESSION['profile_updated']);
						?>
					</p>
				</div>
			<?php endif ?>	
			
			<?php  if (isset($_SESSION['profile_failed'])) : ?>
				<div>
					<p style="padding-left: 200px; color: red; font-size: 15pt">
						<?php 
							echo $_SESSION['profile_failed']; 
							unset($_SESSION['profile_failed']);
						?>
					</p>
				</div>
			<?php endif ?>	
			
			<?php  if (isset($_SESSION['email_error'])) : ?>
				<div>
					<p style="padding-left: 200px; color: red; font-size: 15pt">
						<?php 
							echo $_SESSION['email_error']; 
							unset($_SESSION['email_error']);
						?>
					</p>
				</div>
			<?php endif ?>	
			<form action="scripts/editProfile.php" method="post">
				<div class="inputInfo">
					<label>Display Name</label>
					<input type="text" name="dispName" value="<?php echo $dispName; ?>" required><br><br>	<!-- preset fields to what already is -->
				</div>
				
				<div class="inputInfo">
					<label>Email</label>
					<input type="email" name="email" value="<?php echo $email; ?>" required><br><br>
				</div>
					
				<div class="inputInfo">
					<label>First Name</label>
					<input type="text" name="fname" value="<?php echo $fname; ?>"><br><br>
				</div>
				
				<div class="inputInfo">
					<label>Last Name</label>
					<input type="text" name="lname" value="<?php echo $lname; ?>"><br><br>
				</div>
				
				<div class="inputInfo">
					<label>Country</label>
					<input type="text" name="country"  value="<?php echo $country; ?>"><br><br>
				</div>
				
				<div class="inputInfo">
					<label>Discord</label>
					<input type="text" name="discord"  value="<?php echo $discord; ?>"><br><br>
				</div>

				<div class="inputInfo">
					<label><button type="submit" class="button" name="edit_profile">Confirm</button></label>
				</div>
			</form>
			
			<br><br><br><br><br><hr><br><br>	<!-- one of these is a HR not a BR -->
			
			
			<form action="scripts/upload.php" method="POST" enctype="multipart/form-data">
				<div class="inputInfo" style="padding-left: 55px">
					<label class="custom-file-upload">
						<input type="file" name="file" accept="image/png, image/jpeg"> Choose new avatar
					</label>
					<button type="submit" name="submit" class="button">Upload</button>
					<p style="font-size: 18px"> (Click confirm before choosing avatar, unless you didn't make any changes) </p>
				</div>
			</form>
			
			<br><br><hr><br><br>		<!-- one hr as well -->
			<?php 
				$query1 = "SELECT a.achName FROM users u JOIN achievements a ON a.achStr = u.featuredach WHERE username = '$username'";
				$queryResults = $db->query($query1);
				while ($queryRow = $queryResults->fetch_assoc()) {
					$achStr = $queryRow['achName'];
				}
			?>
			<form action="scripts/editAchievements.php" method="POST">
				<div class="inputInfo">
					<label>Featured Achievement</label>
					<select name="achList" class="styled-select">
						<option>No Achievement</option>
						<?php foreach($achArray as $ach) { ?>
							<?php if ($achStr == $ach) { ?>
								<option value="<?php echo $ach; ?>" selected><?php echo $ach; ?></option>
							<?php } else { ?>
								<option value="<?php echo $ach; ?>"><?php echo $ach; ?></option>
							<?php }
						} ?>
					</select>
				</div>
				<div class="inputInfo">
					<label><button type="submit" class="button" name="edit_achievements">Confirm</button></label>
				</div>
			</form>
		</div>
	</div>
	<?php include ('include/friendFooter.php'); ?>
</body>

<?php include ('include/profileDropdown.php'); ?>

</html> 
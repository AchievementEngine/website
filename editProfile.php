<?php 
	//include('scripts/editProfile.php');
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
	$about = $row['about'];
	//$featuredAch = $row['featuredAch'];	//TODO maybe gonna fuck up
	$achArray = array();
	$uachievements = "SELECT * FROM uachievements WHERE username='$username'";
	$achResults = $db->query($uachievements);
	if ($achResults == true) {
		while ($achRow = $achResults->fetch_assoc()) {
			array_push($achArray, $achRow['achStr']);
		}
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
	<link rel="stylesheet" type="text/css" href="data/style.css">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous">
	<link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet"> 
	<title>Profile</title>
</head>
<body>
	<div id="mySidenav" class="sidenav">
	  <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
	  <a href="Achievements.php">My Achievements</a>
	  <a href="index.php">About</a>
	</div>
	
	<header>
		<div class="left headLeft">
			<div class="farleft">
				<span onclick="openNav()"><img src="https://cdn3.iconfinder.com/data/icons/trico-circles-solid/24/Circle-Solid-List-512.png" height="40px"></span> 
			</div>
			<div class="left">
				<a href="home.php"> <img src="data/AELogo2Light.png" height="40px"></a>
			</div>
			<form method="post" action="search.php">
				<div class="searchzone">
					<input type="text" name="search" class="searchBox" placeholder="Search...">
					<button style="font-family:FontAwesome"><i class="fas fa-search"></i></button>
				</div>
			</form>
		</div>
		<div class="right">
			<div class="topLink">
				<a href="liveAchievement.php"><i class="fas fa-gamepad"></i></a>
			</div>
			<div class="dropdown">
				<?php echo "<button onclick='myFunction()' class='dropbtn' style='background-image: url(data/uploads/".$_SESSION['username'].".png)'></button> "?>
				<div id="myDropdown" class="dropdown-content">
					<form method="post" action="profile.php">
						<button type="submit" class="button" name="profile">My Profile</button>
					</form>
					<form method="post" action="editProfile.php">
						<button type="submit" class="button" name="editProfile">Edit Profile</button>
					</form>
					<a href="logout.php">Log Out</a>
				</div>
			</div>
		</div>
	</header>
	
	<div class="body">
		<div class="profilePic">
			<?php echo "<img src='data/uploads/".$username.".png' height='200px'>"; ?> <!-- User profile pic -->
		</div>
		
		<div class="content">
			<div class="topInfo">
				<div class="username" style="text-align:left">Edit Profile</div>
			</div>
			
			<?php  if (isset($_SESSION['profile_updated'])) : ?>
				<div class="success">
					<p style="padding-left: 200px; color: green; font-size: 15pt">
						<?php 
							echo $_SESSION['profile_updated']; 
							unset($_SESSION['profile_updated']);
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
					<label>About</label>
					<textarea maxlength="200" rows="5" name="about"><?php echo $about; ?></textarea><br><br>
				</div>

				<div class="inputInfo">
					<label><button type="submit" class="button" name="edit_profile">Confirm</button></label>
				</div>
			</form>
			
			<br><br><br><br><br><br><br>
			
			<form action="scripts/upload.php" method="POST" enctype="multipart/form-data">
				<div class="inputInfo" style="padding-left: 55px">
					<label class="custom-file-upload">
						<input type="file" name="file" accept="image/png, image/jpeg"> Choose new avatar
					</label>
					<button type="submit" name="submit" class="button">Upload</button>
					<p style="font-size: 18px"> (Click confirm before choosing avatar, unless you didn't make any changes) </p>
				</div>
			</form>
			
			<br><br><br><br>
			
			<form action="scripts/editAchievements.php" method="POST">
				<div class="inputInfo">
					<label>Featured Achievement</label>
					<select name="achList" class="styled-select">
						<?php foreach($achArray as $ach) { ?>
							<option value="<?php echo $ach; ?>"><?php echo $ach; ?></option>
						<?php } ?>
					</select>
				</div>
				<div class="inputInfo">
					<label><button type="submit" class="button" name="edit_achievements">Confirm</button></label>
				</div>
			</form>
			
		</div>
	</div>
</body>

<script>
	/* Set the width of the side navigation to 250px */
	function openNav() {
		document.getElementById("mySidenav").style.width = "250px";
	}

	/* Set the width of the side navigation to 0 */
	function closeNav() {
		document.getElementById("mySidenav").style.width = "0";
	}

	/* When the user clicks on the button, 
	toggle between hiding and showing the dropdown content */
	function myFunction() {
		document.getElementById("myDropdown").classList.toggle("show");
	}

	function showIM() {
		document.getElementById("im").classList.toggle("show");
	}

	// Close the dropdown menu if the user clicks outside of it
	window.onclick = function(event) {
	  if (!event.target.matches('.dropbtn')) {

		var dropdowns = document.getElementsByClassName("dropdown-content");
		var i;
		for (i = 0; i < dropdowns.length; i++) {
		  var openDropdown = dropdowns[i];
		  if (openDropdown.classList.contains('show')) {
			openDropdown.classList.remove('show');
		  }
		}
	  }
	}
</script>

</html> 
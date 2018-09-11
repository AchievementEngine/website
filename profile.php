<?php 
	include_once "scripts/connect.php";
	//include "scripts/profileDisplay.php";

	session_start();

	if(!isset($_SESSION['username'])) {
		header("location: login.php");
		exit();
	}
	
	if(isset($_GET['username'])) {
		$username = $_GET['username'];
	} else {
		$username = $_SESSION['username'];
	}
	$user = "SELECT * FROM users WHERE username='$username'";
	$results = $db->query($user);
	$row = $results->fetch_array(MYSQLI_ASSOC);
	
	$dispName = $row['dispName'];
	$fname = $row['fname'];
	$lname = $row['lname'];
	$country = $row['country'];
	$discord = $row['discord'];		
	
	$featuredAch = $row['featuredach'];
	if (empty($row['featuredach'])) {
		$featuredAch = "no_ach";
		$achName = "No achievement";
		$gameName = "No achievement";
		$gameStr = "no_ach";
		$achType = "nil";
	} else {
		$ach = "SELECT * FROM achievements WHERE achStr='$featuredAch'";
		$achResults = $db->query($ach);
		$achRow = $achResults->fetch_array(MYSQLI_ASSOC);
		$achName = $achRow['achName'];
		//todo can probably join the two selects and make it a lot 
		$achType = $achRow['achType'];
		$gameID = $achRow['gameID'];
		$game = "SELECT * FROM games WHERE gameID='$gameID'";
		$gameResults = $db->query($game);
		$gameRow = $gameResults->fetch_array(MYSQLI_ASSOC);
		$gameName = $gameRow['gameName'];
		$gameStr = $gameRow['gameStr'];
	}
	/* Figure out total number of achievements */
	$totAch = "SELECT * FROM uachievements u INNER JOIN achievements a ON u.achStr = a.achStr AND u.gameID = a.gameID WHERE u.username='$username' AND a.achValue = u.progress";
	$totAchResults = $db->query($totAch);
	$totalAchs = mysqli_num_rows($totAchResults);
	
	/* figure out total number of bronze, silver, gold, and diamond achievements */
	$totBronze = "SELECT * FROM uachievements u INNER JOIN achievements a ON u.achStr = a.achStr AND u.gameID = a.gameID WHERE u.username='$username' AND a.achType='bronze' AND a.achValue = u.progress";
	$totBronzeResults = $db->query($totBronze);
	$totalBronzes = mysqli_num_rows($totBronzeResults);
	
	$totSilver = "SELECT * FROM uachievements u INNER JOIN achievements a ON u.achStr = a.achStr AND u.gameID = a.gameID WHERE u.username='$username' AND a.achType='silver' AND a.achValue = u.progress";
	$totSilverResults = $db->query($totSilver);
	$totalSilvers = mysqli_num_rows($totSilverResults);
	
	$totGold = "SELECT * FROM uachievements u INNER JOIN achievements a ON u.achStr = a.achStr AND u.gameID = a.gameID WHERE u.username='$username' AND a.achType='gold' AND a.achValue = u.progress";
	$totGoldResults = $db->query($totGold);
	$totalGolds = mysqli_num_rows($totGoldResults);
	
	$totDiamond = "SELECT * FROM uachievements u INNER JOIN achievements a ON u.achStr = a.achStr AND u.gameID = a.gameID WHERE u.username='$username' AND a.achType='diamond' AND a.achValue = u.progress";
	$totDiamondResults = $db->query($totDiamond);
	$totalDiamonds = mysqli_num_rows($totDiamondResults);
	
	//check user is logged in
	if (!isset($_SESSION['username'])) {
		$_SESSION['msg'] = "You must log in first";
		header('location: login.php');
	}
	
	//logout button
	if (isset($_GET['logout'])) {
		session_destroy();
		unset($_SESSION['username']);
		header("location: login.php");
	}
?>

<!DOCTYPE html>
<html>
<head>
	<link rel="icon" href="data/teamae.png">
	<link rel="stylesheet" type="text/css" href="data/style.css">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous">
	<link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet"> 
	<title>Profile</title>
</head>
<body>
	<div id="mySidenav" class="sidenav">
	  <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
	  <a href="achievements.php">My Achievements</a>
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
					<button style="font-family:FontAwesome;height:40px;width:40px;border-radius:10%"><i class="fas fa-search"></i></button>
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
					<a href="profile.php">My Profile</a>
					<a href="editProfile.php">Edit Profile</a>
					<a href="scripts/logout.php">Log Out</a>
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
				<div class="username"><?= $dispName." "; ?><img src="data/700achscore.png" height="70px"></div><!-- User selected badge here -->
				<div class="achOverview">
					<i class="fas fa-circle" style="color:#CD7F32"></i> <?= $totalBronzes ?><!-- Bronze num of ach here --> 
					<i class="fas fa-circle" style="color:#C0C0C0"></i> <?= $totalSilvers ?><!-- Silver num of ach here --> 
					<i class="fas fa-circle" style="color:#FFD700"></i> <?= $totalGolds ?><!-- Gold num of ach here --> 
					<i class="fas fa-circle" style="color:#5bb9e2"></i> <?= $totalDiamonds ?><!-- Platinum num of ach here -->
				</div>
			</div>
			<div class="moreInfo">
				<span class="sideBar">
					<div class="featuredAch">
						<?php echo "<img src='data/achievements/".$gameStr."/".$featuredAch.".png' height='70px'>"; ?> <!-- Pic of featured ach here -->
						<div class="featureInfo">
							<div class="featureName">
								<?php
								if($achType == "bronze") {
									echo "<i class='fas fa-circle' style='color:#CD7F32'></i>";
								} else if($achType == "silver") {
									echo "<i class='fas fa-circle' style='color:#C0C0C0'></i>";
								} else if($achType == "gold") {
									echo "<i class='fas fa-circle' style='color:#FFD700'></i>";
								} else if($achType == "diamond") {
									echo "<i class='fas fa-circle' style='color:#5bb9e2'></i>";
								} else if($achType == "nil") {
									echo "<i class='fas fa-circle' style='color:#000000'></i>";
								}
								echo " ".$achName;
								?>
								
							</div>
							<div class="featureGame">
								<?= $gameName ?><!-- Game of featured ach here -->
							</div>
						</div>
					</div>
					<div class="personal">
						<table>
							<tr>
								<td class="tabIcon"><i class="fas fa-map-marker"></i></td>
								<td>
									<?= $country; ?><!-- Location of user here -->
								</td>
							</tr>
							<tr>
								<td class="tabIcon"><i class="fas fa-id-card"></i></td>
								<td>
									<?= $fname . " " . $lname; ?>
								</td>
							</tr>
							<tr>
								<td class="tabIcon"><i class="fab fa-discord"></i></td>
								<td>
									<?= $discord; ?><!-- Discord/Link to other platform of user here -->
								</td>
							</tr>
							<tr>
								<td class="tabIcon"><i class="fas fa-trophy"></i></td>
								<td>
									<?= $totalAchs; ?> Achievements<!-- total num of ach here -->
								</td>
							</tr>
							<tr>
								<td class="tabIcon"><i class="fas fa-gamepad"></i></td>
								<td class="ingame">
									Fortnite<!-- Currently playing here -->
								</td>
							</tr>
						</table>
					</div>
				</span>
				
			</div>
			
		</div>		
	</div>
	
	<div class="imdown">
			<button onclick="showIM()" class="imbtn"></button>
			 <div id="im" class="im-content">
				<div class="friend">
					<div class="friendPic">
						<img src="data/defaultpp.png" height="40px">
					</div>
					<div class="friendInfo">
						<div class="friendName">
							Dave
						</div>
						<div class="friendStatus ingame">
							CS:GO
						</div>
					</div>
				</div>
				<div class="friend">
					<div class="friendPic">
						<img src="data/defaultpp.png" height="40px">
					</div>
					<div class="friendInfo">
						<div class="friendName">
							Trev
						</div>
						<div class="friendStatus ingame">
							Fortnite
						</div>
					</div>
				</div>
				<div class="friend">
					<div class="friendPic">
						<img src="data/defaultpp.png" height="40px">
					</div>
					<div class="friendInfo">
						<div class="friendName">
							Rod
						</div>
						<div class="friendStatus away">
							Away
						</div>
					</div>
				</div>
			 </div>
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
	if (!event.target.matches('.imbtn')) {
		var dropdowns = document.getElementsByClassName("im-content");
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
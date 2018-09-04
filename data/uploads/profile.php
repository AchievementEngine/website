<?php 
	include_once "scripts/connect.php";

	session_start();
	
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
	$about = $row['about'];		
	
	//check user is logged in?
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
				<div class="username"><?= $dispName." "; ?><img src="data/700achscore.png" height="70px"></div><!-- User selected badge here -->
				<div class="achOverview">
					<i class="fas fa-circle" style="color:#CD7F32"></i> 30<!-- Bronze num of ach here --> 
					<i class="fas fa-circle" style="color:#C0C0C0"></i> 21<!-- Silver num of ach here --> 
					<i class="fas fa-circle" style="color:#FFD700"></i> 6<!-- Gold num of ach here --> 
					<i class="fas fa-circle" style="color:#5bb9e2"></i> 1<!-- Platinum num of ach here -->
				</div>
			</div>
			<div class="moreInfo">
				<span class="sideBar">
					<div class="featuredAch">
						<img src="data/finishTheFight.png" height="70px"> <!-- Pic of featured ach here -->
						<div class="featureInfo">
							<div class="featureName">
								<i class="fas fa-circle" style="color:#5bb9e2"></i> Finish the Fight<!-- featured ach trophy colour --> <!-- Name of featured ach here -->
							</div>
							<div class="featureGame">
								Halo<!-- Game of featured ach here -->
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
									Animorphs#9412<!-- Discord/Link to other platform of user here -->
								</td>
							</tr>
							<tr>
								<td class="tabIcon"><i class="fas fa-trophy"></i></td>
								<td>
									58 Achievements<!-- total num of ach here -->
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
	<!-- Friends bar (removed for now)
	<div class="friendsList">
		<ul>
			<li>
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
			</li>
			<li>
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
			</li>
			<li>
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
			</li>
		</ul>
	</div> -->
	
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
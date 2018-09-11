<?php 
	session_start();
	include_once "scripts/connect.php";
	
	//get display name, and establish username
	$username = $_SESSION['username'];
	$user = "SELECT * FROM users WHERE username='$username'";
	$results = $db->query($user);
	$row = $results->fetch_array(MYSQLI_ASSOC);
	$dispName = $row['dispName'];
	
	$gameNames = array();	//game names
	$gameIDs = array();		//game id
	$gamesExist = true;		//games exist is true
	$ugames = "SELECT g.gameName, g.gameID FROM ugames u INNER JOIN games g on u.gameID = g.gameID WHERE u.username = '$username'";
	$ugamesResults = $db->query($ugames);
	if ($ugamesResults->num_rows > 0) {
		while ($ugameRow = $ugamesResults->fetch_assoc()) {
			array_push($gameIDs, $ugameRow['gameID']);
			array_push($gameNames, $ugameRow['gameName']);
		} 
	} else {
		$gamesExist = false;	//set to no games existing
	}
	
	$gameNameAndAchs = array();	//stores game names and achievements unlocked by the current user
	$achsLocked = array();	//game name unlocked, but achievements locked by user
	foreach($gameIDs as $gameID) { 
		$game = "SELECT * FROM games WHERE gameID='$gameID'";
		$gameResults = $db->query($game);
		while ($gameRow = $gameResults->fetch_assoc()) {
			$gameNameAndAchs[$gameRow['gameName']] = array();	//this currently stores the game names, each with their own empty array
			$achsLocked[$gameRow['gameName']] = array();	//same
		}
	}
	
	foreach ($gameNameAndAchs as $gameName => $value) {
		$unlockedAch = "SELECT * FROM uachievements u INNER JOIN achievements a ON u.achStr = a.achStr AND u.gameID = a.gameID INNER JOIN games g ON a.gameID = g.gameID WHERE u.username='$username' AND g.gameName = '$gameName' AND u.progress = a.achValue";
		$lockedAch = "SELECT * FROM uachievements u INNER JOIN achievements a ON u.achStr = a.achStr AND u.gameID = a.gameID INNER JOIN games g ON a.gameID = g.gameID WHERE u.username='$username' AND g.gameName = '$gameName' AND u.progress != a.achValue";
		$unlockedAchResults = $db->query($unlockedAch);
		$lockedAchResults = $db->query($lockedAch);
		if ($unlockedAchResults == true) {
			while ($unlockedAchRow = $unlockedAchResults->fetch_assoc()) {
				array_push($gameNameAndAchs[$gameName], $unlockedAchRow['achName']);		
				//this adds each games achievements to their array. It's a multidimensional array,
				//e.g. gameNameAndAchs(game1(ach1, ach2, ach3), game2(ach1, ach2, ach3));
			}
		}
		if ($lockedAchResults == true) {
			while ($lockedAchRow = $lockedAchResults->fetch_assoc()) {
				array_push($achsLocked[$gameName], $lockedAchRow['achName']);
			}
		}
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
	<link rel="icon" href="data/teamae.png">
	<link rel="stylesheet" type="text/css" href="data/style.css">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous">
	<link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet"> 
	<script type="text/javascript" src="http://code.jquery.com/jquery-latest.min.js"></script>
	<title>My Achievements</title>
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
				<?php echo "<button onclick='myFunction()' class='dropbtn' style='background-image: url(data/uploads/".$username.".png)'></button> "?>
				<div id="myDropdown" class="dropdown-content">
					<a href="profile.php">My Profile</a>
					<a href="editProfile.php">Edit Profile</a>
					<a href="scripts/logout.php">Log Out</a>
				</div>
			</div>
		</div>
	</header>
	
	<div class="gameScroll">
		<div class="scrollbar" id="style-1">
			<div class="btn-group">
				<?php foreach($gameNameAndAchs as $game => $ach) { 
					$games = "SELECT * FROM games WHERE gameName = '$game'";
					$gameResults = $db->query($games);
					$gameRow = $gameResults->fetch_array(MYSQLI_ASSOC);
					$gameStr = $gameRow['gameStr'];
					echo "<button onclick='$gameStr()' id='$game'>$game</button>"; 
				} ?>
			</div>
			
			<div class="force-overflow"></div>
		</div>
	</div>
	<div class="activeZone">
		<div class="scrollbar-2" id="style-2">
			<center>
				<br>
				<div id="myDIVheader">
					<?php if ($gamesExist == true) {
						echo "Select a game to see your achievements";
					} else {
						echo "You do not have any games";
					} ?>
				</div>
				<div id="unlocked" style="display: none;">		<!-- hidden until a game button is clicked. Displays unlocked achievements -->
					
				</div>	
				<div id="locked" style="display: none;">		<!-- Same ^^. Displays locked achievements -->
				
				</div>
    			<div class="force-overflow"></div>
    		</center>
		</div>
	</div>	
</body>

<script>
	<?php foreach($gameNameAndAchs as $game => $ach) { 
		$games = "select * from games where gameName = '$game'";
		$gameResults = $db->query($games);
		$gameRow = $gameResults->fetch_array(MYSQLI_ASSOC);
		$gameStr = $gameRow['gameStr'];
		?>
		function <?php echo $gameStr; ?>() {
			
			var unlocked = document.getElementById("unlocked");
			if (unlocked.style.display === "none") {	//unhide div when game clicked
				unlocked.style.display = "block";
			}
			
			document.getElementById("myDIVheader").innerHTML = "<?php echo $game?>";	//game title
			
			document.getElementById("unlocked").innerHTML = "<?php 
				echo 'Unlocked:';
				echo '<br><br>';
				foreach($ach as $c => $d) {
					echo $d.'<br>';
				}	
			?>";
			<?php echo $gameStr."_Locked"; ?>();	//call function to print locked achievements
		}
	<?php } ?>	
	
	<?php foreach($achsLocked as $game => $ach) { 
		$games = "select * from games where gameName = '$game'";
		$gameResults = $db->query($games);
		$gameRow = $gameResults->fetch_array(MYSQLI_ASSOC);
		$gameStr = $gameRow['gameStr'];
		?>
		function <?php echo $gameStr."_Locked"; ?>() {
			var locked = document.getElementById("locked");
			if (locked.style.display === "none") {	//unhide div when game clicked
				locked.style.display = "block";
			}
			document.getElementById("myDIVheader").innerHTML = "<?php echo $game?>";	//game title
			
			<?php if (empty($ach)) { ?>		//if all achievements are unlocked, hide Locked div, and replace "unlocked" with "all achievements unlocked"
				if (locked.style.display === "block") {	//unhide div when game clicked
					locked.style.display = "none";
				}
				$('#unlocked').contents().filter(function() {
					return this.nodeType == 3
				}).each(function(){
					this.textContent = this.textContent.replace('Unlocked:','All achievements unlocked:');
				});
			<?php } ?>
			
			document.getElementById("locked").innerHTML = "<?php 
				echo 'Locked:<br><br>';
				foreach($ach as $c => $d) {	//c is array index (0, 1, etc), d is the achievement name
					$query = "SELECT * FROM uachievements u INNER JOIN achievements a ON u.achStr = a.achStr AND u.gameID = a.gameID INNER JOIN games g ON a.gameID = g.gameID WHERE u.username='$username' AND g.gameName = '$game' AND a.achName = '$d'";
					$queryResults = $db->query($query);
					while ($queryRow = $queryResults->fetch_assoc()) {
						$progress = $queryRow['progress'];
						$achValue = $queryRow['achValue'];
					}
					
					#echo $game.'<br>';
					echo $d.'&emsp;&emsp;Progress: '.$progress.'/'.$achValue.'<br>';
					$progressPercent = ($progress/$achValue) * 100;
					//echo $progress.'<br>';
					//echo $achValue.'<br>';
					echo "<div class='achievement-progress'>";
						echo "<div class='pBar' style='width:30%; height:20px; border-radius: 10px;  margin:0 auto;'>";
							echo "<div class='pProgress' style='width:".$progressPercent."%; height:10px; border-radius: 10px;'>".$progressPercent."%</div>";
						echo "</div>";
					echo "</div>";
					echo "<br>";
				}	
			?>";
		}
	<?php } ?>	
	
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
		if(!event.target.matches('.dropbtn')) {
			var dropdowns = document.getElementsByClassName("dropdown-content");
			var i;
			for(i = 0; i < dropdowns.length; i++) {
				var openDropdown = dropdowns[i];
				if(openDropdown.classList.contains('show')) {
					openDropdown.classList.remove('show');
				}
			}
		}
	}
</script>
</html>
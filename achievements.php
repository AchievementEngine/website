<?php 
	session_start();
	include_once "scripts/connect.php";
	
	//get display name, and establish username
	$username = $_SESSION['username'];
	$user = "SELECT * FROM users WHERE username='$username'";
	$results = $db->query($user);
	$row = $results->fetch_array(MYSQLI_ASSOC);
	$dispName = $row['dispName'];
	
	$gamesExist = true;
	$userGames = array();	//array to store game IDs that user has
	$userGameQuery = "SELECT * FROM games g JOIN ugames ug ON g.gameID = ug.gameID WHERE username = '$username'";
	$ugamesResults = $db->query($userGameQuery);
	if ($ugamesResults->num_rows > 0) {
		while ($ugameRow = $ugamesResults->fetch_assoc()) {
			array_push($userGames, $ugameRow['gameID']);
		}
	} else {
		$gamesExist = false;	//set to no games existing
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
	<script type="text/javascript" src="http://code.jquery.com/jquery-latest.min.js"></script>
	<title>My Achievements</title>
</head>
<body>
	<?php include ('include/sideNav.php'); ?>
	<?php include ('include/header2.php'); ?>
	
	<div class = "body">
		<div class="content">
			<div class="moreInfo">
				<span class="sideBar">
					<div class="gameScroll">
						<div class="scrollbar" id="style-1">
							<div class="btn-group">
								<?php foreach($userGames as $gameID) { 
									$games = "SELECT * FROM games WHERE gameID = '$gameID'";
									$gameResults = $db->query($games);
									$gameRow = $gameResults->fetch_array(MYSQLI_ASSOC);
									$gameStr = $gameRow['gameStr'];
									$gameName = $gameRow['gameName'];
									//echo "test";
									echo "<button onclick='$gameStr()' id='$gameName'>$gameName</button>"; 
								} ?>
							</div>
							
							<div class="force-overflow"></div>
						</div>
					</div>
				</span>
				<span class="showcase" style="width:82.5%">
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
								
								<br>
								
								<div id="subheader" style="display: none;">	<!-- hidden until a game button is clicked. Displays achievement progress -->
								</div>
								
								<div id="unlocked" style="display: none;">	<!-- Same ^^. Displays completed achievements -->
								</div>	
								
								<div id="locked" style="display: none;">	<!-- Same ^^. Displays locked achievements -->
								</div>
								
								<div class="force-overflow"></div>
							</center>
						</div>
					</div>
				</span>
			</div>
		</div>
	</div>				
	<?php include ('include/friendFooter.php'); ?>
</body>

<script>
	<?php foreach($userGames as $gameID) { 	//for each game, make a function, to display locked and unlocked achs
		$games = "SELECT * FROM games WHERE gameID = '$gameID'";
		$gameResults = $db->query($games);
		$gameRow = $gameResults->fetch_array(MYSQLI_ASSOC);
		$gameStr = $gameRow['gameStr'];
		$gameName = $gameRow['gameName']; ?>
		function <?php echo $gameStr; ?>() {	//unlocked achievements			
			var unlocked = document.getElementById("unlocked");	 
			var locked = document.getElementById("locked");	
			var header = document.getElementById("myDIVheader");
			var subheader = document.getElementById("subheader");
			if (unlocked.style.display === "none") {	//unhide div when game clicked
				unlocked.style.display = "block";
			}
			if (locked.style.display === "none") {	
				locked.style.display = "block";
			}
			if (subheader.style.display === "none") {	
				subheader.style.display = "block";
			}
			
			document.getElementById("unlocked").innerHTML = "<h1 style='font-size:18pt'> Unlocked Achievements </h1> <br>";		//refresh for new game
			document.getElementById("locked").innerHTML = "<h1 style='font-size:18pt'> Locked Achievements </h1> <br>"; 
			<?php
			$achievements = "SELECT * FROM uachievements ua JOIN achievements a ON ua.gameID = a.gameID WHERE username = '$username' AND a.gameID = '$gameID' and ua.achStr = a.achStr and ua.progress = a.achValue";
			$achResults = $db->query($achievements);		
			while ($achRow = $achResults->fetch_assoc()) {
				$achName = $achRow['achName'];
				$achDesc = $achRow['achDesc'];
				$achStr = $achRow['achStr'];
				$achType = $achRow['achType'];
				$achPic = "data/achievements/".$gameStr."/".$achStr.".png";
				$achColour = "";
				if($achType == "bronze") {
					$achColour = "<i class='fas fa-circle' style='color:#CD7F32'></i>";
				} else if($achType == "silver") {
					$achColour = "<i class='fas fa-circle' style='color:#D8D8D8'></i>";
				} else if($achType == "gold") {
					$achColour = "<i class='fas fa-circle' style='color:#FFD700'></i>";
				} else if($achType == "diamond") {
					$achColour = "<i class='fas fa-circle' style='color:#00F6FF'></i>";
				} else if($achType == "nil") {
					$achColour = "<i class='fas fa-circle' style='color:#000000'></i>";
				}
				
				$countAchieved = "SELECT count(*) FROM uachievements ua JOIN achievements a ON ua.achStr = a.achStr WHERE ua.progress = a.achValue AND ua.gameID = a.gameID AND ua.gameID = '$gameID' AND ua.username = '$username'";
				$countAchResults = $db->query($countAchieved);
				$countAchRow = $countAchResults->fetch_array(MYSQLI_ASSOC);
				$countAch = $countAchRow['count(*)'];
				$countAll = "SELECT count(*) FROM achievements WHERE gameID = '$gameID'";
				$countAllResults = $db->query($countAll);
				$countAllRow = $countAllResults->fetch_array(MYSQLI_ASSOC);
				$countAll = $countAllRow['count(*)'];
				
				$progressPercent = round(($countAch/$countAll) * 100, 0);
				if ($progressPercent < 1) {
					$progressPercent = 1;
				}
				?>
				
				header.innerHTML = "<?=$gameName?> ";
				
				subheader.innerHTML =
					"<?=$countAch?> / <?=$countAll?> Achievements Completed (<?=$progressPercent?>%)<br>" + 
					"<div class='pBar' style='height:20px'>" + 
						"    <div class='pProgress' style='width:<?=$progressPercent?>%; align:center; height:50%;'>" + 
						"</div>" +
					"</div>";
				
				unlocked.innerHTML += 	
					"<div class = featuredAch>"+
						"<img src='<?=$achPic?>' height='70px'>" +
						"<div class = featureInfo>"+
							"<div class = featureName>"+
								"<?=$achColour?>"+
								" <?=$achName?>"+
							"</div>"+
							"<div style=padding:5px 5px 5px 20px;>"+
								"<?=$achDesc?>" +
							"</div>"+
						"</div>"+
					"</div>";
				
			<?php
			}
			$lockedAchievements = "SELECT * FROM uachievements ua JOIN achievements a ON ua.gameID = a.gameID WHERE username = '$username' AND a.gameID = '$gameID' AND ua.achStr = a.achStr AND ua.progress < a.achValue";
			$lockedResults = $db->query($lockedAchievements);	
			while ($lockedRow = $lockedResults->fetch_assoc()) {
				$lockedName = $lockedRow['achName'];
				$lockedDesc = $lockedRow['achDesc'];
				$lockedStr = $lockedRow['achStr'];
				$lockedType = $lockedRow['achType'];
				$lockedProgress = $lockedRow['progress'];
				$lockedValue = $lockedRow['achValue'];
				$lockedPic = "data/achievements/".$gameStr."/".$lockedStr.".png";
				$lockedColour = "";
				$lockedPercent = round($lockedProgress/$lockedValue * 100, 0);
				if ($lockedPercent < 1) {
					$lockedPercent = 1;
				}
				if($lockedType == "bronze") {
					$lockedColour = "<i class='fas fa-circle' style='color:#CD7F32'></i>";
				} else if($lockedType == "silver") {
					$lockedColour = "<i class='fas fa-circle' style='color:#D8D8D8'></i>";
				} else if($lockedType == "gold") {
					$lockedColour = "<i class='fas fa-circle' style='color:#FFD700'></i>";
				} else if($lockedType == "diamond") {
					$lockedColour = "<i class='fas fa-circle' style='color:#00F6FF'></i>";
				} else if($lockedType == "nil") {
					$lockedColour = "<i class='fas fa-circle' style='color:#000000'></i>";
				}
				?>
				locked.innerHTML +=
					"<div class = featuredAch>"+
						"<img src='<?=$lockedPic?>' height='70px'>" +
						"<div class = featureInfo>"+
							"<div class = featureName>"+
								"<?=$lockedColour?>"+
								" <?=$lockedName?>"+
							"</div>"+
							"<div style=padding:5px 5px 5px 20px;>"+
								"<?=$lockedDesc?>" +
							"</div>"+
							
							"<div class='pBar'>" + 
								"<div class='pProgress' style='width:<?=$lockedPercent?>%'>" + 
								"<?=$lockedProgress?>/<?=$lockedValue?>" + 
								"</div>" +
							"</div>"+
						"</div>"+
					"</div>";
				
			<?php }	?>	
		}
	<?php } ?>
</script>
<?php include ('include/profileDropdown.php'); ?>
</html>
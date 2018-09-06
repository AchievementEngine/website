<?php 
	session_start();
	include_once "scripts/connect.php";
	
	$username = $_SESSION['username'];
	$user = "SELECT * FROM users WHERE username='$username'";
	$results = $db->query($user);
	$row = $results->fetch_array(MYSQLI_ASSOC);
	$dispName = $row['dispName'];
	
	$achArray = array();
	
	$uachievements = "SELECT * FROM uachievements u INNER JOIN achievements a ON u.achStr = a.achStr AND u.gameID = a.gameID WHERE u.username='$username'";
	$achResults = $db->query($uachievements);
	if ($achResults == true) {
		while ($achRow = $achResults->fetch_assoc()) {
			array_push($achArray, $achRow['achName']);
		}
	}
	
	$ach = "SELECT * FROM achievements";
	$achResults = $db->query($ach);
	$achRow = $achResults->fetch_array(MYSQLI_ASSOC);
	$achName = $achRow['achName'];
	
	$gameIDs = array();		//stores game ids
	while ($achRow = $achResults->fetch_assoc()) {
		if (!in_array($achRow['gameID'], $gameIDs)) {	//ensure not added twice. todo fix sql so doesn't even happen i guess?
			array_push($gameIDs, $achRow['gameID']);
		} else {
			//idk do shit
		}
	}
	
	$gameNames = array();	//stores names of games
	foreach($gameIDs as $gameID) { 
		$game = "SELECT * FROM games WHERE gameID='$gameID'";
		$gameResults = $db->query($game);
		while ($gameRow = $gameResults->fetch_assoc()) {
			$gameNames[$gameRow['gameName']] = array();
		}
	}
	
	foreach ($gameNames as $name => $value) {
		$Guachievements = "SELECT * FROM uachievements u INNER JOIN achievements a ON u.achStr = a.achStr AND u.gameID = a.gameID INNER JOIN games g ON a.gameID = g.gameID WHERE u.username='$username' AND g.gameName = '$name'";
		$GachResults = $db->query($Guachievements);
		if ($GachResults == true) {
			while ($GachRow = $GachResults->fetch_assoc()) {
				array_push($gameNames[$name], $GachRow['achName']);
			}
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
					<button style="font-family:FontAwesome"><i class="fas fa-search"></i></button>
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
	
	<div class="gameScroll">
		<div class="scrollbar" id="style-1">
			<div class="btn-group">
				<?php foreach($gameNames as $game => $ach) { 
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
					Select a game to see your achievements
				</div>
				<div id="myDIV" style="display: none;">		<!-- hidden until a game button is clicked -->
					
				</div>				
    			<div class="force-overflow"></div>
    		</center>
		</div>
	</div>	
</body>


<script>
	<?php foreach($gameNames as $game => $ach) { 
		$games = "select * from games where gameName = '$game'";
		$gameResults = $db->query($games);
		$gameRow = $gameResults->fetch_array(MYSQLI_ASSOC);
		$gameStr = $gameRow['gameStr'];
		?>
		function <?php echo $gameStr; ?>() {
			
			var x = document.getElementById("myDIV");
			if (x.style.display === "none") {	//unhide div when game clicked
				x.style.display = "block";
			};
			
			document.getElementById("myDIVheader").innerHTML = "<?php echo $game?>";	//game title
			
			document.getElementById("myDIV").innerHTML = "<?php 
				echo 'Unlocked:<br>';
				foreach($ach as $c => $d) {
					echo $d.'<br>';
				}	
			?>";
			<?php echo $gameStr."_Locked"; ?>();	//call function to print locked achievements
		}
		<?php foreach ($gameNames as $game => $ach) {		//this will be changed and shit. doesnt work properly yet
			
			?>
			function <?php echo $gameStr."_Locked"; ?>() {
				var myDIV = document.getElementById("myDIV");
				var newcontent = document.createElement('div');
				newcontent.innerHTML = "<br><br>Locked:<br>TODO";		//todo add locked achs
				
				while (newcontent.firstChild) {
					myDIV.appendChild(newcontent.firstChild);		//appends to div
				}
			}
		<?php } ?>
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
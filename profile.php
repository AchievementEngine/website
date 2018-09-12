<?php 
	session_start();
	include_once "scripts/connect.php";

	if(!isset($_SESSION)) { 
        session_start(); 
    }

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
	<?php include ('include/header.php'); ?>
	<title>Profile</title>
</head>
<body>
	<?php include ('include/sideNav.php'); ?>
	<?php include ('include/header2.php'); ?>
	
	<div class="body">
		<div class="profilePic">
			<?php echo "<img src='data/uploads/".$username.".png' height='200px'>"; ?> <!-- User profile pic -->
		</div>
		
		<div class="content">
			<div class="topInfo">
				<div class="username"><?= $dispName." "; ?></div><!-- User selected badge here -->
				<table width='100%'>
					<tr>
						<td style="text-align:left;">
							<div class="achOverview">
								<i class="fas fa-circle" style="color:#CD7F32"></i> <?= $totalBronzes ?><!-- Bronze num of ach here --> 
								<i class="fas fa-circle" style="color:#D8D8D8"></i> <?= $totalSilvers ?><!-- Silver num of ach here --> 
								<i class="fas fa-circle" style="color:#FFD700"></i> <?= $totalGolds ?><!-- Gold num of ach here --> 
								<i class="fas fa-circle" style="color:#00F6FF"></i> <?= $totalDiamonds ?><!-- Platinum num of ach here -->
							</div>
						</td>
						<td style="float:right">
							<div>
								<?php
								if(isset($_GET['username']) && $_GET['username'] != $_SESSION['username']) {
									$username1 = $_SESSION['username'];
									$username2 = $_GET['username'];
									$friendQuery = "SELECT * FROM friends WHERE (user1 = '$username1' AND user2 = '$username2') OR (user1 = '$username2' AND user2 = '$username1')";
									$friendResults = $db->query($friendQuery);
									if (mysqli_num_rows($friendResults) == 0) {
										$friendsB = false;
									} else {
										$friendsB = true;
									}
									if (!$friendsB) {
										$friendRequest = true;
										echo "<a href='scripts/friends.php?usernameGET=".$username2."&friendReqGET=".$friendRequest."' class='button'>Add Friend</a>";
									}
								}
								?>
							</div>
						</td>
					</tr>
				</table>
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
									echo "<i class='fas fa-circle' style='color:#D8D8D8'></i>";
								} else if($achType == "gold") {
									echo "<i class='fas fa-circle' style='color:#FFD700'></i>";
								} else if($achType == "diamond") {
									echo "<i class='fas fa-circle' style='color:#00F6FF'></i>";
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
						</table>
					</div>
				</span>
				<span class="showcase">
					<?php
					$ugames = "SELECT g.gameName, g.gameID, g.gameStr FROM ugames u INNER JOIN games g on u.gameID = g.gameID WHERE u.username = '$username'";
					$ugamesResults = $db->query($ugames);
					if ($ugamesResults->num_rows > 0) {
						while ($ugameRow = $ugamesResults->fetch_assoc()) {
							$gameNameB = $ugameRow['gameName'];
							$gameIdB = $ugameRow['gameID'];
							$gameStrB = $ugameRow['gameStr'];
							$randomAch = "SELECT * FROM uachievements WHERE gameID = '$gameIdB' and username = '$username' ORDER BY RAND() LIMIT 1";
							$randomAchResults = $db->query($randomAch);
							if ($randomAchResults->num_rows > 0) {
								while ($randomAchRow = $randomAchResults->fetch_assoc()) {
									$achStrB = $randomAchRow['achStr'];
								}
							} else {
								$achStrB = 'default';
							}
							/* Figure out total number of achievements */
							$totAchGame = "SELECT * FROM achievements WHERE gameID = '$gameIdB'";
							$totAchResultsGame = $db->query($totAchGame);
							$totalAchsGame = mysqli_num_rows($totAchResultsGame);
							
							/* figure out total number of bronze, silver, gold, and diamond achievements */
							$totBronzeGame = "SELECT * FROM uachievements u INNER JOIN achievements a ON u.achStr = a.achStr AND u.gameID = a.gameID WHERE u.username='$username' AND a.achType='bronze' AND a.achValue = u.progress AND a.gameID = '$gameIdB'";
							$totBronzeResultsGame = $db->query($totBronzeGame);
							$totalBronzesGame = mysqli_num_rows($totBronzeResultsGame);
							
							$totSilverGame = "SELECT * FROM uachievements u INNER JOIN achievements a ON u.achStr = a.achStr AND u.gameID = a.gameID WHERE u.username='$username' AND a.achType='silver' AND a.achValue = u.progress AND a.gameID = '$gameIdB'";
							$totSilverResultsGame = $db->query($totSilverGame);
							$totalSilversGame = mysqli_num_rows($totSilverResultsGame);
							
							$totGoldGame = "SELECT * FROM uachievements u INNER JOIN achievements a ON u.achStr = a.achStr AND u.gameID = a.gameID WHERE u.username='$username' AND a.achType='gold' AND a.achValue = u.progress AND a.gameID = '$gameIdB'";
							$totGoldResultsGame = $db->query($totGoldGame);
							$totalGoldsGame = mysqli_num_rows($totGoldResultsGame);
							
							$totDiamondGame = "SELECT * FROM uachievements u INNER JOIN achievements a ON u.achStr = a.achStr AND u.gameID = a.gameID WHERE u.username='$username' AND a.achType='diamond' AND a.achValue = u.progress AND a.gameID = '$gameIdB'";
							$totDiamondResultsGame = $db->query($totDiamondGame);
							$totalDiamondsGame = mysqli_num_rows($totDiamondResultsGame);
							
							$totalAchievedGame = $totalDiamondsGame + $totalGoldsGame + $totalSilversGame + $totalBronzesGame;
							$progressPercent = ($totalAchievedGame/$totalAchsGame) * 100;
							if ($progressPercent < 1) {
								$progressPercent = 1;
							}
							?> 
							<div class="showcaseItem">
								<div class="gameTop">
									<div class="gamePic">
										<img src="data/games/<?php echo $gameStrB?>.png" width="100px"> <!-- Game pic --> 
									</div>
									<table>
										<tr>
											<th style="text-align:left;">
												<div style="font-size:30px">
													<?php echo $gameNameB."<br>"; ?>
												</div>
											</th>
											<td style="text-align:right;">
												<div>
													<div class="achieveCount">
														<i class="fas fa-circle" style="color:#CD7F32"></i> <?php echo $totalBronzesGame?>
														<i class="fas fa-circle" style="color:#D8D8D8"></i> <?php echo $totalSilversGame?>
														<i class="fas fa-circle" style="color:#FFD700"></i> <?php echo $totalGoldsGame?> 
														<i class="fas fa-circle" style="color:#00f6ff"></i> <?php echo $totalDiamondsGame?>
													</div>
												</div>
											</td>
										</tr>
										<tr><td><br></td></tr>
										<tr>
											<td style="text-align:center;" colspan="2">
												Achievement Progress: <?php echo $totalAchievedGame."/".$totalAchsGame;?>
													<div class="pBar">
														<div class="pProgress" style="width:<?php echo $progressPercent?>%"></div><!-- Progress of all ach's here -->
													</div>
												
											</td>
										</tr>
									</table>
									<?php if ($achStrB == 'default') { ?>
										<img src="data/achievements/no_ach/no_ach.png" height="50px"> <!-- Ach pic -->									
									<?php } else { ?>
										<img src="data/achievements/<?php echo $gameStrB?>/<?php echo $achStrB?>.png" height="50px"> <!-- Ach pic -->									
									<?php } ?>
								</div>
							</div>
						<?php }
					} else { ?>
						<div class="showcaseItem">
							<div class="gameTop">
								<div class="gamePic">
									<img src="data/games/default.png" width="100px">
								</div>
								<table align="center" width="400px">
									<tr>
										<th style="text-align:center;">
											<div style="font-size:30px">
												No games <br>
											</div>
										</th>
									</tr>
									<tr><td><br></td></tr>
									<tr>
										<td style="text-align:center;" colspan="2">
											Play games to unlock achievements!	
										</td>
									</tr>
								</table>
								<img src="data/achievements/no_ach/no_ach.png" height="50px"> <!-- Ach pic -->	
							</div>
						</div>
					<?php }	?>
				</span>
			</div>
		</div>		
	</div>
	
	<?php include ('include/friendFooter.php'); ?>
</body>
<?php include ('include/profileDropdown.php'); ?>

</html>
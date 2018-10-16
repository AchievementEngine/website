<?php 
	session_start();
	include_once "scripts/connect.php";
	$username = $_SESSION['username'];

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
	<title>Achievement Engine</title>
	<style>
	.row {
		display: flex; /* equal height of the children */
		text-align:center;
	}

	.col {
		flex: 1; /* additionally, equal width */
		margin: 0 2%;
		background: #2f3136;
	}
	
	table td {
		padding: 7px;
	}
	</style>
</head>
<body>
	<?php include ('include/sideNav.php'); ?>	
	<?php include ('include/header2.php'); ?>
	<div class="body">
		<div class="content" style="height:95%;">
			<h1 style="text-align:center; font-size:30px;"> Friend Activity </h1> 
			<br>
			
			<div class="row">
				<!-- Prints recent friend achievements -->
				<div class="col">
					<br style="clear:both;"/>
					<p style="font-size:24px;">Achievements</p> <br>
					<table width='100%' class="table">
					<?php 
						$user = $_SESSION['username'];
						$achQuery = "SELECT u.dispName, a.achName, a.achStr, g.gameName, g.gameStr, ua.datetime FROM friends f JOIN uachievements ua on f.user2 = ua.username join achievements a on ua.achStr = a.achStr join games g on g.gameID = a.gameID join users u on ua.username = u.username where f.user1 = '$user' and ua.datetime is not null order by ua.datetime desc";
						$achResults = $db->query($achQuery);
						if (mysqli_num_rows($achResults) > 0) {
							while ($achRow = $achResults->fetch_array(MYSQLI_ASSOC)) {
								$achFriend = $achRow['dispName'];
								$ach = $achRow['achName'];
								$achStr = $achRow['achStr'];
								$achGame = $achRow['gameName'];
								$achGameStr = $achRow['gameStr'];
								$achDate = date('d M, Y', (strtotime($achRow['datetime'])));
								$achPic = "<img style='vertical-align:middle' src='data/achievements/".$achGameStr."/".$achStr.".png' height='50px'>";
								?>
								<tr>
									<td align="right" width="20%">
										<?=$achPic?>
									</td>
									<td align="left" width="80%">
										<?=$achDate?>: <?=$achFriend?> has achieved <?=$ach?> in <?=$achGame?>
									</td>
								</tr>
						<?php }
						} else { ?>
							<p>None of your friends have achievements!</p>
						<?php } ?>
					</table>
				</div>
				
				<!-- Prints recent friend bought games -->
				<div class="col">
					<br style="clear:both;"/>
					<p style="font-size:24px;">Games</p> <br>
					<table width='100%' class="table">
					<?php 
						$user = $_SESSION['username'];
						$gameQuery = "SELECT u.dispName, g.gameName, g.gameStr, ug.datetime FROM friends f JOIN ugames ug on f.user2 = ug.username join games g on ug.gameID = g.gameID join users u on ug.username = u.username where f.user1 = '$user' and ug.datetime is not null order by ug.datetime desc";
						$gameResults = $db->query($gameQuery);
						if (mysqli_num_rows($gameResults) > 0) {
							while ($gameRow = $gameResults->fetch_array(MYSQLI_ASSOC)) {
								$gameFriend = $gameRow['dispName'];
								$game = $gameRow['gameName'];
								$gameStr = $gameRow['gameStr'];
								$gameDate = date('d M, Y', (strtotime($gameRow['datetime'])));
								$gamePic = "<img style='vertical-align:middle' src='data/games/".$gameStr.".png' height='50px'>";
								?>
								<tr>
									<td align="right" width="30%">
										<?=$gamePic?>
									</td>
									<td align="left" width="70%">
										<?=$gameDate?>: <?=$gameFriend?> played <?=$game?> for the first time
									</td>
								</tr>
						<?php }
						} else { ?>
							<p>None of your friends have games!</p>
						<?php } ?>
					</table>
				</div>
		</div>
		<?php include ('include/friendFooter.php'); ?>		
	</div>
</body>

<?php include ('include/profileDropdown.php'); ?>

</html>
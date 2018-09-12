<?php 
	session_start();
	include_once "scripts/connect.php";
	$username = $_SESSION['username'];
	
	//check user is logged in
	if (!isset($_SESSION['username'])) {
		$_SESSION['msg'] = "You must log in first";
		header('location: login.php');
	}
?>
<!DOCTYPE html>
<html>
<head>
	<?php include ('include/header.php'); ?>
	<title>Search</title>
</head>
<body>
	<?php include ('include/sideNav.php'); ?>
	<?php include ('include/header2.php'); ?>
	
	<div class="body">
		<div class="body">
		<div>
			<img src='data/AELogo2Light.png' align='right' height='80px'>
		</div>
		
		<br><br><br><br><br><br>
		<div class="content">
			<div class="topInfo" style="margin-left:0px; margin-bottom:10px">
				<div class="username">Search Results</div>
			</div>
		</div>
		<div class="content" style="margin-left:0px">
			<?php
			$fname = "";
			$lname = "";
			if (isset($_POST['search'])) {
				
				$query = $_POST['search'];
				$query = mysqli_real_escape_string($db, $query);
				
				$results = $db->query("SELECT * FROM users WHERE username LIKE '%".$query."%' OR dispName LIKE '%".$query."%' ");
				$rows = $results->num_rows;
				if ($rows > 0) {
					while($row = $results->fetch_array(MYSQLI_ASSOC)){
						$searchedUsername = $row['username'];
						$dispName = $row['dispName'];
						echo "<p style='font-size:25px'>
							<a href='profile.php?username=".$searchedUsername."'>
								<img style='vertical-align:middle' src='data/uploads/".$searchedUsername.".png' height='50'>   ".$dispName." (".$searchedUsername.")
							</a></p><br>";
					}		//shutup i know what im doing dont judge my code
				} else {
					echo "No results";
				}
			} else {
				header("location: home.php");
			}
			?>
		</div>
		<?php include ('include/friendFooter.php'); ?>
	</div>
</body>

<?php include ('include/profileDropdown.php'); ?>

</html> 
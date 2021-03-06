<?php 
	include('server.php');	
	$db = mysqli_connect('localhost', 'root', '', 'login');
	$username = $_SESSION['username'];
?>
<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="data/style.css">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous">
	<link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet"> 
	<title>Search</title>
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
								<img style='vertical-align:middle' src='data/uploads/".$searchedUsername.".png' height='50'>   ".$searchedUsername." (".$dispName.")
							</a></p><br>";
					}							//shutup i know what im doing dont judge my code
				} else {
					echo "No results";
				}
			} else {
				header("location: home.php");
			}
		?>
		</div>
		<br><br><br><br><br><br><br><br><br><br><br><br>
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
}

</script>

</html> 
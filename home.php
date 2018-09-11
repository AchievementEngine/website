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
	<link rel="icon" href="data/teamae.png">
	<link rel="stylesheet" type="text/css" href="data/style.css">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous">
	<link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet"> 
	<title>Achievement Engine</title>
	<script type="text/javascript" src="https://ajax.microsoft.com/ajax/jQuery/jquery-1.4.2.min.js"></script>
	<script type="text/javascript">
			$('input').on('change', function () {
				var v = $(this).val();
				$('content').css('font-size', v + 'px')
				$('span').php(v);
			});
		</script>
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
					<a href="logout.php">Log Out</a>
				</div>
			</div>
		</div>
	</header>
	
	<div class="body">
		
		
		<div id="myContent" class="content">
			Hey!
		</div>
		<button onclick="largeText()">Toggle Larger Text</button>
		
		
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

function largeText() {
	document.getElementById("myContent").classList.toggle("largetext");
}

</script>
</html>
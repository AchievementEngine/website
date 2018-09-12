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
		<div class="dropdown" style="padding-right:7px;">
			<?php
				$username1 = $_SESSION['username'];
				$friendNotifQuery = "SELECT * FROM friendRequest WHERE user2 = '$username1'";
				$friendNotifResults = $db->query($friendNotifQuery);
				if ($friendNotifResults->num_rows > 0) {
					echo "<button onclick='myFunction2()' class='dropbtn' style='background-image: url(data/notification_active.png)'></button>";
				} else {
					echo "<button onclick='myFunction2()' class='dropbtn' style='background-image: url(data/notification.png)'></button>";
				}
			?>
			<div id="notifDropdown" class="dropdown-content">
				<div>
					<?php
						while ($friendNotifRow = $friendNotifResults->fetch_assoc()) {
							$userAdding = $friendNotifRow['user1'];
							echo "<a href='scripts/friends.php?usernameGET=".$userAdding."&friendNotifGET=true'>Accept ".$userAdding."</a>";
						}
					?>
				</div>
				<p style="padding:15px"> No Notifications </p>
			</div>
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
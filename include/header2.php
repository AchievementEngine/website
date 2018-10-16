<header>
	<div class="left headLeft">
		<div class="farleft">
			<span onclick="openNav()"><img src="https://cdn3.iconfinder.com/data/icons/trico-circles-solid/24/Circle-Solid-List-512.png" height="40px"></span> 
		</div>
		<div class="left">
			<a href="home.php"> <img src="data/AELogo2Light.png" height="45px"></a>
		</div>
		<form method="post" action="search.php">
			<div class="searchzone">
				<input type="text" name="search" class="searchBox" placeholder="Search users...">
				<button style="font-family:FontAwesome;height:42px;width:70px;border-radius:10%; background-color: grey; border: 0; font-size:18px;"><i class="fas fa-search"></i></button>
			</div>
		</form>
	</div>
	<div class="right" style="text-align:top">
		<div class="dropdown" style="padding-right:7px;" >
			<button onclick='window.location.href="messages.php"' class='dropbtn' style='background-image: url(data/messages.png)'></button>
		</div>
		<div class="dropdown" style="padding-right:7px;">
			<?php
				$username1 = $_SESSION['username'];
				$friendNotifQuery = "SELECT * FROM friendrequest WHERE user2 = '$username1'";
				$friendNotifResults = $db->query($friendNotifQuery);
				if (mysqli_num_rows($friendNotifResults) == 0) {
					echo "<button onclick='myFunction2()' class='dropbtn' style='background-image: url(data/notification.png)'></button>"; ?>
					<div id="notifDropdown" class="dropdown-content">
						<div>
							<p style="padding:15px"> No Notifications </p>
						</div>
					</div>
				<?php } else {
					echo "<button onclick='myFunction2()' class='dropbtn' style='background-image: url(data/notification_active.png)'></button>"; ?>
					<div id="notifDropdown" class="dropdown-content">
						<div>
							<?php
								echo "<hr>";
								while ($friendNotifRow = $friendNotifResults->fetch_assoc()) {
									$userAdding = $friendNotifRow['user1'];
									echo "<a href='profile.php?username=".$userAdding."' style='white-space: nowrap'>Friend request from $userAdding</a>";
									echo "<table style='width:100%'><tr><td>";
									echo "<a href='scripts/friends.php?username=".$userAdding."&friendNotif=true' style='text-align:center'>Accept</a>";
									echo "</td><td>";
									echo "<a href='scripts/friends.php?username=".$userAdding."&friendNotif=false' style='text-align:center'>Decline</a>";
									echo "</td></tr></table>";
									echo "<hr>";
								}
							?>
						</div>
					</div>
				<?php }?>
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
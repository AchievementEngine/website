<div class="imdown">
	<button onclick="showIM()" class="imbtn"><i class="fas fa-user-friends"></i></button>
	<div id="im" class="im-content">
	<?php 
		$tempUser = $_SESSION['username'];
		$friendQ = "SELECT * FROM friends WHERE user1 = '$tempUser'";
		$friendQResults = $db->query($friendQ);
		if (mysqli_num_rows($friendQResults) > 0) { ?>
			<div style="color:white; font-size:20px; text-align:center; font-weight:bold; padding:10px"> 
				Friends 
			</div>
			<?php while ($friendQRow = $friendQResults->fetch_array(MYSQLI_ASSOC)) { 
				$friend = $friendQRow['user2'];
				$friendDispQ = "SELECT dispName FROM users WHERE username = '$friend'";
				$friendDispResults = $db->query($friendDispQ);
				$friendDispRow = $friendDispResults->fetch_array(MYSQLI_ASSOC);
				$friendDisp = $friendDispRow['dispName'];
				?>
				<div class="friend">
					<div class="friendPic">
						<?php echo '<img src="data/uploads/'.$friend.'.png" height="40px">'; ?>
					</div>
					<div class="friendInfo">
						<div class="friendName" style="color:white">
							<a href="profile.php?username=<?php echo $friend ?>"><?php echo $friendDisp ?></a>
						</div>
					</div>
				</div>
			<?php } 
		} else { ?>
			<div style="color:white; font-size:20px; text-align:center; font-weight:bold; padding:10px"> 
				You have no friends lmao 
			</div>
		<?php } ?>
	</div>
</div>
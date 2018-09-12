<div class="imdown">
	<button onclick="showIM()" class="imbtn"></button>
	<div id="im" class="im-content">
	<?php 
		$tempUser = $_SESSION['username'];
		$friendQ = "SELECT * FROM friends WHERE user1 = '$tempUser' OR user2 = '$tempUser'";
		$friendQResults = $db->query($friendQ);
		if (mysqli_num_rows($friendQResults) > 0) { ?>
			<div style="color:white; font-size:20px; text-align:center; font-weight:bold"> 
				Friends 
			</div>
			<?php while ($friendQRow = $friendQResults->fetch_array(MYSQLI_ASSOC)) { 
				$user1 = $friendQRow['user1'];
				$user2 = $friendQRow['user2'];
				if ($user1 == $_SESSION['username']) {	//ensure user 1 is a friend and not the person logged in
					$user1 = $user2;
				}
				$friendDispQ = "SELECT dispName FROM users WHERE username = '$user1'";
				$friendDispResults = $db->query($friendDispQ);
				$friendDispRow = $friendDispResults->fetch_array(MYSQLI_ASSOC);
				$friendDisp = $friendDispRow['dispName'];
				?>
				<div class="friend">
					<div class="friendPic">
						<?php echo '<img src="data/uploads/'.$user1.'.png" height="40px">'; ?>
					</div>
					<div class="friendInfo">
						<div class="friendName" style="color:white">
							<a href="profile.php?username=<?php echo $user1 ?>"><?php echo $friendDisp ?></a>
						</div>
					</div>
				</div>
			<?php } 
		} else { ?>
			<div style="color:white; font-size:20px; text-align:center; font-weight:bold"> 
				You have no friends lmao 
			</div>
		<?php }
	?>
	</div>
</div>
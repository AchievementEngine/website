<?php
	session_start();
	include_once "scripts/connect.php";

	if (!isset($_SESSION['username'])) {
		$_SESSION['msg'] = "You must log in first";
		header('location: login.php');
	}
		
	if (isset($_GET['logout'])) {
		session_destroy();
		unset($_SESSION['username']);
		header("location: login.php");
	}
	
	$uid = $_SESSION['username'];
	$cOut = "";
	$mOut = "";
	$hasConvo = false;

	$sql = "SELECT * FROM conversation WHERE sUsername = '$uid' OR rUsername = '$uid' ORDER BY lastSent DESC";
	$result = $db->query($sql);
	$otherGuysName = "";
	if($result->num_rows > 0) {
		$convos = array();
		
		while($row = $result->fetch_assoc()) {
			if($row['sUsername'] == $uid) {
				$recipient = $row['rUsername'];
			} else {
				$recipient = $row['sUsername'];
			}
			$select1 = "SELECT * FROM users WHERE username = '$recipient'";
			$selResult1 = $db->query($select1);
			while($selRow1 = $selResult1->fetch_assoc()) {
				$dispName = $selRow1['dispName'];
			}
			$convos[] = $row['id'];
			$cOut .= "<li><a href='messages.php?cid=".$row['id']."'>".$dispName."</a></li>";
		}

		if(isset($_GET['cid'])) {
			$id = $_GET['cid'];
			$select = "SELECT * FROM conversation WHERE id = '$id'";
			$selResult = $db->query($select);
			
			while($selRow = $selResult->fetch_assoc()) {
				
				if ($selRow['sUsername'] != $_SESSION['username']) {
					$otherGuysName = $selRow['sUsername'];
				} else {
					$otherGuysName = $selRow['rUsername'];
				}
					
				/* make sure allowed to see this convo. cant just waltz into someone elses convo */
				if (($selRow['sUsername'] == $uid && $selRow['rUsername'] == $otherGuysName) || ($selRow['sUsername'] == $otherGuysName && $selRow['rUsername'] == $uid)) {
					$select2 = "SELECT * FROM users WHERE username = '$otherGuysName'";
					$selResult = $db->query($select2);
					while($selRow2 = $selResult->fetch_assoc()) {
						$otherGuysName = $selRow2['dispName'];
					}
					
					$hasConvo = true;
					
					$sql = "SELECT * FROM messages WHERE id = '$id' ORDER BY sendTime ASC";
					$result = $db->query($sql);
					if($result->num_rows > 0) {
						while($row = $result->fetch_assoc()) {
							$pic = "<img src='data/uploads/".$row['sender'].".png' height='30px' style='border-radius:50%; vertical-align:middle' >";
							if($row['sender'] == $_SESSION['username']) {
								$mOut .= "<li class='sent'>".$row['contents']." ".$pic."</li>";
							} else {
								$mOut .= "<li class='reci'>".$pic." ".$row['contents']."</li>";
							}			
						}
					} else {
						$mOut = "No Messages";
					}
				} else {
					$otherGuysName = "Git outta here boi";
					$mOut = "Oi these aren't your messages mate";
				}
			}
		} else {
			$mOut = "No Active Conversation";
		}
	} else {
		$cOut = "No Conversations";
	}
?>

<!DOCTYPE html>
<html>
<head>
	<?php include ('include/header.php'); ?>
	<title> Messages</title>
</head>
<body>
	<?php include ('include/sideNav.php'); ?>
	<?php include ('include/header2.php');?>

	<br>
	
	<div class="body">
	<div class="content" style="height:85%;">
		<h1 style="text-align:center; font-size:30px; color:white; padding: 0 0 10px 0;"> Messages </h1> 
		<ul class="convoList">
			<li>
				<form action="scripts/newConversation.php" method="POST">
					<input type="text" name="recipient" class="messagesInput">
					<button type="submit" name="submit" style="font-family:FontAwesome;height:30px;width:30px;border-radius:10%">
						<i class="fas fa-plus"></i>
					</button>
				</form>
			</li>
			<?= $cOut ?>
		</ul>
		<ul class="messageName">
			<li style='text-align:center; font-size:20px'>
				<?=$otherGuysName?>
			</li>
		</ul>
		<div class="messageArea" id="a">
			<ul class="messageList">
				<br>
				<?= $mOut ?>
				<br>
			</ul>
		</div>
		
		<?php 
		if($hasConvo) { ?>
			 <form action="scripts/newMessage.php" method="POST">
				<input type="text" name="contents" class="messagesInput">
				<input type="hidden" name="cid" value='<?=$id?>'>
				<button type="submit" name="submit" class="button">Send</button>
			</form>
		<?php } ?>
		<?php include ('include/friendFooter.php'); ?>
	</div>
	</div>
</body>

<?php include ('include/profileDropdown.php'); ?>

<script>
<!-- automatically scroll to most recent messages -->
(function func() {
	var objDiv = document.getElementById("a");
	objDiv.scrollTop = objDiv.scrollHeight;
})()
</script>

</html> 
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
	<?php include ('include/sideNav.php'); ?>	
	<?php include ('include/header2.php'); ?>
	
	<div class="body">
		<div id="myContent" class="content">
			Hey!
		</div>
		<button onclick="largeText()">Toggle Larger Text</button>
		<?php include ('include/friendFooter.php'); ?>		
	</div>
</body>

<script>
	function largeText() {
		document.getElementById("myContent").classList.toggle("largetext");
	}
</script>
<?php include ('include/profileDropdown.php'); ?>

</html>
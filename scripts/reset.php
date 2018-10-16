<?php
include_once "connect.php";
session_start();

if($_GET['key'] && $_GET['reset'])
{
	$email=$_GET['key'];
	$pass=$_GET['reset'];
	$md5email = md5($email);
	$md5pass = md5($pass);
	
	$select="select * from users where MD5(email)='$email' and MD5(pword)='$pass'";
	$results = $db->query($select);
	
	if (mysqli_num_rows($results) == 1) {
		?>
		<form method="post" action="newPass.php">
			<input type="hidden" name="email" value="<?php echo $email;?>">
			
			<p>Enter New password</p>
			<input type="password" name='password'>
			
			<input type="submit" name="submit_password">
		</form>
		<?php
	}
}
?>
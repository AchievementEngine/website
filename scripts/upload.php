<?php
	include_once "connect.php";
	session_start();
	$username = $_SESSION['username'];
		
	if (isset($_POST['submit'])) {
		$file = $_FILES['file'];
			
		$fileName = $_FILES['file']['name'];
		$fileTmpName = $_FILES['file']['tmp_name'];
		$fileError = $_FILES['file']['error'];
		
		$fileExt = explode('.', $fileName);				#returns file extension
		$fileActualExt = strtolower(end($fileExt));
		
		$allowed = array('jpg', 'jpeg', 'png');		
		
		if (in_array($fileActualExt, $allowed)) {		#allow if png or jpg
			if ($fileError === 0) {
				resize_crop_image(500, 500, $fileTmpName, "../data/uploads/".$username.".png");	#shrink then crop to square 500x500 px, using middle of image
				$_SESSION['profile_updated'] = "Profile successfully updated! (Ctrl + F5 to force refresh if it didn't change)";
				header("Location: ../editProfile.php");
			} else {
				//array_push($errors, "Error uploading file");
				//todo
				$_SESSION['profile_failed'] = "Profile was not updated!";
				header("Location: ../editProfile.php");
			}
		} else {
			//array_push($errors, "Please upload a jpg or a png");
			//todo
			$_SESSION['profile_failed'] = "Profile was not updated!";
			header("Location: ../editProfile.php");
		}
	}
	
	function resize_crop_image($max_width, $max_height, $source_file, $dst_dir, $quality = 80){
		$imgsize = getimagesize($source_file);
		$width = $imgsize[0];
		$height = $imgsize[1];
		$mime = $imgsize['mime'];
	 
		switch($mime){			
			case 'image/png':
				$image_create = "imagecreatefrompng";
				$image = "imagepng";
				$quality = 7;
				break;
	 
			case 'image/jpeg':
				$image_create = "imagecreatefromjpeg";
				$image = "imagejpeg";
				$quality = 80;
				break;
	 
			default:
				return false;
				break;
		}
		 
		$dst_img = imagecreatetruecolor($max_width, $max_height);
		$src_img = $image_create($source_file);
		 
		$width_new = $height * $max_width / $max_height;
		$height_new = $width * $max_height / $max_width;
		//if the new width is greater than the actual width of the image, then the height is too large and the rest cut off, or vice versa
		if($width_new > $width){
			//cut point by height
			$h_point = (($height - $height_new) / 2);
			//copy image
			imagecopyresampled($dst_img, $src_img, 0, 0, 0, $h_point, $max_width, $max_height, $width, $height_new);
		}else{
			//cut point by width
			$w_point = (($width - $width_new) / 2);
			imagecopyresampled($dst_img, $src_img, 0, 0, $w_point, 0, $max_width, $max_height, $width_new, $height);
		}
		 
		$image($dst_img, $dst_dir, $quality);
	 
		if($dst_img)imagedestroy($dst_img);
		if($src_img)imagedestroy($src_img);
	}
?>
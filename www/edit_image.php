<?php

	
	session_start();

	$pagetitle = "Edit Image";
	
	include "./includes/dashboard_header.php";
	include "./includes/functions.php";
	include "./includes/db.php";

	checkLogin();

	$error =[];

	if($_GET['id']) {
		$bookId = $_GET['id'];
	}

	define('MAX_FILE_SIZE', 2097152);

	$ext = ['image/jpeg', 'image/jpg', 'image/png'];

		if(array_key_exists("upload", $_POST)) {

		if(empty($_FILES['pics']['name'])){
				$error['pics'] = "Select an Image";
			}

	
			if($_FILES['pics']['size'] > MAX_FILE_SIZE){
				$error['pics'] = "Image size too large";
			}

		
			if(!in_array($_FILES['pics']['type'], $ext)) {
				$error['pics'] = "Image type not supported";
			}


			if(empty($error)) {

				$img = uploadFiles($_FILES, 'pics', './uploads/');

					if($img[0]){

						$location = $img[1];
			}

			updateImage($conn, $bookId, $location);

			redirect("view_product.php");

			}

		}

?>
<div class="wrapper">
	<form id="register" action="" method="post" enctype="multipart/form-data">
		<div>
			<?php
				$info = displayErrors($error, 'pics');
				echo $info;

			?>
			<label>Image:</label>
			<input type="file" name="pics">
		</div>

		<input type="submit" name="upload" value="Upload" />
	</form>
</div>



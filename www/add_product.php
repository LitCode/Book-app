<?php

	
	session_start();
	
	include "./includes/dashboard_header.php";
	include "./includes/functions.php";
	include "./includes/db.php";

	$errors = [];

	$flag = ["Top-Selling", "Trending", "Recently-Viewed"];

	define('MAX_FILE_SIZE', 2097152);

	$ext = ['image/jpeg', 'image/jpg', 'image/png'];

	
	if(array_key_exists("register", $_POST)) {

		

		if(empty($_POST['title'])) {
			$errors['title'] = "Please enter book title";
		}

		if(empty($_POST['author'])) {
			$errors['author'] = "Please enter book author";
		}

		if(empty($_POST['price'])) {
			$errors['price'] = "Please enter book price";
		}
		

		if(empty($_POST['publication_date'])) {
			$errors['publication_date'] = "Please enter your publication date";
		}
		
		if(empty($_POST['category'])) {
			$errors['category'] = "Please select your category";
		}

		if(empty($_POST['flag'])) {
			$errors['flag'] = "Please a category";
		}
		

		
			//POPULATE DATABASE
			//echo "Registration successful";
		/* else {
			foreach ($errors as $err) {
				echo $err.'<br>';
			}
		}*/
		//firstwill check if the image field is empty
			if(empty($_FILES['pics']['name'])){
				$errors['pics'] = "Select an Image";
			}

		//second validation will check if the image size exceeds the stipulated mb
			if($_FILES['pics']['size'] > MAX_FILE_SIZE){
				$errors['pics'] = "Image size too large";
			}

		//third validation for image type support
			if(!in_array($_FILES['pics']['type'], $ext)) {
				$errors['pics'] = "Image type not supported";
			}



			if(empty($errors)){

				$img = uploadFiles($_FILES, 'pics', './uploads/');

					if($img[0]){

						$location = $img[1];
			}

			$clean = array_map('trim', $_POST);
			$clean['dest'] = $location;

			addProduct($conn, $clean);
			redirect("view_product.php");


			}

		}








?>

	
	<div class="wrapper">
		<h1 id="register-label">Add Product </h1>
		<hr>
		<form id="register"  action ="add_product.php" method ="POST" enctype="multipart/form-data">
			<div>
				<?php //if(isset($errors['fname'])) {echo '<span class="err">'.$errors['fname'].'</span>';}      
					$info = displayErrors($errors, 'title');
					echo $info;                    
				?>
				<label>Title:</label>
				<input type="text" name="title" placeholder="Title">
			</div>
			<div>
				<?php //if(isset($errors['lname'])) {echo '<span class="err">'.$errors['lname'].'</span>';}    
					$info = displayErrors($errors, 'author');
					echo $info;                     
				?>
				<label>Author:</label>	
				<input type="text" name="author" placeholder="Author">
			</div>

			<div>
				<?php //if(isset($errors['email'])) {echo '<span class="err">'.$errors['email'].'</span>';} 
					$info = displayErrors($errors, 'price');
					echo $info;                                          
				 ?>
				<label>Price:</label>
				<input type="text" name="price" placeholder="Price">
			</div>
			<div>
				<?php //if(isset($errors['password'])) {echo '<span class="err">'.$errors['password'].'</span>';}  
					$info = displayErrors($errors, 'publication_date');
					echo $info;                                          
			    ?>
				<label>Publication Date:</label>
				<input type="text" name="publication_date" placeholder="publication date">
			</div>

			<div>
					<?php
						$info = displayErrors($errors, 'category');
						echo $info;
					?>
					<label>Category :</label>
						<select name="category">
							<option>Select Category</option>
								<?php
									$fetch = fetchCategory($conn);
									echo $fetch;
								?>
						</select>
			</div>
 				
 			<div>
 				<?php
 					$info = displayErrors($errors, 'flag');
 					echo $info;
 				?>
 				<label>Flag:</label>
 					<select name="flag">
 						<option value="">Flag</option>
 							<?php foreach ($flag as $fl) { ?>
 								<option value="<?php echo $fl; ?>"><?php echo $fl;  ?></option>
 							<?php }  ?>                         

 					</select>

 			</div>

 			<div>
 				<?php
 					$info = displayErrors($errors, 'pics');
 					echo $info;
 				?>
 				<label>Image:</label>
 				<input type="file" name="pics">

 			</div>
			

			<p><input type="submit" name="register" value="register"></p>
		</form>

		
	</div>

<?php

	include "./includes/footer.php";

?>
</body>
</html>
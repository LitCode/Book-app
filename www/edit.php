<?php

	session_start();

	$pagetitle = "Edit Product";

	include "./includes/dashboard_header.php";
	include "./includes/functions.php";
	include "./includes/db.php";

	checkLogin();

	$errors = [];

	if($_GET['book_id']) {

		$book_id = $_GET['book_id'];
	}
	
	$item = getProductById($conn, $book_id);

	$category = getCategoryById($conn, $item[5]);

	$errors = [];






	if(array_key_exists("edit", $_POST)) {

		

		if(empty($_POST['edit_title'])) {
			$errors['edit_title'] = "Please enter book title";
		}

		if(empty($_POST['edit_author'])) {
			$errors['edit_author'] = "Please enter book author";
		}

		if(empty($_POST['edit_price'])) {
			$errors['edit_price'] = "Please enter book price";
		}
		

		if(empty($_POST['edit_publication_date'])) {
			$errors['edit_publication_date'] = "Please enter your publication date";
		}
		
		if(empty($_POST['category'])) {
			$errors['category'] = "Please select your category";
		}

		//if(empty($_POST['flag'])) {
		//	$errors['flag'] = "Please a category";
		//}



			if(empty($errors)){


			$clean = array_map('trim', $_POST);
			$clean['id'] = $book_id;

			updateProduct($conn, $clean);
			
			redirect("view_product.php");


			}

		}


?>

	
	<div class="wrapper">
		<div id="stream">
		
		<form id="register"  action ="" method ="POST">
			<div>
				<?php 
					$info = displayErrors($errors, 'edit_title');
					echo $info;                    
				?>
				<label>Edit Title:</label>
				<input type="text" name="edit_title" placeholder="Title" value="<?php echo $item[1];   ?>">
			</div>
			<div>
				<?php 
					$info = displayErrors($errors, 'edit_author');
					echo $info;                     
				?>
				<label>Edit Author:</label>	
				<input type="text" name="edit_author" placeholder="Author" value="<?php echo $item[2];   ?>">
			</div>

			<div>
				<?php 
					$info = displayErrors($errors, 'edit_price');
					echo $info;                                          
				 ?>
				<label>Edit Price:</label>
				<input type="text" name="edit_price" placeholder="Price" value="<?php echo $item[3];   ?>">
			</div>
			<div>
				<?php 
					$info = displayErrors($errors, 'edit_publication_date');
					echo $info;                                          
			    ?>
				<label>Edit Publication Date:</label>
				<input type="text" name="edit_publication_date" placeholder="publication date" value="<?php echo $item[4];   ?>">
			</div>

			<div>
					<?php
						$info = displayErrors($errors, 'category');
						echo $info;
					?>
					<label>Category :</label>
						<select name="category">
							<option value="<?php echo $category[0]; ?>"><?php  echo $category[1];    ?></option>
								<?php
									$fetch = fetchCategory($conn, $category[1]);
									echo $fetch;
								?>
						</select>
			</div>
 				
			

			<p><input type="submit" name="edit" value="Edit"></p>
		</form>

			<h4 class="jumpto"><a href="edit_image.php?id=<?php echo $book_id;   ?>">Edit Product Image</a></h4>
	</div>

<?php

	include "./includes/footer.php";

?>
</body>
</html>
<?php 
	
	session_start();

	include "./includes/dashboard_header.php";
	include "./includes/db.php";
	include "./includes/functions.php";

	checkLogin();

	 $errors = [];

	 if(array_key_exists("add", $_POST)) {

	 	if(empty($_POST['cat_name'])) {
	 		$errors['cat_name'] = "Please enter your category name";
	 	}
	 		if(empty($errors)) {
	 			
	 			$clean = array_map("trim", $_POST);

	 			addCategory($conn, $clean);


	 		}

	 }
?>
	<div class="wrapper">
		<div id="stream">
			<form id="register"  action ="add_category.php" method ="POST">
				<div>
						<?php
							$info = displayErrors($errors, 'cat_name');
							echo $info;

						?>
							<label>Add category:</label>
								<input type="text" name="cat_name" placeholder="Category Name">
									</div>
						

			           <input type="submit" name="add" value="Add">
		     </form>

		</div>
	</div>

<?php 

	include "./includes/footer.php"; 

?>


<?php
	
	session_start();
	
 	$page_title = "Login";
	
	include "./includes/header.php";
	include "./includes/db.php";
	include "./includes/functions.php";

	   $errors = [];

	   if(array_key_exists("login", $_POST)) {

	   		if(empty($_POST['email'])) {
	   			$errors['email'] = "Please enter your email address";
	   		}

	   		if(empty($_POST['password'])) {
	   			$errors['password'] = "Please enter your password";
	   		}

	   		if(empty($errors)) {
	   			$clean = array_map('trim', $_POST);

	   			//$data = adminLogin($conn, $clean);
	   			$data = adminLogin($conn, $clean);

	   			if($data[0]) {
	   				$details = $data[1];

					$_SESSION['name'] = $details['firstName']." ".$details['lastName'];
					$_SESSION['aid']  = $details['admin_id'];

					//header("Location:dashboard.php");

					redirect("add_category.php", "");
		   			
	   			}
	   		}
	   }


?>
	
	
	<div class="wrapper">
		<h1 id="register-label">Admin Login</h1>
		<hr>
		<form id="register"  action ="login.php" method ="POST">
			<div>
				<label>email:</label>
				<input type="text" name="email" placeholder="email">
			</div>
			<div>
				<label>password:</label>
				<input type="password" name="password" placeholder="password">
			</div>

			<input type="submit" name="login" value="login">
		</form>

		<h4 class="jumpto">Don't have an account? <a href="register.php">register</a></h4>
	</div>


<?php 

	include "./includes/footer.php"; 

?>
	
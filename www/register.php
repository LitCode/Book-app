<?php

	$page_title = "Register";

	include "./includes/header.php";
	include "./includes/functions.php";
	include "./includes/db.php";

	$errors = [];

	if(array_key_exists("register", $_POST)) {

		

		if(empty($_POST['fname'])) {
			$errors['fname'] = "PLease enter your firstname";
		}

		if(empty($_POST['lname'])) {
			$errors['lname'] = "Please enter your lastname";
		}

		if(empty($_POST['email'])) {
			$errors['email'] = "Please enter your email";
		}
		//this is whre we invoke

		if(doesEmailExists($conn, $_POST['email'])) {
			$errors['email'] = "Email already exists. Please enter another email";
		}

		if(empty($_POST['password'])) {
			$errors['password'] = "Please enter your password";
		}
		
		if(empty($_POST['pword'])) {
			$errors['pword'] = "Please confirm your password";
		}

		if($_POST['password'] !== $_POST['pword']) {
			$errors['pword'] = "Passwords do not match, please tey again";
		}

		if(empty($errors)) {

				$clean = array_map('trim', $_POST);
				adminRegister($conn, $clean);

				echo "You have been registered successful";

			//POPULATE DATABASE
			//echo "Registration successful";
		}/* else {
			foreach ($errors as $err) {
				echo $err.'<br>';
			}
		}*/


	}


?>

	
	<div class="wrapper">
		<h1 id="register-label">Register</h1>
		<hr>
		<form id="register"  action ="register.php" method ="POST">
			<div>
				<?php //if(isset($errors['fname'])) {echo '<span class="err">'.$errors['fname'].'</span>';}      
					$info = displayErrors($errors, 'fname');
					echo $info;                     ?>
				<label>first name:</label>
				<input type="text" name="fname" placeholder="first name">
			</div>
			<div>
				<?php //if(isset($errors['lname'])) {echo '<span class="err">'.$errors['lname'].'</span>';}    
					$info = displayErrors($errors, 'lname');
					echo $info                      ?>
				<label>last name:</label>	
				<input type="text" name="lname" placeholder="last name">
			</div>

			<div>
				<?php //if(isset($errors['email'])) {echo '<span class="err">'.$errors['email'].'</span>';} 
					$info = displayErrors($errors, 'email');
					echo $info                                            ?>
				<label>email:</label>
				<input type="text" name="email" placeholder="email">
			</div>
			<div>
				<?php //if(isset($errors['password'])) {echo '<span class="err">'.$errors['password'].'</span>';}  
					$info = displayErrors($errors, 'password');
					echo $info                                           ?>
				<label>password:</label>
				<input type="password" name="password" placeholder="password">
			</div>
 
			<div>
				<?php //if(isset($errors['pword'])) {echo '<span class="err">'.$errors['pword'].'</span>';}    
					$info = displayErrors($errors, 'pword');
					echo $info                                         ?>
				<label>confirm password:</label>	
				<input type="password" name="pword" placeholder="password">
			</div>

			<input type="submit" name="register" value="register">
		</form>

		<h4 class="jumpto">Have an account? <a href="login.php">login</a></h4>
	</div>

<?php

	include "./includes/footer.php";

?>
</body>
</html>
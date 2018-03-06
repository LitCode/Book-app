<?php
	
	include 'includes/db.php';
  	include 'includes/user_header.php';
    include 'includes/functions.php';


  $errors = array();

    if(array_key_exists('register', $_POST)) {

        if(empty($_POST['fName'])) {

          $errors['fName'] = "<p class=\"form-error\">Please input firstname</p>";
        }
        if(empty($_POST['lName'])) {

          $errors['lName'] = "<p class=\"form-error\">Please enter your lastname</p>";
        }
        if(empty($_POST['email'])) {

          $errors['email'] = "<p class=\"form-error\">Please enter your email</p>";
        }
        if(doesUserEmailExist($conn, $_POST['email'])) {

          $errors['email'] = "<p class=\"form-error\">Email already exists</p>";
        }
        if(empty($_POST['uName'])) {

          $errors['uName'] = "<p class=\"form-error\">Please enter your username</p>";
        }
        if(empty($_POST['password'])) {

          $errors['password'] = "<p class=\"form-error\">Please input your password</p>";
        }
        if(empty($_POST['pword'])) {

          $errors['pword'] = "<p class=\"form-error\">Please confirm your password</p>";
        }
        if($_POST['password'] != $_POST['pword']) {

          $errors['pword'] = "<p class=\"form-error\">Please enter correct password</p>";
        }
        if(empty($errors)) {

          $clean = array_map('trim', $_POST);

          userRegister($conn, $clean);

          $success = "Registration Successful!!  You can login now";

        
        }

    }

?>

  <body id="registration">
  
    <div class="main">

      <div class="registration-form">

        
        <form action="" method="POST" class="def-modal-form">

          <div class="cancel-icon close-form"></div>

          <label for="registration-from" class="header"><h3>User Registration</h3></label>

          <?php if(isset($success))  echo $success  ?>
          
          <input type="text" class="text-field first-name" name="fName" placeholder="Firstname">
          <?php  $data = displayErrors($errors, 'fName'); echo $data; ?>

         
          <input type="text" class="text-field last-name" name="lName" placeholder="Lastname">
           <?php $data = displayErrors($errors, 'lName'); echo $data; ?>

          
          <input type="email" class="text-field email" name="email" placeholder="Email">
          <?php $data = displayErrors($errors, 'email'); echo $data; ?>

         
          <input type="text" class="text-field username" name="uName" placeholder="Username">
          <?php $data = displayErrors($errors, 'uName'); echo $data; ?>

         
          <input type="password" class="text-field password" name="password" placeholder="Password">
          <?php $data = displayErrors($errors, 'password'); echo $data; ?>

          
          <input type="password" class="text-field confirm-password" name="pword" placeholder="Confirm Password">
          <?php $data = displayErrors($errors, 'pword'); echo $data; ?>

          <input type="submit" class="def-button" name="register" value="Register">

          <p class="login-option">Have an account already? <a href="user_login.php">Login</a></p>
        </form>
      </div>
    </div>
 <?php

    include 'includes/user_footer.php';


  ?>


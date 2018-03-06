<?php
	
	include 'includes/db.php';
  	include 'includes/user_header.php';
    include 'includes/functions.php';





$error = [];

    if (array_key_exists('login', $_POST)) {

      if (empty($_POST['email'])) {
        $error['email'] = "<p class=\"form-error\">Please enter your email</p>";
      }

      if (empty($_POST['password'])) {
        $error['password'] = "<p class=\"form-error\">Please enter your password</p>";
      }

      if (empty($error)) {
        $clean = array_map('trim', $_POST);

        $data = userLogin($conn, $clean);

        if ($data[0]) {
          $details = $data[1];

          $_SESSION['customer_id'] = $details['customer_id'];
          $_SESSION['name'] = $details['firstname'] .' '. $details['lastname'];

          redirect("user_catalogue.php?msg=", "User successfuly logged in");

        } else {
            header("location:user_login.php?msg='Invalid email and password'");
        }
      }
    }
    
?>

  ?>


<body id="login">
  <!-- DO NOT TAMPER WITH CLASS NAMES! -->

  <!-- main content starts here -->
  <div class="main">
    <div class="login-form">
      <form class="def-modal-form" action="" method="post">
        <div class="cancel-icon close-form"></div>
        <label for="login-form" class="header"><h3>Login</h3></label>
        <input type="text" class="text-field email" name="email" placeholder="Email">
         <?php  $info = displayErrors($error, 'email'); echo $info; ?>

        <input type="password" class="text-field password" name="password" placeholder="Password">
         <?php  $info = displayErrors($error, 'password'); echo $info; ?>

        <input type="submit" class="def-button login" name="login" value="Login">
      </form>
    </div>
  </div>
  </div>

   <?php

    include 'includes/user_footer.php';


  ?>
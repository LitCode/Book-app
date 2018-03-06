<?php

	include "./includes/functions.php";

	//defining a constant for our image size
	define("MAX_FILE_SIZE", 2097152);
	
	//defining the picture format suported
	$ext = ["image/png", "image/jpeg", "image/jpg"];
	
	if(array_key_exists("save", $_POST)) {

        //print_r($_FILES);  (to see our error after doing if array key exists)
      
        $errors = [];

        if(empty($_FILES['pics']['name'])) {
        	$errors[] = "Please select an image file";
        }  

        if($_FILES['pics']['size'] > MAX_FILE_SIZE) {
        	$errors[] = "File size to large. Maximum".MAX_FILE_SIZE;
        }

        if(!in_array($_FILES['pics']['type'], $ext)) {
        	$errors[] = "File format not supported";

        }
   
        //we want to generate random numbers

       /* $rnd = rand(0000000000, 9999999999);
        $strip_name = str_replace(' ', '_', $_FILES['pics']['name']);

        $filename = $rnd.$strip_name;
        $destination = './uploads/'.$filename;*/

        //if(!move_uploaded_file($_FILES['pics']['tmp_name'], $destination)) {
        	//$errors[] = "File not uploaded";
       // }

        if(empty($errors)) {
        	//move_uploaded_file($_FILES['pics']['tmp_name'], $destination);

        	//this is where we are invoking the function
        	$info = uploadFiles($_FILES, 'pics', 'uploads/');

        	if($info[0]) {
        		echo "File upload successful";
        	}

        } else {
        	foreach ($error as $err) {
        		echo $err;
        	}
        }
    }


?>


<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
		<form method="POST" action="index.php" enctype="multipart/form-data">

			<p>Please upload a file</p>
				<input type="file" name="pics">
				<input type="submit" name="save" value="submit">

		</form>
</body>
</html>
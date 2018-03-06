<?php

	function displayErrors($err, $key) {

		$result = "";

		if(isset($err[$key])) {
			$result = '<span class="err">'.$err[$key].'</span>';

		}

		return $result;
	}
	

	function adminRegister($dbconn, $input) {


		$hash = password_hash($input['password'], PASSWORD_BCRYPT);

		$stmt = $dbconn->prepare("INSERT INTO admin(firstname, lastname, email, hash)
									VALUES(:f, :l, :e, :h)");


		$data = [

			":f" => $input['fname'],
			":l" => $input['lname'],
			":e" => $input['email'],
			":h" => $hash

		];

		$stmt->execute($data);

	}

	
	function doesEmailExists($dbconn, $email) {

		$result = false;

		$stmt = $dbconn->prepare("SELECT email FROM admin WHERE email=:e");

		$stmt->bindParam(":e", $email);
		$stmt->execute();

		$count = $stmt->rowCount();

		if($count > 0) {
			$result = true;
		}

		return $result;
	}

//ADMIN LOGIN
//check out paasword_verify which as two parameters

	function adminLogin($dbconn, $input) {

		$result = [];

		$stmt = $dbconn->prepare("SELECT * FROM admin WHERE email=:e");

		$stmt->bindParam(":e", $input['email']);
		$stmt->execute();

		$count = $stmt->rowCount();
		$row = $stmt->fetch(PDO::FETCH_ASSOC);

		//print_r($row); exit();

		if($count !== 1 || !password_verify($input['password'], $row['hash'])) {
			$result[] = false;
		} else {
			$result[] = true;
			$result[] = $row;
		}
		
		return $result;
	}
	//to wrap a header

	function redirect($loc, $msg) {

		header("Location: ".$loc.$msg);
	}

	//to insert into cat tanle

	function addCategory($dbconn, $input) {
		
		$stmt = $dbconn->prepare("INSERT INTO category(category_name) VALUES(:catName)");

		$stmt->bindParam(":catName", $input['cat_name']);

		$stmt->execute();
	
	}

	function checkLogin() {

	 if(!isset($_SESSION['aid'])) {
		
			redirect("login.php", "");
    }
		}



		function viewCategory($dbconn) {
			$result = "";

			$stmt = $dbconn->prepare("SELECT * FROM category");

			$stmt->execute();

			while ($row = $stmt->fetch(PDO::FETCH_BOTH)) {

				$result .= '<tr><th>'.$row[0].'</th>';
				$result .= '<th>'.$row[1].'</th>';
				$result .= '<th><a href="edit_category.php?cat_id='.$row[0].'">edit</a></th>';
				$result .= '<th><a href="delete_category.php?cat_id='.$row[0].'">delete</a></th></tr>';


			}
				return $result;
		}

		

		function getCategoryById($dbconn, $catId) {
			$stmt = $dbconn->prepare("SELECT * FROM category WHERE category_id=:catId");

			$stmt->bindParam(":catId", $catId);

			$stmt->execute();

			$row = $stmt->fetch(PDO::FETCH_BOTH);

			return $row;
		}
		

		function editCategory($dbconn, $input) {

			$stmt = $dbconn->prepare("UPDATE category SET category_name=:cat_name WHERE category_id=:catId");

			$stmt->bindParam(":catId", $input['cat_id']);
			$stmt->bindParam(":cat_name", $input['cat_name']);

			$stmt->execute();

			redirect("view_category.php", "");
		}



		function addProduct($dbconn, $input) {
			$statement = $dbconn->prepare("INSERT INTO books(title, author, price, publication_date, category_id, flag, image_path)
											VALUES(:t, :a, :p, :pub, :cat, :f, :imag)");

			$data = [
				":t" => $input['title'],
				":a" => $input['author'],
				":p" => $input['price'],
				":pub" => $input['publication_date'],
				":cat" => $input['category'],
				":f" => $input['flag'],
				":imag" => $input['dest']

			];

			$statement->execute($data);

		}



		
		function viewProduct($dbconn) {
			$result = "";
			
			$stmt = $dbconn->prepare("SELECT * FROM books");

			//$stmt->bindParam(":f", $input['flag']);
			$stmt->execute();

			while ($row = $stmt->fetch(PDO::FETCH_BOTH)) {

				$result .= '<tr><td>'.$row[0].'</td>';
				$result .= '<td>'.$row[1].'</td>';
				$result .= '<td>'.$row[2].'</td>';
				$result .= '<td>'.$row[3].'</td>';
				$result .= '<td>'.$row[4].'</td>';
				$result .= '<td>'.$row[5].'</td>';
				$result .= '<td>'.$row[6].'</td>';
				$result .= '<td><img src="'.$row[7]. '" height="50" width="50"></td>';
				$result .= '<td><a href="edit.php?book_id=' .$row[0]. '">Edit</a></td>';
				$result .= '<td><a href="delete.php?book_id=' .$row[0]. '">Delete</a></td>';


		}   

				return $result;


		}

			function uploadFiles($files, $name, $loc) {
		
		$result = [];

		$rnd = rand(0000000000, 9999999999);
		$strip_name = str_replace(' ', '_', $files[$name]['name']);

		$filename = $rnd.$strip_name;
		$destination = $loc.$filename;

		if(move_uploaded_file($files[$name]['tmp_name'], $destination)){
			$result[] = true;
			$result[] = $destination;
		
		} else {
			$result[] = false;
		}

			return $result;

	}


		function fetchCategory ($dbconn, $val=NUL){

				$result = "";

				$select = $dbconn->prepare ("SELECT * FROM category");

				$select->execute();

				while ($row = $select->fetch(PDO::FETCH_BOTH)) {
					
					if($val == $row[1]) {
						continue;
					}

					$result .= "<option value='".$row[0]."'>" .$row[1]."</option>";
				}

					return $result;
		}

		
		function getProductById($dbconn, $id){

			$row = "";

			$statement = $dbconn->prepare("SELECT * FROM books WHERE book_id=:bookId");

			$statement->bindParam(':bookId', $id);
			$statement->execute();

			$row = $statement->fetch(PDO::FETCH_BOTH);

			return $row;

		}
		
		function updateProduct($dbconn, $input){

			$statement = $dbconn->prepare("UPDATE books SET title=:t, author=:a, price=:p, publication_date=:pub, category_id=:cat_id
											WHERE book_id=:bookId");

			$data = [

				":t" => $input['edit_title'],
				":a" => $input['edit_author'],
				":p" => $input['edit_price'],
				":pub" => $input['edit_publication_date'],
				"cat_id" => $input['category'],
				"bookId" => $input['id']


			];

			$statement->execute($data);


		}

		

		function updateImage($dbconn, $id, $location) {

			$statement = $dbconn->prepare("UPDATE books SET image_path = :img WHERE book_id = :bookId");

			$data = [
			
				":img" => $location,
				":bookId" => $id


			];

			$statement->execute($data);


		}

//FUNCTION BELOW IS FOR THE FRONT END!!!

	function showTopSeller($dbconn) {

		$result = "";

		$statement = $dbconn->prepare("SELECT * FROM books WHERE flag = 'Top-Selling' ");

		$statement->execute();

		while($query = $statement->fetch(PDO::FETCH_BOTH)) {

			$result .= '<div class="display-book" style="background:url'.$query[7].'background-size: cover;
						background-position: center;background-repeat: no-repeat;">
							
						</div>';
			$result .= '<div class="info">
							<h2 class="book-title">' .$query[1]. '</h2>';
			$result .=		'<h3 class="book-author">by ' .$query[2]. '</h3>';
			$result .=		'<h3 class="book-price">&dollar;' .$query[3]. '</h3>'; '</div>';

						

			/*background: url('../img/big.jpg');
  background-size: cover;
  background-position: center;
  background-repeat: no-repeat;*/

		}

			return $result;

		}


		function viewTrendingBooks($dbconn){

			$result = "";

			$statement = $dbconn->prepare("SELECT * FROM books WHERE flag='trending'");

			$statement->execute();

			while($row = $statement->fetch(PDO::FETCH_BOTH)) {

				$result .= '<li class="book" style="float:left";>
								<a href="book-preview.php?book_id=" '.$row[0]. '>
									<div class="book-cover">
										<img src="" '.$row[7]. '>
									</div>
								</a>
									<div class="book-price">
										<p>&dollar; '.$row[3]. '</p>
									</div>
							</li>';
				
			}

			return $result;

	}

	function viewRecentBooks($dbconn){

		$result = "";

		$statement = $dbconn->prepare("SELECT * FROM books WHERE flag='recently-viewed'");

		$statement->execute();

		while($row = $statement->fetch(PDO::FETCH_BOTH)) {

			$result .= '<div class="scroll-back"></div>
						<div class="scroll-front"></div>
						<li class="book" style="float:left">
							<a href="book-preview.php?book-cover">
								<div class="book-cover">
									<img src="' .$row[7].'">
								</div>
							</a>
							<div class="book-price">
								<p>&dollar"' .$row[3].'"</p>
							</div>
						</li>';
		}

			return $result;
	}


function userRegister($dbconn, $input) {

        $hash = password_hash($input['password'], PASSWORD_BCRYPT);

        $stmt = $dbconn->prepare("INSERT INTO customer(firstname, lastname, email, username, hash)VALUES(:f, :l, :e, :u, :h)");

        $data = [

            ":f" => $input['fName'],
            ":l" => $input['lName'],
            ":e" => $input['email'],
            ":u" => $input['uName'],
            ":h" => $hash
        ];

        $stmt->execute($data);
    }




    function doesUserEmailExist($dbconn, $email) {
		$result = false;

		$statement = $dbconn->prepare("SELECT email FROM customer WHERE :e=email");

		$statement->bindParam(":e", $email);
		$statement->execute();

		$count = $statement->rowCount();

		if($count > 0) {
			$result = true;
		}

		return $result;
	}



	function userLogin($dbconn, $input){

		$result = [];

		$statement = $dbconn->prepare("SELECT * FROM customer WHERE email =:e");

		$statement->bindParam(':e', $input['email']);

		$statement->execute();

		$count = $statement->rowCount();

		$row = $statement->fetch(PDO::FETCH_BOTH);
		echo $row['hash'];

		if (!password_verify($input['password'], $row['hash'])) {
			
			$result[] = false;
		} else {
			$result[] = true;
			$result[] = $row;
		}

		return $result;
	}




	function checkUserLogin(){
		if (!isset($_SESSION['customer_id'])) {
			header("location: user_login.php");
		}
	}

function viewBookCategory($dbconn){

		$result = "";

		$statement = $dbconn->prepare("SELECT * FROM category");

		$statement->execute();

		while ($row = $statement->fetch(PDO::FETCH_BOTH)) {
			
			$result .= '<li class="category">
								<a href="book-category.php?cat_id='.$row[0].'">' .$row[1]. 
							'</li>';
			

		}

		return $result;

	}




	function viewAllBooks($dbconn){

		$result = "";

		$statement = $dbconn->prepare("SELECT * FROM books");

		$statement->execute();

		while ($row = $statement->fetch(PDO::FETCH_BOTH)) {

			
			$result .= '<li class="book" style="float:left">
							<a href="book-preview.php?book_id=' .$row[0]. '">
								<div class="book-cover">
									<img src="'.$row[7]. '">
								</div>
							</a>
							<div class="book-price">
								<p>&dollar"' .$row[3]. '"</p>
							</div>
						</li>';
			
		}

		return $result;
	}




	function viewBooks($dbconn, $id){

		$result = "";

		$statement = $dbconn->prepare("SELECT * FROM books WHERE category_id=:catId");

		$statement->bindParam('catId', $id);

		$statement->execute();

		while ($row = $statement->fetch(PDO::FETCH_BOTH)) {

			
			$result .= '<li class="book" style="float:left">
			<a href="book-preview.php?book_id="' .$row[0].'">
						<div class="book-cover">
						<img src="' .$row[7]. '">
							</div>
							</a>
					<div class="book-price">
					<p>&dollar"' .$row[3]. '"</p>
			</div>
						</li>';
			
		}

		return $result;
	}
?>
<?php
	
	session_start();

	$pagetitle = "View Products";
	include "./includes/dashboard_header.php";
	include "./includes/db.php";
	include "./includes/functions.php";



?>

<div class="wrapper">
		<div id="stream">
			<table id="tab">
				<thead>
					<tr>
						<th>book id</th>
						<th>title</th>
						<th>author</th>
						<th>price</th>
						<th>publication date</th>
						<th>category</th>
						<th>Image</th>
						<th>edit</th>
						<th>delete</th>
					</tr>
				</thead>
				<tbody>
					<?php
						//it will fetch from out data base
						
						$info = viewProduct($conn);
						echo $info;

				
					?>

          		</tbody>
			</table>
		</div>

		<div class="paginated">
			<a href="#">1</a>
			<a href="#">2</a>
			<span>3</span>
			<a href="#">4</a>
		</div>
	</div>






<?php 

	include "./includes/footer.php"; 

?>

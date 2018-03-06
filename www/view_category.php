<?php

	include "./includes/dashboard_header.php";
	include "./includes/db.php";
	include "./includes/functions.php";


?>
	<div class="wrapper">
		<div id="stream">
			<table id="tab">
				<thead>
					<tr>
						<th>category id</th>
						<th>category name</th>
						<th>edit</th>
						<th>delete</th>
					</tr>
				</thead>
				<tbody>
					<?php
						//it will fetch from out data base
						$info = viewCategory($conn);
						echo $info;

					?>

          		</tbody>
			</table>
		</div>

		<div class="paginated">
			<a href="#">1</a>
			<a href="#">2</a>
			<span>3</span>
			<a href="#">2</a>
		</div>
	</div>

	<?php

	include "./includes/footer.php";

	?>
</body>
</html>

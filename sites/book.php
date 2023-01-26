<!DOCTYPE html>
<html>

<head>
	<title>Book Returned</title>
	<link rel="stylesheet" type="text/css" href="css/mystyle.css"> <!--link to mystyle.css -->
	<link rel="stylesheet" type="text/css" href="css/userstyle.css"> <!--link to userstyle.css -->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
</head>

<body>
	<?php
	require("repositories/library-repository.php");
	require("repositories/cookie-repository.php");

	$errorMessage = "";
	$user = null;


	if ($_SERVER["REQUEST_METHOD"] == "GET") {
		try {
			$listBook = getAllBook();
		} catch (Exception $ex) {
			$errorMessage += "<br>Issue fetching borrowing data!";
		}
	}
	?>
	<br>

	<table class="table table-striped" style="margin-left: 0;">
		<thead>
			<tr>
				<th>Name</th>
				<th>Category</th>
				<th>ISBN Number</th>
				<th></th>
			</tr>
		</thead>
		<tbody>
			<?php
			while ($row = $listBook->fetch_assoc()) {
				echo "<tr><td><a href=viewdetailbook.php?ID=" . $row["ID"] . ">" . $row["Name"] . "</a></td>" .
					"<td>" . $row["Category"] . "</td>" .
					"<td>" . $row["ISBNNumber"] . "</td>";
				echo "<td><input type='button' value='Update' onclick=" . "window.location='book_update.php?ID=" . $row["ID"] ."';" . ">&nbsp;";
				echo "<input type='button' value='Delete' onclick=" . "window.location='book_delete.php?ID=" . $row["ID"] ."';" . "></td></tr>";
			}
			?>
		</tbody>
	</table>
	<button onclick="window.location='book_add.php';">Add Book</button>
</body>

</html>
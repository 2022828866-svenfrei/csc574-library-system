<!DOCTYPE html>
<html>

<head>
		<title>Delete Book</title>
		<link rel="stylesheet" type="text/css" href="css/mystyle.css"> <!--link to mystyle.css -->
		<link rel="stylesheet" type="text/css" href="css/userstyle.css"> <!--link to userstyle.css -->
		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
</head>

<body>
	<script>
        function reloadAsGet(id, msg) {
            window.location = 'book.php';
            alert(msg);
        }
    </script>

	<?php
	require("repositories/library-repository.php");
	require("repositories/cookie-repository.php");

	$errorMessage = "";
	$user = null;

	if ($_SERVER["REQUEST_METHOD"] == "GET") {
        $id = $_GET['ID'];

        try {
            $detailBook = getBookDetail($id);
            $date = date_create($detailBook["PublishDate"]);
        } catch (Exception $ex) {
            $errorMessage += "<br>Issue fetching borrowing data!";
        }
    }

	if($_SERVER["REQUEST_METHOD"] == "POST"){
		$id = $_POST["id"];

		try {
		// Insert image content into database 
			$deleteSuccessful = deleteBook($id);

			if ($deleteSuccessful) {
				echo "<script>reloadAsGet(" . $id . ", 'Book successfully deleted');</script>"; // reload page with js command with GET request
			} else {
				$errorMessage = "The insert was unsuccesful, please try again.";
			}
		} catch (Exception $ex) {
			$errorMessage = $ex->getMessage();
		}
	}  
	?>
	<br><br>
	<!-- Button trigger modal -->
	<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <table style="margin-left: 0; width: 95%;">
            <tr>
                <td colspan="2">
                    <p class="errorMessage">
                        <?php echo $errorMessage; ?>
                    </p>
                </td>
            </tr>
            <tr>
                <td align="center" rowspan="9" width="15%"><?php echo '<img style="height: 300px; width: 300px;" src="images/uploads/'.$detailBook["Image"].'">'; ?></td>
            </tr>
            <tr>
                <td width="10%">Book Name:</td>
                <td><?php echo $detailBook["Name"]; ?></td>
                <td><input type="hidden" name="id" value="<?php echo $id; ?>"></td>
            </tr>
            <tr>
                <td width="10%">Category:</td>
                <td><?php echo $detailBook["Category"]; ?></td>
            </tr>
            <tr>
                <td width="10%">Description:</td>
                <td align="justify"><?php echo $detailBook["Description"]; ?></td>
            </tr>
            <tr>
                <td width="10%">Date Publish:</td>
                <td><?php echo date_format($date,"d/m/Y"); ?></td>
            </tr>
            <tr>
                <td width="10%">Place Publish:</td>
                <td><?php echo $detailBook["PublishPlace"]; ?></td>
            </tr>
            <tr>
                <td width="10%">Author:</td>
                <td><?php echo $detailBook["Author"]; ?></td>
            </tr>
            <tr>
                <td width="10%">ISBN:</td>
                <td><?php echo $detailBook["ISBNNumber"]; ?></td>
            </tr>
            <tr>
                <td width="10%">Price:</td>
                <td><?php echo $detailBook["Price"]; ?></td>
            </tr>
            <tr>
                <td></td>
                <td></td>
                <td align="right">
                	<button type="submit">Delete</button>
                	<button type="button" onclick="window.location='book.php'">Back</button>
                </td>
            </tr>
        </table>
    </form>

	<div id="deleteBooks" class="modal" tabindex="-1">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title"><center></center></h5>
					<i class='fa fa-exclamation-circle' style='font-size:60px;color:grey'></i>
					<button type="button" class="btn-close" onclick="document.getElementById('deleteBooks').style.display='none'" aria-label="Close"></button>
				</div>
				<form action=""  method="POST">
					<div class="modal-body">
						<p>Are you sure you want delete this book?</p>
						<input type="hidden" name="id" value="<?php echo $id; ?>">
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" onclick="document.getElementById('deleteBooks').style.display='none'">Cancel</button>
						<button type="submit" class="btn btn-primary">Yes</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</body>
</html>
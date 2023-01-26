<!DOCTYPE html>
<html>

<head>
	<title>Book Returned</title>
	<link rel="stylesheet" type="text/css" href="css/mystyle.css"> <!--link to mystyle.css -->
	<link rel="stylesheet" type="text/css" href="css/userstyle.css"> <!--link to userstyle.css -->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>

	<style>
		@media print {
			body {
				-webkit-print-color-adjust: exact;
				width: 100%;
			}
		}
	</style>
</head>

<body>
	<script>
		function printDiv(divName) {
		    var printContents = document.getElementById(divName).innerHTML;
		    var originalContents = document.body.innerHTML;

		    document.body.innerHTML = printContents;
		    window.print();
		    document.body.innerHTML = originalContents;
		}
	</script>
	<?php
	require("repositories/library-repository.php");

	$errorMessage = "";

	if ($_SERVER["REQUEST_METHOD"] == "GET") {
		try {
			$listBook = getAllBooked();
		} catch (Exception $ex) {
			$errorMessage += "<br>Issue fetching borrowing data!";
		}
	}
	?>
	<br>

	<table class="table table-striped" style="margin-left: 0;">
		<thead>
			<tr>
				<th>Book Name</th>
				<th>Name</th>
				<th>From Date</th>
				<th>To Date</th>
				<th>Bill (RM)</th>
				<th>Status</th>
				<th></th>
			</tr>
		</thead>
		<tbody>
			<?php
			$latePrice = 0.5;
			while ($row = $listBook->fetch_assoc()) {
				$totalPrice = 0;
				$fromDate = date('d/m/Y',strtotime($row["FromDate"]));
				$toDate = date('d/m/Y',strtotime($row["ToDate"]));
				$todayDate = date("d/m/Y");

				$date = new DateTime($row["ToDate"]);
				$now = new DateTime();
				$diff = date_diff($now,$date);

				if ($toDate < $todayDate) {
					$totalPrice = $latePrice * $diff->format("%a");
				}

				try {
					$checkReceipt = checkReceipt($row["ID"]);
					if ($checkReceipt == null){
						$insertReceipt = insertReceipt($row["ID"], $diff->format("%a"), $totalPrice);
					} else {
						if ($checkReceipt["Status"] == 'B'){
							$updateReceipt = updateReceipt($row["ID"], $diff->format("%a"), $totalPrice);							
						}
					}
				} catch (Exception $ex) {
					$errorMessage += "<br>Issue insert/update receipt data!";
				}

				echo "<tr><td>" . $row["Name"] . "</td>" .
					"<td>" . $row["FullName"] . "</td>" .
					"<td>" . $fromDate . "</td>" .
					"<td>" . $toDate . "</td>" .
					"<td>" . $totalPrice . "</td>" .
					"<td>" . $row["Status"] . "</td>";
				echo "<td><button onclick=" . "document.getElementsByClassName('modal')[0].style.display='block'" . ">Print</button>";
				echo "<input type=hidden name=ID value=" . $row["ID"] . "></td></tr>";
			}
			?>
		</tbody>
	</table>
	
	<div class="modal" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" style="display: none">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h1 class="modal-title fs-5" id="exampleModalLabel">Receipt</h1>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" onclick="document.getElementsByClassName('modal')[0].style.display='none'"></button>
				</div>
				<div id="printReceipt" class="modal-body" align="center">
					<table class="table table-borderless" style="margin-left: 0">
						<thead>
							<tr>
								<td scope="col" align="center"><img src="images/kkslheader.png" alt="logoheader" width="200" height="20"></td>
							</tr>
							<tr>
								<td scope="col" align="center"><b>Kolej Komuniti Selandar</b><br>Jalan Batang Melaka,77500 Selandar, Melaka</td>
							</tr>
							<tr>
								<td scope="col" align="right"><b><?php echo date("d/m/Y"); ?></b></td>
							</tr>
						</thead>
					</table>
					<table class="table" style="margin-left: 0">
						<thead>
							<tr>
								<th scope="col">No</th>
								<th scope="col">Book Name</th>
								<th scope="col" align="center">Late (Days)</th>
								<th scope="col" align="center">Penalty (RM)</th>
							</tr>
						</thead>
						<tbody>
							<!-- <?php
								$no = 0;
								while ($row = $getReceipt->fetch_assoc()) {
								?>
									<tr>
										<th scope="row"><?php echo $no ?></th>
										<td><?php echo $getReceipt["Name"] ?></td>
										<td><?php echo $getReceipt["LateDay"] ?></td>
										<td><?php echo $getReceipt["Penalty"] ?></td>
									</tr>
									<tr>
					                  	<th scope="row"></th>
					                  	<td colspan="2"><b>Total</b></td>
					                  	<td align="right"><?php echo $getReceipt["Penalty"] ?></td>
					                </tr>
								<?php
								$no = $no + 1;
								}
							?>	 -->
							<tr>
			                  	<th scope="row">1</th>
			                  	<td>Power Parenting: Motivasi Anak Pintar</td>
			                  	<td align="center">2</td>
			                  	<td align="right">5.00</td>
			                </tr>
			                <tr>
			                  	<th scope="row"></th>
			                  	<td colspan="2"><b>Total</b></td>
			                  	<td align="right">5.00</td>
			                </tr>
						</tbody>
					</table>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-bs-dismiss="modal" onclick="document.getElementsByClassName('modal')[0].style.display='none'">Close</button>
					<button type="button" class="btn btn-primary" onclick="printDiv('printReceipt')">Print</button>
				</div>
			</div>
		</div>
	</div>
</body>

</html>
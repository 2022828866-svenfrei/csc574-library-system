<!DOCTYPE html>
<html>

<head>
    <title>Borrow Status</title>
    <link rel="stylesheet" type="text/css" href="css/mystyle.css"> <!--link to mystyle.css -->
    <link rel="stylesheet" type="text/css" href="css/userstyle.css"> <!--link to userstyle.css -->

    <style>
        .borrowingTable {
            border: 1px solid;
        }
    </style>
</head>

<body>

<?php
include 'repositories/conn.php';
require("repositories/library-repository.php");
require("repositories/cookie-repository.php");


$bookid = $_POST['bookid'];
$userid = $_POST['userid'];
$datestart = $_POST['datestart'];
$dateend = $_POST['dateend'];


$sql = "INSERT INTO `borrow`(`BookFK`, `UserFK`, `FromDate`, `ToDate`) VALUES ($bookid, $userid, '$datestart', '$dateend')";
if (!mysqli_query($conn, $sql)) {
    die('Error: ' . mysqli_error($conn));
}
echo "<p align='center'><h1>Awesome!</h1></p>";
echo "<p align= 'center'><img src='images/successicon.png' alt='success2' width='250' height='250'><br></p>";
echo "<p align='center'>You successfully created booking<br></p>";
echo "<p align='center'>To see your booking <a href=personal.php>--Click Here--</a></p>";

?>
</body>

</html>
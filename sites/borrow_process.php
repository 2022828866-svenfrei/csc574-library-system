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
echo "1 record successfully added..<br>";
echo "<a href=listForum.php>Display all</a>";

?>
<?php
include 'repositories/conn.php';
require("repositories/library-repository.php");
require("repositories/cookie-repository.php");

$sql= "INSERT INTO `borrow`(`BookFK`, `UserFK`, `FromDate`, `ToDate`) VALUES ('$_GET[bookid_form]','$_GET[userid_form]','$_POST[datestart_form]','$_POST[dateend_form]')";
if(!mysqli_query($conn, $sql)){
    die('Error: '.mysqli_error_($conn));
}
echo "1 record successfully added..<br>";
echo "<a href=listForum.php>Display all</a>";

?>
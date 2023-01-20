<?php
include 'repositories/conn.php';
$id = $_GET['BookID'];
$result = mysqli_query($conn, "SELECT * FROM `book` WHERE `BookID` = $id;");
$row = mysqli_fetch_row($result);
echo "<table>";
echo "<tr><td rowspan='8'>PICTURE HERE $row[8]</td>";
    echo "<td>Book Name: $row[1]</td>";
    echo "<td>Category: $row[2]<br></td></tr>";
    echo "<tr><td colspan='2'>Description: <br>$row[6]<br></td></tr>";
    echo "<tr><td colspan='2'>Date Publish: $row[3]<br></td></tr>";
    echo "<tr><td>Place Publish: $row[4]<br></td></tr>";
    echo "<tr><td>Author: $row[5]<br></td></tr>";
    echo "<tr><td>ISBN:$row[7]<br></td><tr>";
    echo "<tr><td style='color:red'>Please login as member!</td></tr>";
    echo "</tr>";
    echo "</table>";
mysqli_free_result($result);
mysqli_close($conn);
?>
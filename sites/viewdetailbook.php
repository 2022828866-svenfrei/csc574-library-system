<?php
include 'repositories/conn.php';
$bookid = $_GET['ID'];
$result = mysqli_query($conn, "SELECT * FROM `book` WHERE `ID` = $bookid;");
$row = mysqli_fetch_row($result);
echo "<table>";
echo "<tr><td rowspan='9'>PICTURE HERE $row[7]</td>";
    echo "<td>Book Name: $row[1]</td></tr>";
    echo "<tr><td>Category: $row[2]<br></td></tr>";
    echo "<tr><td colspan='2'>Description: <br>$row[5]<br></td></tr>";
    echo "<tr><td colspan='2'>Date Publish: $row[3]<br></td></tr>";
    echo "<tr><td>Place Publish: $row[8]<br></td></tr>";
    echo "<tr><td>Author: $row[4]<br></td></tr>";
    echo "<tr><td>ISBN:$row[6]<br></td><tr>";
    echo "<td style='color:red'><a href=borrow.php?ID=$row[0]>Borrow Now</td>";
    echo "</tr>";
    echo "</table>";
mysqli_free_result($result);
mysqli_close($conn);
?>
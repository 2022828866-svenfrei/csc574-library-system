<?php
include 'repositories/conn.php';
/*echo "<table border='1'><tr><th>Name</th><th>Category</th>";
echo "<th>Publish Date</th><th>Publish Place</th>";
echo "<th>Author</th><th>Description</th>";
echo "<th>ISBN</th><th>Picture</th>";
echo "<th>View</th><th>Booking</th></tr>";*/
echo "<table>";
$result = mysqli_query($conn, "SELECT * FROM `book` WHERE `Category` = 'Art';");
while($row = mysqli_fetch_row($result)){
    echo "<tr><td>PICTURE HERE $row[7]</td>";
    echo "<td>&nbsp Book Name: $row[1]</td>";
    echo "<td>&nbsp Category: $row[2]</td>";
    echo "<td>&nbspAuthor: $row[4]</td>";
    echo "<td>&nbsp<a href=viewdetailbook.php?ID=$row[0]>View More<a></td>";
    echo "<td style='color:red'><a href=borrow.php?ID=$row[0]>Borrow Now</td>";
    echo "</tr><br>";
    }
echo "</table>";
mysqli_free_result($result);
mysqli_close($conn);
?>
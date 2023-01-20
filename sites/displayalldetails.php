<?php
include 'repositories/conn.php';
/*echo "<table border='1'><tr><th>Name</th><th>Category</th>";
echo "<th>Publish Date</th><th>Publish Place</th>";
echo "<th>Author</th><th>Description</th>";
echo "<th>ISBN</th><th>Picture</th>";
echo "<th>View</th><th>Booking</th></tr>";*/
echo "<table>";
$result = mysqli_query($conn, "SELECT * FROM `book` ORDER BY `id` DESC;");
while($row = mysqli_fetch_row($result)){
    echo "<tr><td rowspan='8'>PICTURE HERE $row[8]</td>";
    echo "<td>Book Name: $row[1]</td>";
    echo "<td>Category: $row[2]</td></tr>";
    echo "<tr><td colspan='2'>Description: <br>$row[6]</td></tr>";
    echo "<tr><td colspan='2'>Date Publish: $row[3]</td></tr>";
    echo "<tr><td>Place Publish: $row[4]</td></tr>";
    echo "<tr><td>Author: $row[5]</td></tr>";
    echo "<tr><td>ISBN:$row[7]</td><tr>";
    echo "<tr><td><a href=details.php?id=$row[0]>View More<a></td>";
    echo "<td>Please login as member!</td></tr>";
    echo "</tr>";
    }
echo "</table>";
mysqli_free_result($result);
mysqli_close($conn);
?>
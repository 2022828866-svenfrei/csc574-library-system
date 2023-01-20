<?php
include 'repositories/conn.php';
echo "<table border='1'><tr><th>Name</th><th>Category</th>";
echo "<th>Publish Date</th><th>Publish Place</th>";
echo "<th>Author</th><th>Description</th>";
echo "<th>ISBN</th><th>Picture</th></tr>";
$result = mysqli_query($conn, "SELECT * FROM `book` ORDER BY `id` DESC;");
while($row = mysqli_fetch_row($result)){
    echo "<tr><td>$row[1]</td>";
    echo "<td>$row[2]</td>";
    echo "<td>$row[3]</td>";
    echo "<td>$row[4]</td>";
    echo "<td>$row[5]</td>";
    echo "<td>$row[6]</td>";
    echo "<td>$row[7]</td>";
    echo "<td>$row[8]</td>";
    echo "</tr>";
    }
echo "</table>";
mysqli_free_result($result);
mysqli_close($conn);
?>
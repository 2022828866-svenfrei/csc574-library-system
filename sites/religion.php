<!DOCTYPE html>
<html>

<head>
    <title>Religion</title>
    <link rel="stylesheet" type="text/css" href="css/mystyle.css"> <!--link to mystyle.css -->

</head>

<body class="fontp">
<?php
include 'repositories/conn.php';
echo "<p><h1>Religion</h1></p>";
echo "<table>";
$result = mysqli_query($conn, "SELECT * FROM `book` WHERE `Category` = 'Religion';");
while($row = mysqli_fetch_row($result)){
    echo '<tr><td><img style="height: 100px; width: 100px;" src="images/uploads/'.$row[7].'"></td>';
    echo "<td>&nbsp ||Book Name: $row[1]</td>";
    echo "<td>&nbsp ||&nbspCategory: $row[2]</td>";
    echo "<td>&nbsp ||&nbspAuthor: $row[4]</td>";
    echo "<td>&nbsp<a href=viewdetailbook.php?ID=$row[0]><button type='button'>View More</button><a></td>";
    echo "<td style='color:red'><a href=borrow.php?ID=$row[0]><button type='button'>Borrow Now</button></td>";
    echo "</tr>";
    }
echo "</table>";
mysqli_free_result($result);
mysqli_close($conn);
?>
</body>

</html>
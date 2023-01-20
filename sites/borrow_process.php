<?php
include 'repositories/conn.php';
$id = $_GET['ID'];
$update = "UPDATE user SET first_name='$_POST[firstname]', last_name='$_POST[lastname]', email='$_POST[email]', pass_word='$_POST[password]', registration_date='$_POST[reg_date]' where user_id=$userid";
if (!mysqli_query($conn, $update)){
    die('Error: '.mysqli_error_($conn));
}
$result = mysqli_query($conn, "select * from user where user_id=$userid");
$row = mysqli_fetch_row($result);
echo "User ID : $row[0]<br> First name: $row[1]<br>";
echo "Last name: $row[2]<br> Email:$row[3]<br>";
echo "Password: $row[4]<br> Registration date:$row[5]<br>";
echo "<a href=display_table.php> Back to table</a>";
mysqli_free_result($result);
mysqli_close($conn);
?>

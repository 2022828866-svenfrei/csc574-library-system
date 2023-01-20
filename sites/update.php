<?php
include 'conn.php';
$userid = $_GET['userid'];
$result = mysqli_query($conn, "select * from book where user_id=$id");
$row = mysqli_fetch_row($result);
echo "<form action=update_process.php?id=$row[0] method=post>";
echo "User ID :<input type=text name=userid value='$row[0]' readonly><br>";
echo "First name: <input type=text name=firstname value='$row[1]'<br>";
echo "Last name: <input type=text name=lastname value='$row[2]'<br>";
echo "Email: <input type=text name=email value='$row[3]'<br>";
echo "Password: <input type=text name=password value='$row[4]'<br>";
echo "Reg date: <input type=text name=reg_date value='$row[5]'<br>";




echo "<input type=submit value=Update>";
mysqli_free_result($result);
mysqli_close($conn);
?>
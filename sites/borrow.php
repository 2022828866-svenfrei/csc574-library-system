<!DOCTYPE html>
<html>

<head>
    <title>Borrow</title>
    <link rel="stylesheet" type="text/css" href="css/mystyle.css"> <!--link to mystyle.css -->
 </head>

<body>
    <script>
        function reloadAsGet() {
            var loc = window.location;
            window.location = loc.protocol + '//' + loc.host + loc.pathname + loc.search;
        }

        
    </script>

    <?php
    require("repositories/library-repository.php");
    require("repositories/cookie-repository.php");
    include 'repositories/conn.php';
   

    $errorMessage = "";
    $user = null;


    if ($_SERVER["REQUEST_METHOD"] == "GET") {
        try {
            $user = getUserByEmail(getCurrentUser());

            if ($user == null) {
                $errorMessage = "<b style='color:red'>Please log in your member account!</b>";
            }
        } catch (Exception $ex) {
            $errorMessage = "Issue fetching user data!";
        }

        try {
            $borrowings = getBookingsByUserEmail(getCurrentUser());
        } catch (Exception $ex) {
            $errorMessage += "<br>Issue fetching borrowing data!";
        }
    }
    ?>
    <p><h2> Please choose a date to borrow the book and a date to return it. </h2></p>
    <form method="post" action="borrow_process.php" onsubmit="">
        <table>

            <tr>
                <td colspan="2">
                    <p class="errorMessage">
                        <?php echo $errorMessage; ?>
                    </p>
                </td>
            </tr>
            <tr>
                <td>User ID:</td>
                <td>
                    <input id="userid_form" name="userid" type="text" value="<?php echo $user["ID"]; ?>" readonly>
                </td>
            </tr>
            <tr>
                <td>Book ID:</td>
                <td>
                    <input id="bookid_form" name="bookid" type="text" value="<?php echo $bookid = $_GET['ID']; ?>" readonly>
                </td>
            </tr>
            <tr>
                <td>Date Start:</td>
                <td>
                    <input id="datestart_form" class="inputField" name="datestart" type="date" value="">
                </td>
            </tr>
            <tr>
                <td>Date End:</td>
                <td>
                    <input id="dateend_form" class="inputField" name="dateend" type="date" value="">
                </td>
            </tr>
            <tr>
                <td>
                    <br><input class="submitButton" type="submit" value="Continue">
                </td>
            </tr>
        </table>
    </form>

    </table>
</body>

</html>
<!DOCTYPE html>
<html>

<head>
    <title>Borrow</title>
    <link rel="stylesheet" type="text/css" href="css/mystyle.css"> <!--link to mystyle.css -->
    <link rel="stylesheet" type="text/css" href="css/userstyle.css"> <!--link to userstyle.css -->

    <style>
       /* .borrowingTable {
            border: 1px solid;
        }*/
    </style>
</head>

<body>
    <script>
        function reloadAsGet() {
            var loc = window.location;
            window.location = loc.protocol + '//' + loc.host + loc.pathname + loc.search;
        }

        /*function validateForm() {
            let isInputValid = true;

            isInputValid = validateInputField(document.getElementById("nameInput")) && isInputValid;
            isInputValid = validateInputField(document.getElementById("emailInput")) && isInputValid;
            isInputValid = validateInputField(document.getElementById("streetInput")) && isInputValid;
            isInputValid = validateInputField(document.getElementById("zipInput")) && isInputValid;
            isInputValid = validateInputField(document.getElementById("stateInput")) && isInputValid;
            isInputValid = validateInputField(document.getElementById("passwordInput")) && isInputValid;
            isInputValid = validateInputField(document.getElementById("confirmPasswordInput")) && isInputValid;

            if (document.getElementById("passwordInput").value !== document.getElementById("confirmPasswordInput").value) {
                document.getElementById("confirmPasswordInput").className = "errorInput";
                return false;
            }

            return isInputValid;
        }

        function validateInputField(field) {
            if (field.value == "") {
                field.className = "errorInput";
                return false;
            }
            else {
                field.className = "";
                return true;
            }
        }*/
    </script>

    <?php
    require("repositories/library-repository.php");
    require("repositories/cookie-repository.php");
    include 'repositories/conn.php';
   /* $bookid = $_GET['ID'];
    $result = mysqli_query($conn, "SELECT * FROM `book` WHERE `ID` = $bookid");
    $row = mysqli_fetch_row($result);*/

    $errorMessage = "";
    $user = null;


    if ($_SERVER["REQUEST_METHOD"] == "GET") {
        try {
            $user = getUserByEmail(getCurrentUser());

            if ($user == null) {
                $errorMessage = "Please log in your member account!";
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

    // perform update
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $id = $_POST["ID"];
      
        try {
            $updateSuccessful = updateUser($name, $email, $password, $street, $zip, $state);

            if ($updateSuccessful) {
                setCurrentUser($email);
                echo "<script>reloadAsGet();</script>"; // reload page with js command with GET request
            } else {
                $errorMessage = "The update was unsuccesful, please try again.";
            }
        } catch (Exception $ex) {
            $errorMessage = $ex->getMessage();
        }
    }
    ?>

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
                    <input id="userid_form" name="userid" type="text"
                        value="<?php echo $user["ID"]; ?>" readonly>
                </td>
            </tr>
            <tr>
                <td>Book ID:</td>
                <td>
                    <input id="bookid_form" name="bookid" type="text"
                        value="<?php echo $bookid = $_GET['ID']; ?>" readonly>
                </td>
            </tr>
            <tr>
                <td>Date Start:</td>
                <td>
                    <input id="datestart_form" class="inputField" name="datestart" type="date"
                        value="">
                </td>
            </tr>
            <tr>
                <td>Date End:</td>
                <td>
                    <input id="dateend_form" class="inputField" name="dateend" type="date"
                        value="">
                </td>
            </tr>
            <tr>
                <td>
                    <input class="submitButton" type="submit" value="Continue">
                </td>
            </tr>
        </table>
    </form>

    </table>
</body>

</html>
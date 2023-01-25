<!DOCTYPE html>
<html>

<head>
    <title>Personal Page</title>
    <link rel="stylesheet" type="text/css" href="css/mystyle.css"> <!--link to mystyle.css -->
    <link rel="stylesheet" type="text/css" href="css/userstyle.css"> <!--link to userstyle.css -->

    <style>
        .borrowingTable {
            border: 1px solid;
        }
    </style>
</head>

<body>
    <script>
        function reloadAsGet() {
            var loc = window.location;
            window.location = loc.protocol + '//' + loc.host + loc.pathname + loc.search;
        }

        function validateForm() {
            let isInputValid = true;

            isInputValid = validateInputField(document.getElementById("nameInput")) && isInputValid;
            isInputValid = validateInputField(document.getElementById("emailInput")) && isInputValid;
            isInputValid = validateInputField(document.getElementById("uitmIdInput")) && isInputValid;
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
        }
    </script>

    <?php
    require("repositories/library-repository.php");
    require("repositories/cookie-repository.php");

    $errorMessage = "";
    $user = null;


    if ($_SERVER["REQUEST_METHOD"] == "GET") {
        try {
            $user = getUserByEmail(getCurrentUser());

            if ($user == null) {
                $errorMessage = "Issue fetching user data!";
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
        $name = $_POST["name"];
        $email = $_POST["email"];
        $uitmId = $_POST["uitmId"];
        $street = $_POST["street"];
        $zip = $_POST["zip"];
        $state = $_POST["state"];
        $password = $_POST["password"];

        try {
            $updateSuccessful = updateUser($name, $email, $uitmId, $password, $street, $zip, $state);

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

    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" onsubmit="return validateForm()">
        <table>

            <tr>
                <td colspan="2">
                    <p class="errorMessage">
                        <?php echo $errorMessage; ?>
                    </p>
                </td>
            </tr>
            <tr>
                <td>Name:</td>
                <td>
                    <input id="nameInput" class="inputField" name="name" type="text"
                        value="<?php echo $user["FullName"]; ?>">
                </td>
            </tr>
            <tr>
                <td>Email:</td>
                <td>
                    <input id="emailInput" class="inputField" name="email" type="email"
                        value="<?php echo $user["Email"]; ?>">
                </td>
            </tr>
            <tr>
                <td>Staff or Student Id:</td>
                <td>
                    <input id="uitmIdInput" class="inputField" name="uitmId" type="uitmId"
                        value="<?php echo $user["UitmID"]; ?>">
                </td>
            </tr>
            <tr>
                <td>Street:</td>
                <td>
                    <input id="streetInput" class="inputField" name="street" type="text"
                        value="<?php echo $user["Street"]; ?>">
                </td>
            </tr>
            <tr>
                <td>Zip:</td>
                <td>
                    <input id="zipInput" class="inputField" name="zip" type="number"
                        value="<?php echo $user["Zip"]; ?>">
                </td>
            </tr>
            <tr>
                <td>State:</td>
                <td>
                    <input id="stateInput" class="inputField" name="state" type="text"
                        value="<?php echo $user["State"]; ?>">
                </td>
            </tr>
            <tr>
                <td>Password:</td>
                <td>
                    <input id="passwordInput" class="inputField" name="password" type="password">
                </td>
            </tr>
            <tr>
                <td>Confirm Password:</td>
                <td>
                    <input id="confirmPasswordInput" class="inputField" name="confirmPassword" type="password">
                </td>
            </tr>
            <tr>
                <td>
                    <input class="submitButton" type="submit" value="Update">
                </td>
            </tr>
        </table>
    </form>

    <br>

    <table class="borrowingTable">
        <thead>
            <tr>
                <th>Book</th>
                <th>From</th>
                <th>To</th>
                <th>Bill</th>
            </tr>
        </thead>
        <tbody>
            <?php
            while ($row = $borrowings->fetch_assoc()) {
                echo "<tr><td>" . $row["Name"] . "</td>" .
                    "<td>" . $row["FromDate"] . "</td>" .
                    "<td>" . $row["ToDate"] . "</td>" .
                    "<td>" . $row["IsBillSettled"] . "</td></tr>";
            }
            ?>
        </tbody>
    </table>
</body>

</html>
<!DOCTYPE html>
<html>

<head>
    <title>Register User</title>
    <link rel="stylesheet" type="text/css" href="css/mystyle.css"> <!--link to mystyle.css -->
    <link rel="stylesheet" type="text/css" href="css/userstyle.css"> <!--link to userstyle.css -->
</head>

<body>
    <?php
    require("repositories/library-repository.php");
    require("repositories/cookie-repository.php");

    $errorMessage = "";

    $name = "";
    $email = "";
    $street = "";
    $zip = "";
    $state = "";
    $password = "";
    $confirmPassword = "";

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $name = $_POST["name"];
        $email = $_POST["email"];
        $street = $_POST["street"];
        $zip = $_POST["zip"];
        $state = $_POST["state"];
        $password = $_POST["password"];

        try {
            $insertSuccessful = insertUser($name, $email, $password, $street, $zip, $state);

            if ($insertSuccessful) {
                setCurrentUser($email);
                echo "<script>window.parent.location.reload();</script>"; // reload page with js command
            } else {
                $errorMessage = "The insert was unsuccesful, please try again.";
            }
        } catch (Exception $ex) {
            $errorMessage = $ex->getMessage();
        }
    }
    ?>

    <script>
        function validateForm() {
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
            console.log(field.value);
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
                    <input id="nameInput" class="inputField" name="name" type="text" value="<?php echo $name; ?>">
                </td>
            </tr>
            <tr>
                <td>Email:</td>
                <td>
                    <input id="emailInput" class="inputField" name="email" type="email" value="<?php echo $email; ?>">
                </td>
            </tr>
            <tr>
                <td>Street:</td>
                <td>
                    <input id="streetInput" class="inputField" name="street" type="text" value="<?php echo $street; ?>">
                </td>
            </tr>
            <tr>
                <td>Zip:</td>
                <td>
                    <input id="zipInput" class="inputField" name="zip" type="number" value="<?php echo $zip; ?>">
                </td>
            </tr>
            <tr>
                <td>State:</td>
                <td>
                    <input id="stateInput" class="inputField" name="state" type="text" value="<?php echo $state; ?>">
                </td>
            </tr>
            <tr>
                <td>Password:</td>
                <td>
                    <input id="passwordInput" class="inputField" name="password" type="password"
                        value="<?php echo $password; ?>">
                </td>
            </tr>
            <tr>
                <td>Confirm Password:</td>
                <td>
                    <input id="confirmPasswordInput" class="inputField" name="confirmPassword" type="password"
                        value="<?php echo $confirmPassword; ?>">
                </td>
            </tr>
            <tr>
                <td>
                    <input class="submitButton" type="submit" value="Register">
                </td>
            </tr>
        </table>
    </form>
</body>

</html>
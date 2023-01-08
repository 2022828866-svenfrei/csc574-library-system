<!DOCTYPE html>
<html>

<head>
    <title>Login User</title>
    <link rel="stylesheet" type="text/css" href="css/mystyle.css"> <!--link to mystyle.css -->
    <link rel="stylesheet" type="text/css" href="css/userstyle.css"> <!--link to userstyle.css -->
</head>

<body>
    <?php
    require("repositories/library-repository.php");
    require("repositories/cookie-repository.php");

    $errorMessage = "";

    $email = "";
    $password = "";

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $email = $_POST["email"];
        $password = $_POST["password"];

        try {
            $user = getUserByEmail($email);

            if ($user !== null && $user["Password"] === $password) {
                setCurrentUser($email);
                echo "<script>window.parent.location.reload();</script>"; // reload page with js command
            } else {
                $errorMessage = "Username or password is incorrect!";
            }
        } catch (Exception $ex) {
            $errorMessage = "Username or password is incorrect!";
        }
    }
    ?>

    <script>
        function validateForm() {
            let isInputValid = true;

            isInputValid = validateInputField(document.getElementById("emailInput")) && isInputValid;
            isInputValid = validateInputField(document.getElementById("passwordInput")) && isInputValid;

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
                <td>Email:</td>
                <td>
                    <input id="emailInput" class="inputField" name="email" type="email" value="<?php echo $email; ?>">
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
                <td>
                    <input class="submitButton" type="submit" value="Login">
                </td>
            </tr>
        </table>
    </form>
</body>

</html>
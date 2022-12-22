<!DOCTYPE html>
<html>

<head>
    <title>Register User</title>
</head>

<body>
    <?php
    require("repositories/library-repository.php");

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

        insertUser($name, $email, $password, $street, $zip, $state);
    }
    ?>

    <script>
        function validateForm() {
            // TODO: do validation
        }
    </script>

    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" onsubmit="return validateForm()">
        <table>
            <tr>
                <td>Name:</td>
                <td>
                    <input name="name" type="text" value="<?php echo $name; ?>">
                </td>
            </tr>
            <tr>
                <td>Email:</td>
                <td>
                    <input name="email" type="email" value="<?php echo $email; ?>">
                </td>
            </tr>
            <tr>
                <td>Street:</td>
                <td>
                    <input name="street" type="text" value="<?php echo $email; ?>">
                </td>
            </tr>
            <tr>
                <td>Zip:</td>
                <td>
                    <input name="zip" type="number" value="<?php echo $zip; ?>">
                </td>
            </tr>
            <tr>
                <td>State:</td>
                <td>
                    <input name="state" type="text" value="<?php echo $state; ?>">
                </td>
            </tr>
            <tr>
                <td>Password:</td>
                <td>
                    <input name="password" type="password" value="<?php echo $password; ?>">
                </td>
            </tr>
            <tr>
                <td>Confirm Password:</td>
                <td>
                    <input name="confirmPassword" type="password" value="<?php echo $confirmPassword; ?>">
                </td>
            </tr>
            <tr>
                <td>
                    <input type="submit">
                </td>
            </tr>
        </table>
    </form>
</body>

</html>
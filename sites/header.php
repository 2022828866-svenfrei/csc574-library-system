<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" type="text/css" href="css/mystyle.css"> <!--link to mystyle.css -->
    <style>
        td:hover {
            background-color: white;
        }

        img {
            display: block;
            margin-left: auto;
            margin-right: auto;
        }
    </style>
</head>

<body>
    <?php
    require("repositories/cookie-repository.php");
    require("repositories/library-repository.php");

    $isUserLoggedIn = getCurrentUser() != null;

    if ($_SERVER["REQUEST_METHOD"] == "GET") {
        try {
            $admin = getAdminUser(getCurrentUser());
        } catch (Exception $ex) {
            $errorMessage = "Issue fetching user data!";
        }
    }
    ?>
    <img src="images/kkslheader.png" alt="logoheader" width="900" height="90">
    <table style="width:80%; font-color:white;" border=0 bgcolor=red align="center">

        <tr>
            <td align="center"><a target="_top" href="index.php"><b>Home</b></a></td>
            <?php
            // display different header items based on the user login status
            if ($isUserLoggedIn) {
                if ($admin) {
                    ?>
                    <td align="center"><a target="content" href="borrower.php"><b>Borrower</b></a></td>
                    <td align="center"><a target="content" href="book.php"><b>Book</b></a></td>
                    <td align="center"><a target="content" href="personal.php"><b>Admin</b></a></td>
                    <?php
                } else {
                    ?>
                    <td align="center"><a target="content" href="about.php"><b>About</b></a></td>
                    <td align="center"><a target="content" href="facilities.php"><b>Facilities</b></a></td>
                    <td align="center"><a target="content" href="personal.php"><b>Personal</b></a></td>
                    <?php
                }
                ?>
                <td align="center"><a href="logout.php"><b>Logout</b></a></td>
            <?php
            } else {
                ?>
                <td align="center"><a target="content" href="login.php"><b>Login</b></a></td>
                <td align="center"><a target="content" href="register.php"><b>Register</b></a></td>
                <?php
            }
            ?>
        </tr>
    </table>
</body>
</html>
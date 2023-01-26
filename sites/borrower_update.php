<!DOCTYPE html>
<html>

<head>
    <title>Update Borrower</title>
    <link rel="stylesheet" type="text/css" href="css/mystyle.css"> <!--link to mystyle.css -->
    <link rel="stylesheet" type="text/css" href="css/userstyle.css"> <!--link to userstyle.css -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN"
        crossorigin="anonymous"></script>

        <style>
            fieldset {
                margin-inline-start: 2px;
                margin-inline-end: 2px;
                padding-block-start: 0.35em;
                padding-inline-start: 0.75em;
                padding-inline-end: 0.75em;
                padding-block-end: 0.625em;
                min-inline-size: min-content; 
                border: 2px solid black;
            }
        </style>
</head>

<body>
    <script>
        function reloadAsGet(id, msg) {
            var loc = window.location;
            window.location = loc.protocol + '//' + loc.host + loc.pathname + '?ID=' + id;
            alert(msg);
        }
    </script>

    <?php
    require("repositories/library-repository.php");
    require("repositories/cookie-repository.php");

    $errorMessage = "";

    $status = "";
    $id = "";

    if ($_SERVER["REQUEST_METHOD"] == "GET") {
        $id = $_GET['ID'];

        try {
            $receipt = getReceipt($id);
        } catch (Exception $ex) {
            $errorMessage += "<br>Issue fetching borrowing data!";
        }
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        try {
            $id = $_POST["id"];
            $status = $_POST["status"];
            // Insert image content into database 
            $updateSuccessful = updateBorrowStatus($id, $status);

            if ($updateSuccessful) {
                echo "<script>reloadAsGet(" . $id . ", 'Borrow status successfully updated');</script>"; // reload page with js command with GET request
            } else {
                $errorMessage = "The update was unsuccesful, please try again.";
            }
        } catch (Exception $ex) {
            $errorMessage = $ex->getMessage();
        }
        $receipt = getReceipt($_POST["ID"]);
    }
    ?>

    <table style="width: 100%; margin-left: 0;">
        <thead>
            <tr>
                <th width="50%" style="text-align: left; padding: 10px;"><h3>Update</h3></th>
                <th width="50%" style="text-align: right; padding: 10px;"><h3>Borrower</h3></th>
            </tr>
        </thead>
    </table>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <fieldset>
            <table style="width: 100%; margin: 0;">
                <tr>
                    <td colspan="2">
                        <p class="errorMessage">
                            <?php echo $errorMessage; ?>
                        </p>
                    </td>
                </tr>
                <tr>
                    <td width="20%">Book Name:</td>
                    <td>
                        <?php echo $receipt["Name"]; ?>
                        <input id="id" name="id" type="hidden" value="<?php echo $receipt["ID"]; ?>">
                    </td>
                </tr>
                <tr>
                    <td width="20%">Name:</td>
                    <td><?php echo $receipt["FullName"]; ?></td>
                </tr>
                <tr>
                    <td width="20%">From Date:</td>
                    <td><?php echo strftime('%Y-%m-%d', strtotime($receipt["FromDate"])); ?></td>
                </tr>
                <tr>
                    <td width="20%">To Date:</td>
                    <td><?php echo strftime('%Y-%m-%d', strtotime($receipt["ToDate"])); ?></td>
                </tr>
                <tr>
                    <td width="20%">Bill (RM):</td>
                    <td><?php echo $receipt["Penalty"]; ?></td>
                </tr>
                <tr>
                    <td width="20%">Status:</td>
                    <td>
                        <select id="statusInput" name="status" value="<?php echo $receipt["Status"]; ?>">
                            <option value="R" <?php if($receipt["Status"] == "R") echo 'selected="selected"'; ?>>Returned</option>
                            <option value="B" <?php if($receipt["Status"] == "B") echo 'selected="selected"'; ?>>Borrowed</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td><input hidden name="ID" value="<?php echo $id; ?>"></td>
                </tr>
            </table>
        </fieldset>
        <br>
        <table style="width: 100%; margin: 0;">
            <tr>
                <td colspan="2" align="right">
                    <button type="submit" class="submitButton">Save</button>
                    <button type="button" onclick="window.location='borrower.php'">Back</button>
                </td>
            </tr>
        </table>        
    </form>
</body>

</html>
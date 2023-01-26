<?php

function getDatabaseConnection()
{
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "library";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);
    // Check connection
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    return $conn;
}

function getUserByEmail($email)
{
    $conn = getDatabaseConnection();
    $sql = "SELECT * FROM user WHERE Email = '" . $email . "';";
    $result = $conn->query($sql);

    $conn->close();

    return $result->fetch_assoc();
}

function insertUser(
    string $name,
    string $email,
    string $uitmId,
    string $password,
    string $street,
    string $zip,
    string $state
)
{
    $conn = getDatabaseConnection();
    $sql = "INSERT INTO user (FullName, Email, UitmID, Password, Street, Zip, State, IsAdmin) " .
        "VALUES ('$name', '$email', $uitmId, '$password', '$street', $zip, '$state', '0')";
    $insertSuccessful = $conn->query($sql);

    $conn->close();

    return $insertSuccessful;
}

function updateUser(
    string $name,
    string $email,
    string $uitmId,
    string $password,
    string $street,
    string $zip,
    string $state
)
{
    $conn = getDatabaseConnection();
    $sql = "UPDATE user SET " .
        "FullName = '$name', " .
        "Email = '$email', " .
        "UitmId = '$uitmId', " .
        "Password = '$password', " .
        "Street = '$street', " .
        "Zip = '$zip', " .
        "State = '$state'" .
        "WHERE Email='$email';";
    $updateSuccessful = $conn->query($sql);

    $conn->close();

    return $updateSuccessful;
}

function getBookingsByUserEmail($email)
{
    $conn = getDatabaseConnection();
    $sql = "SELECT book.Name, borrow.ToDate, borrow.FromDate, borrow.IsBillSettled " .
        "FROM borrow borrow JOIN user user ON borrow.UserFK = user.ID JOIN book book ON borrow.BookFK = book.ID " .
        "WHERE Email = '" . $email . "';";
    $result = $conn->query($sql);

    $conn->close();

    return $result;
}

function getAllBooked()
{
    $conn = getDatabaseConnection();
    $sql = "SELECT borrow.ID, book.Name, user.FullName, borrow.ToDate, borrow.FromDate, borrow.IsBillSettled, CASE WHEN borrow.Status='B' THEN 'Borrowed' WHEN borrow.Status='R' THEN 'Returned' END AS Status " .
        "FROM borrow borrow JOIN user user ON borrow.UserFK = user.ID JOIN book book ON borrow.BookFK = book.ID " .
        "WHERE 1=1";
    $result = $conn->query($sql);

    $conn->close();

    return $result;
}

function getAdminUser($email)
{
    $conn = getDatabaseConnection();
    $sql = "SELECT * FROM user " .
            "WHERE Email = '" . $email . "'".
            " AND IsAdmin = 1;";
    $result = $conn->query($sql);

    $conn->close();

    return $result->fetch_assoc();
}

function getAllBook() {
    $conn = getDatabaseConnection();
    $sql = "SELECT ID, Name, Category, ISBNNumber " .
            "FROM book ";
    $result = $conn->query($sql);

    $conn->close();

    return $result;
}

function insertBook(
    string $name,
    string $category,
    string $desc,
    string $date,
    string $place,
    string $author,
    string $isbn,
    string $image,
    int $price
) {
    $conn = getDatabaseConnection();
    $sql = "INSERT INTO book (Name, Category, PublishDate, Author, Description, ISBNNumber, Image, PublishPlace, Price) " .
        "VALUES ('$name', '$category', '$date', '$author', '$desc', '$isbn', '$image', '$place', $price)";
    $insertSuccessful = $conn->query($sql);

    $conn->close();

    return $insertSuccessful;
}

function updateBook(
    int $id,
    string $name,
    string $category,
    string $desc,
    string $date,
    string $place,
    string $author,
    string $isbn,
    string $image,
    int $price
) {
    $conn = getDatabaseConnection();
    $sql = "UPDATE book SET " .
        "Name = '$name', " .
        "Category = '$category', " .
        "PublishDate = '$date', " .
        "Author = '$author', " .
        "Description = '$desc', " .
        "Image = '$image'," .
        "PublishPlace = '$place'," .
        "Price = '$price'" .
        "ISBNNumber = '$isbn'" .
        "WHERE ID = $id; ";
    $updateSuccessful = $conn->query($sql);

    $conn->close();

    return $updateSuccessful;
}

function deleteBook(int $id) {
    $conn = getDatabaseConnection();
    $sql = "DELETE FROM book " .
        "WHERE ID = '$id';";
    $updateSuccessful = $conn->query($sql);

    $conn->close();

    return $updateSuccessful;
}

function getBookDetail($ID) {
    $conn = getDatabaseConnection();
    $sql = "SELECT ID, Name, Category, PublishDate, Author, Description, ISBNNumber, Image, PublishPlace, Price FROM book WHERE ID = '" . $ID . "'";
    $result = $conn->query($sql);

    $conn->close();

    return $result->fetch_assoc();
}

function checkReceipt(
    int $id
) {
    $conn = getDatabaseConnection();
    $sql = "SELECT borrow.Status " .
        "FROM receipt receipt " .
        "INNER JOIN borrow borrow on receipt.BorrowFK = borrow.ID " .
        "WHERE receipt.BorrowFK = $id;";
    $checkReceipt = $conn->query($sql);
    $conn->close();

    return $checkReceipt->fetch_assoc();
}

function insertReceipt(
    int $id,
    int $day,
    float $price
) {
    $conn = getDatabaseConnection();
    $sql = "INSERT INTO receipt (BorrowFK, LateDay, Penalty) " .
        "VALUES ($id, $day, $price)";
    $insertSuccessful = $conn->query($sql);

    $conn->close();

    return $insertSuccessful;
}

function updateReceipt(
    int $id,
    int $day,
    float $price
) {
    $conn = getDatabaseConnection();
    $sql = "UPDATE receipt SET " .
        "LateDay = $day, " .
        "Penalty = $price " .
        "WHERE BorrowFK = $id; ";
    $updateSuccessful = $conn->query($sql);

    $conn->close();

    return $updateSuccessful;
}

function getReceipt(
    int $id
) {
    $conn = getDatabaseConnection();
    $sql = "SELECT book.Name, receipt.LateDay, receipt.Penalty" .
        "FROM receipt receipt " .
        "INNER JOIN borrow borrow on receipt.BorrowFK = borrow.ID " .
        "INNER JOIN book book on borrow.BookFK = book.ID " .
        "WHERE receipt.BorrowFK = $id;";
    $getReceipt = $conn->query($sql);
    $conn->close();

    return $getReceipt;
}
?>
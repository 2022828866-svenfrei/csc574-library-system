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
    $sql = "SELECT book.ID, book.Name, user.FullName, borrow.ToDate, borrow.FromDate, CASE WHEN borrow.IsBillSettled='1' THEN 'PAID' WHEN borrow.IsBillSettled='0' THEN 'N/A' END AS IsBillSettled, CASE WHEN borrow.Status='B' THEN 'Borrowed' WHEN borrow.Status='R' THEN 'Returned' END AS Status " .
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
        "WHERE ISBNNumber = '$isbn'; ";
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
?>
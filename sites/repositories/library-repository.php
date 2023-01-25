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




?>
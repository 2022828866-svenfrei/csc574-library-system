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

function insertUser(
    string $name,
    string $email,
    string $password,
    string $street,
    string $zip,
    string $state
)
{
    $conn = getDatabaseConnection();
    $sql = "INSERT INTO user (FullName, Email, Password, Street, Zip, State, IsAdmin) " .
        "VALUES ('$name', '$email', '$password', '$street', $zip, '$state', '0')";
    $insertSuccessful = $conn->query($sql);

    $conn->close();

    return $insertSuccessful;
}

function getUserByEmail($email)
{
    $conn = getDatabaseConnection();
    $sql = "SELECT * FROM user WHERE Email = '" . $email . "';";
    $result = $conn->query($sql);

    $conn->close();

    return $result->fetch_assoc();
}

?>
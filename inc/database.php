<?php

require_once "errorMessage.php";

function createDB()
{
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "auth";

    try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        echo "Connected successfully";
        return $conn;
    } catch (PDOException $e) {
        echo errorMessage("connection failed" . $e->getMessage());
    }
}

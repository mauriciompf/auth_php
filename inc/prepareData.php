<?php

require_once "database.php";
require_once "errorMessage.php";
include "createTable.php";

function prepareData($conn, $username, $email, $password)
{
    try {
        global $tableName;
        $stmt = $conn->prepare("INSERT INTO $tableName (username, email, password)
        VALUES (:username, :email, :password)");

        $stmt->bindParam(":username", $username);
        $stmt->bindParam(":email", $email);
        $stmt->bindParam(":password", $password);
        $stmt->execute();

        // echo "Inserted data successfully. <br>";

        $conn = null;
    } catch (PDOException $e) {
        echo errorMessage($e->getMessage());
    }
}

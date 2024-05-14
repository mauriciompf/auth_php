<?php

require_once "database.php";
require_once "errorMessage.php";
$tableName = "registration";


function createTable()
{
    try {
        $conn = createDB();

        global $tableName;

        $sql = "CREATE TABLE IF NOT EXISTS $tableName (
            id INT AUTO_INCREMENT PRIMARY KEY,
            username VARCHAR(50) NOT NULL,
            email VARCHAR(255) NOT NULL,
            password CHAR(55) NOT NULL,
            reg_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
        )";

        $conn->exec($sql);
        echo "Table $tableName created successfully. <br>";

        if (!$conn->query($sql)) {
            throw new PDOException("failed in create $tableName table. <br>");
        }

        $conn = null;
    } catch (PDOException $e) {
        echo errorMessage($e->getMessage());
    }
}

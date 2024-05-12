<?php

require_once "database.php";
require_once "errorMessage.php";

function createTable()
{
    try {
        $conn = createDB();

        $sql = "CREATE TABLE registration (
            id INT AUTO_INCREMENT PRIMARY KEY,
            username VARCHAR(50) NOT NULL,
            email VARCHAR(255) NOT NULL,
            password CHAR(55) NOT NULL,
            reg_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
        )";

        $conn->exec($sql);
        echo "Table created successfully <br>";
    } catch (PDOException $e) {
        echo errorMessage($e->getMessage());
    }
}

<?php

require_once "database.php";

function fetchData()
{
    try {
        $sql = "SELECT username, email, reg_date FROM registration";

        $conn = createDB();

        $stmt = $conn->prepare($sql);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        echo "Error:" . $e->getMessage();
    }
}

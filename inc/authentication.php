<?php

// require_once "validateInput.php";
require_once "errorMessage.php";
require_once "database.php";

function processLogin(): void
{
    session_start();
    try {
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            // $username = validateInput("username", $_POST["username"]);
            // $password = validateInput("password", $_POST["password"]);

            $username = $_POST["username"];
            $password = $_POST["password"];

            $conn = createDB();
            $sql = "SELECT id, username, password
            FROM registration
            WHERE username = ?";
            $stmt = $conn->prepare($sql);
            $stmt->execute([$username]);
            $user = $stmt->fetch();

            if (!$user) {
                throw new Exception("Invalid username. <br>");
            }

            if (!password_verify($password, $user["password"])) {
                throw new Exception("Invalid password. <br>");
            }

            $_SESSION["id"] = $user["id"];
            $_SESSION["username"] = $user["username"];
            header("Location: ./mainPage.php");
            exit;
        }
    } catch (Exception $e) {
        echo errorMessage($e->getMessage() .  " <br>");
    }
}

processLogin();

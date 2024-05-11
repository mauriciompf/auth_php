<?php

require_once "validateEmail.php";
require_once "validateInput.php";
require_once "errorMessage.php";

function processRegister(): void
{
    try {
        if ($_SERVER["REQUEST_METHOD"] === "POST") {

            $username = validateInput("username", $_POST["username"]);
            $email = validateInput("email", validateEmail($_POST["email"]));
            $password = validateInput("password", $_POST["password"]);
            $password2 = validateInput("password 2", $_POST["password2"]);

            if (!isset($_POST["agree"]) || $_POST["agree"] !== "yes") {
                throw new Exception("You must agree to the terms and conditions. <br>");
            }

            // Check if password match
            if ($password !== $password2) {
                throw new Exception("passwords do not match. <br>");
            }

            // Hash passwords
            $password_hashed = password_hash($password, PASSWORD_BCRYPT);
        }
    } catch (Exception $e) {
        echo errorMessage($e->getMessage()) . "<br>";
    }
}

processRegister();

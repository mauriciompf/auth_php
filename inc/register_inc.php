<?php

function errorMessage($error): string
{
    return "<strong style='color: red; font-size: 1.5rem; text-style: italic'>Error: {$error}</strong>";
}

function processFormData(): void
{
    try {
        if ($_SERVER["REQUEST_METHOD"] === "POST") {

            $username = isset($_POST["username"]) && trim($_POST["username"]);
            $email = isset($_POST["email"]) && trim($_POST["email"]);
            $password = isset($_POST["password"]) && trim($_POST["password"]);
            $password2 = isset($_POST["password2"]) && trim($_POST["password2"]);
            $agree = $_POST["agree"];

            // Sanitize input
            $username = htmlentities($username, ENT_QUOTES, "UTF-8");
            $email = htmlentities($email, ENT_QUOTES, "UTF-8");
            $password = htmlentities($password, ENT_QUOTES, "UTF-8");
            $password2 = htmlentities($password2, ENT_QUOTES, "UTF-8");

            // Validate email
            if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
                throw new Exception("email invalid. <br>");
            }

            // Sanitize email
            $email_sanitize = filter_var($email, FILTER_SANITIZE_EMAIL);

            // Check if username is empty
            if (empty($username)) {
                throw new Exception("username cannot be empty. <br>");
            }

            if (!isset($_POST["agree"]) || $_POST["agree"] !== "yes") {
                throw new Exception("You must agree to the terms and conditions. <br>");
            }

            // Check if password match
            if ($password !== $password2) {
                throw new Exception("passwords do not match. <br>");
            } else {
                // Hash passwords
                $password_hashed = password_hash($password, PASSWORD_BCRYPT);
                $password2_hashed = password_hash($password, PASSWORD_BCRYPT);
            }
        } else {
            throw new Exception("request failed. <br>");
        }
    } catch (Exception $e) {
        echo errorMessage($e->getMessage()) . "<br>";
    }
}

processFormData();

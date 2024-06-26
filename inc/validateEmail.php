<?php

require_once "validateInput.php";

function validateEmail($email)
{

    validateInput("email", $email);

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        throw new Exception("email invalid. <br>");
    }

    // Sanitize email
    return filter_var($email, FILTER_SANITIZE_EMAIL);
}

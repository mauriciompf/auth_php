<?php

function validateInput(string $field, string $input)
{

    $field = ucfirst($field);

    // Check if is empty
    if (empty($input)) {
        throw new Exception($field . " cannot be empty. <br>");
    }

    inputLenLimit($input, $field);

    if ($input === $_POST["username"]) {
        $exp = "/^(?![_.])(?!.*[_.]{2})[a-zA-ZÀ-ÿ0-9._]+(?<![_.])$/";
        if (!preg_match($exp, $input)) {
            throw new Exception("$field input invalid. <br>");
        }

        if (strlen($input) < 4) {
            throw new Exception($field . " should be at least 4 caracteres. <br>");
        }
    }

    if ($input === $_POST["password"]) {
        // - Contain at least one special character (!@#$%^&*()-_=+{};:,<.>)
        // - Contain at least one uppercase letter
        // - Contain at least one digit
        // - Contain only alphanumeric characters and the specified special characters
        $exp = "/^(?=.*[a-zA-Z0-9])(?=.*[!@#$%^&*()-_=+{};:,<.>])(?=.*[A-Z])(?=.*[0-9])[a-zA-Z0-9!@#$%^&*()-_=+{};:,<.>]+$/";

        if (!preg_match($exp, $input)) {
            throw new Exception($field . " input invalid. <br>");
        }

        if (strlen($input) < 6) {
            throw new Exception($field . " should be at least 6 caracteres. <br>");
        }

        return $input;
    } else {
        // Sanitize input
        return trim(htmlentities($input, ENT_QUOTES, "UTF-8"));
    }
}


function inputLenLimit($input, $field)
{

    $field = ucfirst($field);
    $usernameLenLimit = 50;
    $emailLenLimit = 255;
    $passwordLenLimit = 55;

    $limit = 0;

    switch ($input) {
        case $_POST["username"]:
            $limit = $usernameLenLimit;
            break;
        case $_POST["email"]:
            $limit = $emailLenLimit;
            break;
        case $_POST["password"]:
            $limit = $passwordLenLimit;
            break;
        default:
            throw new Exception("invalid input. <br>");
            break;
    }

    if (strlen($input) >= $limit) {
        throw new Exception(ucfirst($field) . " cannot be more than $limit caracteres.<br>");
    }
}

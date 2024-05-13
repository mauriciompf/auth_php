<?php

function validateInput(string $field, string $input)
{
    // Check if is empty
    if (empty($input)) {
        throw new Exception(ucfirst($field) . " cannot be empty. <br>");
    }

    inputLenLimit($input, $field);

    // Sanitize input
    return htmlentities($input, ENT_QUOTES, "UTF-8");
}


function inputLenLimit($input, $field)
{
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

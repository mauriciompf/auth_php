<?php

function validateInput(string $field, string $input)
{
    // Check if is empty
    if (empty($input)) {
        throw new Exception(ucfirst($field) . " cannot be empty. <br>");
    }

    // Sanitize input
    return htmlentities($input, ENT_QUOTES, "UTF-8");
}

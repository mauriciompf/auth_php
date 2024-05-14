<?php

function sendEmail($to, $username)
{
    $subject = "Email confirmation";
    $message = "Hello, $username, can you confirm your registration?";
    $headers = "From: mauriciofarias035@gmail.com\r\nReply-To: mauriciofarias035@gmail.com";
    $mail_sent = mail($to, $subject, $message, $headers);

    echo $mail_sent ? "Email sent" : "Email failed";
}

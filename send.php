<?php
// Contact form handler for shared hosting (DirectAdmin). Sends to the address below.
$to = 'resources.divscope@outlook.com';

if ($_SERVER['REQUEST_METHOD'] !== 'POST' || !empty($_POST['website'])) {
    header('Location: contact.html');
    exit;
}

function clean($value)
{
    return trim(str_replace(["\r", "\n"], ' ', strip_tags($value ?? '')));
}

$name = clean($_POST['name'] ?? '');
$company = clean($_POST['company'] ?? '');
$email = clean($_POST['email'] ?? '');
$phone = clean($_POST['phone'] ?? '');
$topic = clean($_POST['topic'] ?? '');
$msg = trim(strip_tags($_POST['message'] ?? ''));

if ($name === '' || $msg === '' || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
    header('Location: contact.html?error=1');
    exit;
}

$host = preg_replace('/^www\./', '', $_SERVER['HTTP_HOST'] ?? 'localhost');
$headers = "From: Website <noreply@$host>\r\n"
    . "Reply-To: $name <$email>\r\n"
    . "Content-Type: text/plain; charset=UTF-8";
$body = "Name: $name\n"
    . "Company: $company\n"
    . "Email: $email\n"
    . "Phone: $phone\n"
    . "Topic: $topic\n\n"
    . "$msg\n";

mail($to, "Website enquiry: $topic", $body, $headers);
header('Location: contact.html?sent=1#enq');
exit;

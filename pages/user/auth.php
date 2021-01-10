<?php
$error = false;

if(isAuthUser()) {
    header('Location: ' . url('profile'), true, 301);
}

$email = $_POST['email'] ?? '';
$password = $_POST['password'] ?? '';


if (loginUser($email, $password)) {
    header('Location: ' . url('profile'), true, 301);
    exit;
} elseif (isset($_POST['email'])) {
    $error = 'Incorrect email or password';
}

printTemplateHtml('user/auth', [
    'error' => $error,
]);

<?php

use App\Auth;

$error = false;

if(Auth::isAuth()) {
    redirect(url('profile'));
}

$email = $_POST['email'] ?? '';
$password = $_POST['password'] ?? '';

if (!empty($_POST) && Auth::login($email, $password)) {
    redirect(url('profile'));
} elseif (isset($_POST['email'])) {
    $error = 'Incorrect email or password';
}

printTemplateHtml('user/auth', [
    'error' => $error,
]);

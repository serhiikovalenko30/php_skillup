<?php

if (!empty($_POST)) {

    $name = $_POST['contact_name'] ?? '';
    $email = $_POST['contact_email'] ?? '';
    $phone = $_POST['contact_phone'] ?? '';
    $massage = $_POST['contact_massage'] ?? '';

    $_SESSION['mail_form'] = [
        'status' => 0,
        'feedback_text' => '',
        'name' => ['status' => checkName($name), 'value' => $name],
        'email' => ['status' => checkEmail($email), 'value' => $email],
        'phone' => ['status' => checkPhone($phone), 'value' => $phone],
        'massage' => ['status' => checkMassage($massage), 'value' => $massage],
    ];

    $path = $_SERVER['DOCUMENT_ROOT'].'/logs/';
    $fileName = 'feedback_form.log';

    if(checkName($name) && checkEmail($email) && checkPhone($phone) && checkMassage($massage)) {
        create_dir($path);
        write_log($path, $fileName, $name, $email, $phone, $massage);
        $_SESSION['mail_form']['status'] = 1;
        $_SESSION['mail_form']['feedback_text'] = 'Thanks for your feedback';
    } else {
        $_SESSION['mail_form']['feedback_text'] = 'Please try once';
    }
}

header("Location: " . url('contacts'), true, 301);
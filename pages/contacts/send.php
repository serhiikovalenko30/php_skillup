<?php

if (!empty($_POST)) {

    $_SESSION['mail_form'] = [
        'status' => 0,
        'feedback_text' => '',
    ];

    $name = $_POST['contact_name'] ?? '';
    $email = $_POST['contact_email'] ?? '';
    $phone = $_POST['contact_phone'] ?? '';
    $massage = $_POST['contact_massage'] ?? '';

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

header("Location: " . url('contacts'));



function create_dir($dirName) {
    if(!is_dir($dirName)) {
        if(mkdir(@$dirName, 0755, true));
    }
}

function write_log($path, $fileName, $name, $email, $phone, $massage) {
    if($handle = fopen($path . $fileName, 'a')) {
        fwrite($handle, time() . '|' . $name . '|' . $email . '|' . $phone . '|' . $massage . PHP_EOL);
        fclose($handle);
    }
}

function checkName($name) {
    if (isset($_POST['contact_name'])) {
        if (preg_match("/[0-9а-яa-z_]/i", $name)) {
            return true;
        }
        return false;
    }
    return false;
}

function checkEmail($email) {
    if (isset($_POST['contact_email'])) {
        if(preg_match('|^[-0-9а-яa-z_\.]+@[-0-9а-яa-z^\.]+\.[a-zа-я]{2,6}$|i',$email)) {
            return true;
        }
        return false;
    }
    return false;
}

function checkPhone($phone) {
    if (isset($_POST['contact_phone'])) {
        if (preg_match('/^\+380(50|96|98|63|93)\d{7}$/', $phone)) {
            return true;
        }
        return false;
    }
    return false;
}

function checkMassage($massage) {
    if (isset($_POST['contact_massage'])) {
        if (preg_match("/[0-9а-яa-z_]/i", $massage)) {
            return true;
        }
        return false;
    }
    return false;
}


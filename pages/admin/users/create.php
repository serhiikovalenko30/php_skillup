<?php

use App\Entity\User;

if (!empty($_POST)) {
    $name = trim($_POST['login'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $is_admin = isset($_POST['is_admin']) && $_POST['is_admin'] == 1 ? 1 : 0;
    $password = trim($_POST['password'] ?? '');

    if ($name != '' && $email != '' && $password != '') {
        $user = new User();
        $user->login = $name;
        $user->email = $email;
        $user->password = $password;
        $user->is_admin = $is_admin;

        if ($user->add()) {
            redirect(url('admin_entity_list', ['entity' => 'users']));
        } else {
            redirect(url('admin_users_add'), 307);
        }
    }
}

redirect(url('admin_entity_list', ['entity' => 'users']));

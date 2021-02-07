<?php

use App\Entity\User;

print_r($_POST);

if(!empty($_POST)) {
    $id = intval($_POST['id'] ?? 0);
    $user = new User($id);
    if ($user->id > 0) {
        $user->login = trim($_POST['login'] ?? '');
        $user->email = trim($_POST['email'] ?? '');
        $user->is_admin = isset($_POST['is_admin']) && $_POST['is_admin'] == 1 ? 1 : $user->is_admin;
        $user->password = trim($_POST['password'] ?? '');

        if ($user->update()) {
            redirect(url('admin_entity_list', ['entity' => 'users']));
        } else {
            redirect(url('admin_entity_edit', ['entity' => 'users', 'id' => $user->id]), 307);
        }

    }

}

redirect(url('admin_entity_list', ['entity' => 'users']));
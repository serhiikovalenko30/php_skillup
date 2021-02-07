<?php

use App\Entity\User;

$user = new User($route->param['id'] ?? 0);
$user->delete();

redirect(url('admin_entity_list', ['entity' => 'users']));
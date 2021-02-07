<?php

use App\Entity\Category;

$category = new Category($route->param['id'] ?? 0);
$category->delete();

redirect(url('admin_entity_list', ['entity' => 'categories']));
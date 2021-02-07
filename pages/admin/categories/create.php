<?php

use App\Entity\Category;

if (!empty($_POST)) {
    $title = trim($_POST['title'] ?? '');
    $description = trim($_POST['description'] ?? '');
    $parent_id = intval($_POST['parent_id'] ?? 0);


    if ($title != '') {
        $category = new Category();
        $category->title = $title;
        $category->description = $description;
        $category->parent_id = $parent_id;

        if ($category->add()) {
            redirect(url('admin_entity_list', ['entity' => 'categories']));
        } else {
            redirect(url('admin_entity_add', ['entity' => 'categories']), 307);

        }
    }
}

redirect(url('admin_entity_list', ['entity' => 'categories']));

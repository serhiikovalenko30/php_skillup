<?php

use App\Entity\Category;

if(!empty($_POST)) {
    $category = new Category($_POST['id'] ?? 0);

    if ($category->id > 0) {
        $category->title = trim($_POST['title'] ?? '');
        $category->description = trim($_POST['description'] ?? '');
        $category->parent_id = intval($_POST['parent_id'] ?? $category->parent_id);
    }


    if($category->update()) {
        redirect(url('admin_entity_list', ['entity' => 'categories']));
    } else {
        redirect(url('admin_entity_edit', ['entity' => 'categories', 'id' => $category->id]), 307);
    }
}

redirect(url('admin_entity_list', ['entity' => 'categories']));

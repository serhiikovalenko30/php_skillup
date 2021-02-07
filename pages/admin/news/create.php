<?php

use App\Entity\News;
use App\Entity\User;

if (!empty($_POST)) {
    $title = trim($_POST['title'] ?? '');
    $content = trim($_POST['content'] ?? '');
    $user = new User(intval($_POST['user_id'] ?? 0));
    $arCategories = $_POST['categories'] ?? 0;


    if ($title != '') {
        $news = new News();
        $news->title = $title;
        $news->content = $content;
        $news->user = $user;
        if ($news->add($arCategories)) {
            redirect(url('admin_entity_list', ['entity' => 'news']));
        } else {
            redirect(url('admin_entity_add', ['entity' => 'news']), 307);

        }
    }
}

redirect(url('admin_entity_list', ['entity' => 'news']));

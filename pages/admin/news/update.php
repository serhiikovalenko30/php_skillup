<?php

use App\Entity\News;
use App\Entity\User;

if(!empty($_POST)) {
    $news = new News($_POST['id'] ?? 0);

    if ($news->id > 0) {
        $title = trim($_POST['title'] ?? '');
        $content = trim($_POST['content'] ?? '');
        $user = new User(intval($_POST['user_id'] ?? 0));
        $arCategories = $_POST['categories'] ?? 0;

        if ($title != '') {
            $news->title = $title;
            $news->content = $content;
            $news->user = $user;

            if($news->update($arCategories)) {
                redirect(url('admin_entity_list', ['entity' => 'news']));
            } else {
                redirect(url('admin_entity_edit', ['entity' => 'news', 'id' => $news->id]), 307);

            }
        }
    }


}

redirect(url('admin_entity_list', ['entity' => 'news']));

<?php

use App\Entity\News;

$news = new News($route->param['id'] ?? 0);
$news->delete();

redirect(url('admin_entity_list', ['entity' => 'news']));
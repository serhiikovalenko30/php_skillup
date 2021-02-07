<?php

use App\Entity\News;
use App\Entity\Category;

$arData = [
    'news' => new News($route->param['id'] ?? 0),
    'categories_list' => Category::getListStructured(),
];

printTemplateHtml('admin/news/edit', $arData);
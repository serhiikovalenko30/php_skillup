<?php

use App\Entity\Category;
use App\Entity\News;

$arNews = News::getList();
$arCategories = Category::getListStructured();

printTemplateHtml('index/index', [
    'news' => $arNews,
    'categories' => $arCategories,
]);




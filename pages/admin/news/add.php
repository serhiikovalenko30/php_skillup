<?php

use App\Entity\News;
use App\Entity\Category;

$arData = [];

if (!empty($_POST)) {
    $arData = $_POST;
}

$arData['categories_list'] = Category::getListStructured();
$arData['news_list'] = News::getList();

printTemplateHtml('admin/news/add', $arData);
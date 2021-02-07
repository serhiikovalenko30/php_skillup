<?php

use App\Entity\News;

$arNews = News::getList();

printTemplateHtml('news/index', [
    'news' => $arNews,
]);
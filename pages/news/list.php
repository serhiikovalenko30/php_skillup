<?php
$arNews = getLastNews(10);
printTemplateHtml('news/index', [
    'news' => $arNews,
]);
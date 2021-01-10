<?php
$arNews = getLastNews(7);
$arPhotoNews = getPhotoNews();
printTemplateHtml('index/index', [
    'news' => $arNews,
    'photo_news' => $arPhotoNews,
]);




<?php
use App\Entity\News;

$news = News::getList(1);

printTemplateHtml('news/detail', $news);
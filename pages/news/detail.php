<?php
$news = getLastNews(1);
printTemplateHtml('news/detail', $news);
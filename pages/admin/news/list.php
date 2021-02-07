<?php

use App\Entity\News;

$arNews =  News::getList();

printTemplateHtml('admin/news/list', $arNews);
<?php
if(!isset($arData) || empty($arData))
    return;
?>
<h3>Top News</h3>
<?php printTemplateHtml('news/list', $arData); ?>
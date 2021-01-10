<h1>NEWS</h1>
<div class="row mb-3">
    <div class="col">
        <img src="https://fakeimg.pl/1000x100/ff0000%2C128/000%2C255/?text=banner" alt="banner" class="img-fluid w-100">
    </div>
</div>
<div class="row mb-3">
    <div class="col-8">
        <?php if(isset($arData['news']) && !empty($arData['news'])) { ?>
            <h3>Last News</h3>
            <?php printTemplateHtml('news/list', $arData['news']); ?>
        <?php } else { ?>
            <p>No news</p>
        <?php } ?>
    </div>
    <div class="col-4">
        <?php includeBlock('right_news'); ?>
    </div>
</div>
<?php
if(isset($arData['photo_news']) && !empty($arData['photo_news'])) {
    printTemplateHtml('news/index_photo_news', $arData['photo_news']);
}
?>


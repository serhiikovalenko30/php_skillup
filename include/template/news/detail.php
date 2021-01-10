<h1>NEWS</h1>
<div class="row mb-3">
    <div class="col-8">

        <?php if(isset($arData) && !empty($arData)) { ?>
            <img src="<?php echo $arData[0]['image']; ?>" alt="<?php echo $arData[0]['title']; ?>" class="float-start me-3">
            <p><?php echo $arData[0]['fulltext']; ?></p>
        <?php } else { ?>
            <p>News removed</p>
        <?php } ?>

    </div>
    <div class="col-4">
        <?php includeBlock('right_news'); ?>
    </div>
</div>
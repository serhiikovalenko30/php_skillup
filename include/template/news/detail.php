<?php
use \App\Entity\News;

?>

<h1>NEWS</h1>
<div class="row mb-3">
    <div class="col-8">

        <?php
        if(isset($arData) && !empty($arData)) {
            foreach ($arData as /** @var \App\Entity\News $item */ $item) { ?>

            <span class="badge bg-warning text-dark"><?php echo $item->date; ?></span>
            <h3><?php echo $item->title; ?></h3>
            <p><?php echo $item->content; ?></p>

        <?php }
        } else { ?>
            <p>News removed</p>
        <?php } ?>

    </div>
<!--    <div class="col-4">-->
<!--        --><?php //includeBlock('right_news'); ?>
<!--    </div>-->
</div>
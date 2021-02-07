<?php
if(!isset($arData) || empty($arData))
    return;
?>
<div class="row mb-3">
    <?php foreach ($arData as /** @var \App\Entity\News $item */ $item) { ?>
        <div class="col">
            <div class="card">
                <a href="<?php ''; ?>">
                    <img src="<?php echo \App\Helpers\EntityImage::getEntityImage('news', $item->img); ?>" class="card-img-top" alt="<?php echo $item->title; ?>">
                </a>
                <div class="card-body">
                    <h5 class="card-title">
                        <span class="badge bg-warning text-dark"><?php echo $item->date; ?></span>
                        <a href="<?php ''; ?>"><?php echo $item->title; ?></a>
                    </h5>
                    <p class="card-text"><?php echo $item->content; ?></p>
                </div>
            </div>
        </div>
    <?php } ?>
</div>

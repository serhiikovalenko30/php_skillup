<?php
if(!isset($arData) || empty($arData))
    return;
?>
<div class="row mb-3">
    <?php foreach ($arData as /** @var \App\Entity\Category $item */ $item) { ?>
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">
                        <a href="<?php ''; ?>"><?php echo $item->title; ?></a>
                    </h5>
                </div>
            </div>
        </div>
    <?php } ?>
</div>

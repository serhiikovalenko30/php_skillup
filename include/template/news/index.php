<h1>NEWS</h1>
<div class="row mb-3">
    <div class="col-8">

        <?php if(isset($arData['news']) && !empty($arData['news'])) { ?>
            <?php printTemplateHtml('news/list', $arData['news']); ?>
        <?php } else { ?>
            <p>No news</p>
        <?php } ?>

        <nav>
            <ul class="pagination pagination-lg">
                <li class="page-item active" aria-current="page">
                    <span class="page-link">1</span>
                </li>
                <li class="page-item"><a class="page-link" href="#">2</a></li>
                <li class="page-item"><a class="page-link" href="#">3</a></li>
            </ul>
        </nav>

    </div>
    <div class="col-4">
        <?php includeBlock('right_news'); ?>
    </div>
</div>
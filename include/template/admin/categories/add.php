<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-12">
                <h1>Добавление категории</h1>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>

<!-- Main content -->
<section class="content">
    <div class="container-fluid">

        <div class="card">
            <!-- form start -->
            <form class="form-horizontal" method="post" action="<?php echo url('admin_entity_create', ['entity' => 'categories']); ?>" enctype="multipart/form-data">
                <div class="card-body">
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Название</label>
                        <div class="col-sm-10">
                            <input type="text" name="title" value="<?php echo $arData['title'] ?? ''; ?>" class="form-control" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Описание</label>
                        <div class="col-sm-10">
                            <input type="text" name="description" value="<?php echo $arData['description'] ?? ''; ?>" class="form-control" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Родитель</label>
                        <div class="col-sm-10">
                            <select name="parent_id" class="form-control">
                                <option value="">Верхний уровень</option>
                                <?php foreach ($arData['categories_all'] as /** @var \App\Entity\Category $category_item */ $category_item) { ?>
                                    <option value="<?php echo $category_item->id; ?>"<?php if(($arData['parent_id'] ?? '') == $category_item->id) { ?> selected="selected" <?php } ?>><?php
                                        for($i = 0; $i <= $category_item->level; $i++) {
                                            echo '&ndash; &ndash; ';
                                        }
                                        echo '[', $category_item->id, '] ', $category_item->title;
                                        ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                    <a href="<?php echo url('admin_entity_list', ['entity' => 'categories']); ?>" class="btn btn-default">Отмена</a>
                    <button type="submit" class="btn btn-primary float-right">Сохранить</button>
                </div>
                <!-- /.card-footer -->
            </form>
        </div>

    </div><!-- /.container-fluid -->
</section>
<!-- /.content -->
<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-12">
                <h1>Редактирование новостей</h1>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>
<?php /** @var \App\Entity\News $news */

use App\Helpers\EntityImage;

$news = $arData['news'];

?>


<!-- Main content -->
<section class="content">
    <div class="container-fluid">

        <?php if($news->id == 0) { ?>
            <div class="alert alert-danger">
                <i class="icon fas fa-ban"></i> Новость не найден!
            </div>
        <?php } else { ?>
            <div class="card">
                <!-- form start -->
                <form class="form-horizontal" method="post" action="<?php echo url('admin_entity_update', ['entity' => 'news']); ?>" enctype="multipart/form-data">
                    <div class="card-body">
                        <?php if(!empty($news->user) && $news->user->id > 0) { ?>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Пользователь</label>
                                <div class="col-sm-10">
                                    <div class="form-control">
                                        <a href="<?php echo url('admin_entity_edit', ['entity' => 'users', 'id' => $news->user->id]); ?>" target="_blank">[<?php echo $news->user->id; ?>]</a> <?php echo $news->user->login; ?>
                                        <input type="hidden" name="user_id" value="<?php echo $news->user->id; ?>">
                                    </div>
                                </div>
                            </div>
                        <?php } ?>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Название</label>
                            <div class="col-sm-10">
                                <input type="text" name="title" value="<?php echo $_POST['title'] ?? $news->title; ?>" class="form-control" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Описание</label>
                            <div class="col-sm-10">
                                <textarea name="content" class="form-control" id="summernote" required><?php echo $_POST['content'] ?? $news->content; ?></textarea>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Категории</label>
                            <div class="col-sm-10">
                                <select name="categories[]" class="form-control select2" multiple="multiple">
                                    <?php foreach ($arData['categories_list'] as /** @var \App\Entity\Category $category */ $category) {
                                        $selected = false;
                                        foreach ($news->categories as /** @var \App\Entity\Category $newsCategory */ $newsCategory) {
                                            if($newsCategory->id == $category->id) {
                                                $selected = true;
                                                break;
                                            }
                                        }
                                        ?>
                                        <option value="<?php echo $category->id; ?>"<?php if($selected) { ?> selected="selected" <?php } ?>><?php
                                            for($i = 0; $i <= $category->level; $i++) {
                                                echo '&ndash; &ndash; ';
                                            }
                                            echo $category->title;
                                            ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Картинка</label>
                            <div class="col-sm-10">
                                <div class="custom-file">
                                    <input type="file" name="image" class="custom-file-input" accept="image/jpeg, image/png" id="image_input">
                                    <label class="custom-file-label" for="image_input">Выбрать картинку</label>
                                </div>
                                <?php if(!empty($news->img)) { ?>
                                    <img src="<?php echo EntityImage::getEntityImage('news', $news->img); ?>" alt="" style="max-width: 200px;">
                                <?php } ?>
                            </div>
                        </div>


                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer">
                        <a href="<?php echo url('admin_entity_list', ['entity' => 'news']); ?>" class="btn btn-default">Отмена</a>
                        <button type="submit" class="btn btn-primary float-right">Сохранить</button>
                    </div>
                    <!-- /.card-footer -->
                    <input type="hidden" name="id" value="<?php echo $news->id; ?>">
                </form>
            </div>
        <?php }  ?>

    </div><!-- /.container-fluid -->
</section>
<!-- /.content -->
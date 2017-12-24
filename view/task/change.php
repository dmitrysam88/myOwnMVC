<?php
/**
 * Created by PhpStorm.
 * User: Dima
 * Date: 24.12.2017
 * Time: 9:18
 */
?>

<div class="row">
<div class="col-lg-1"></div>
<div class="col-lg-4">
    <a href="/task/index/" class="btn btn-info">На главную</a><br><br>
    <h4>Запись <?=$model->id?></h4><br>
    <p>Автор: <?=$model->userName?></p>
    <p>E-mail: <?=$model->email?></p>
    <p class="text-danger"><?=$mistake?></p>
<form action="" method="post">
    <label class="control-label">Отметка о выполнении</label><br>
    <input type="checkbox" name="done" <?=($model->done==1?"checked":"")?>><br>
    <label class="control-label">Текст задачи</label><br>
    <textarea name="text" id="inputText" cols="30" rows="10" class="form-control"><?=$model->text?></textarea><br>
    <input type="submit" class="btn btn-primary" value="Сохранить">
</form>
</div>
<div class="col-lg-7"></div>
</div>

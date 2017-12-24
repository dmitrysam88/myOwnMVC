
<div class="row">
   <div class="col-lg-1"></div>
   <div class="col-lg-10">
       <?for ($i=1;$i<=$countPages;$i++){?>
           <a href="/task/index?page=<?=$i.($sort==""?"":"&sort=".$sort)?>" class="btn btn-default"><?=$i?></a>
       <?}?>
       <br>
       <br>
       <a href="/task/index?page=<?=$nowPage?>" class="btn btn-default">Не cортировать</a>
       <a href="/task/index?page=<?=$nowPage?>&sort=userName" class="btn btn-default">Сортировать по имени</a>
       <a href="/task/index?page=<?=$nowPage?>&sort=email" class="btn btn-default">Сортировать по E-mail</a>
       <a href="/task/index?page=<?=$nowPage?>&sort=done" class="btn btn-default">Сортировать по статусу</a>
       <?if ($isAdmin){?>
           <a href="/task/logout" class="btn btn-info">Выйти</a>
       <?}else{?>
            <a href="/task/login" class="btn btn-info">Войти</a>
       <?}?>
   </div>
   <div class="col-lg-1"></div>
</div>

<ul>
    <? foreach ($models as $key => $model){?>
        <? if ($pageModel[$key]!=$nowPage){
            continue;
        } ?>
        <li><div class="well">
                <div class="row">
                    <div class="col-lg-3">
                        <img src="/image/<?=$model->image?>" alt="image" height="320" width="240">
                    </div>
                    <div class="col-lg-9">
                        <p>Текст: <?=$model->text?></p>
                        <p>Автор: <?=$model->userName?></p>
                        <p>E-mail: <?=$model->email?></p>
                        <?if ($model->done){?>
                            <h3 class="text-danger">Выполнена</h3>
                        <?}?>
                        <?if ($isAdmin){?>
                            <a href="/task/change?id=<?=$model->id?>" class="btn btn-default">Редактировать</a>
                        <?}?>
                    </div>
                </div>
            </div></li>
    <?}?>
</ul>
<ul>
    <li id="previousLi" hidden>
        <div class="well">
            <h4 class="text-success">Предварительны просмотр Вашей задачи</h4>
            <div class="row">
                <div class="col-lg-3" id="show-image">
                    <div id="preview">
                        <img src="" alt="image" id="preview_image" height="320" width="240">
                    </div>
                </div>
                <div class="col-lg-9"">
                    <p id="show-text"></p>
                    <p id="show-name"></p>
                    <p id="show-email"></p>
                </div>
            </div>
        </div>
    </li>
</ul>


<div class="row">

    <div class="col-lg-3"></div>
    <div class="col-lg-6">
        <p class="text-danger"><?=$mistake?></p>
        <form action="" method="post" enctype="multipart/form-data" id="taskForm">
            <label class="control-label">Имя пользователя</label>
            <br>
            <input type="text" name="userName" class="form-control" id="inputName">
            <br>
            <label class="control-label">E-mail</label>
            <br>
            <input type="email" name="email" class="form-control" id="inputEmail">
            <br>
            <label class="control-label">Текст задачи</label>
            <br>
            <textarea name="text" id="inputText" cols="30" rows="10" class="form-control"></textarea>
            <br>
            <input type="file" name="image" accept="image/gif,image/png,image/jpeg"  accept="image/*" id="picture">
            <br>
            <input type="button" class="btn btn-primary" value="Предварительный просмотр" id="buttonPreview">
            <input type="submit" class="btn btn-primary" value="Сохранить">
        </form>
    </div>
    <div class="col-lg-3"></div>
</div>

<script type="text/javascript" src="/script.js"></script>
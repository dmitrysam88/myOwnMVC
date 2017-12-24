<?php
/**
 * Created by PhpStorm.
 * User: Dima
 * Date: 24.12.2017
 * Time: 1:33
 */
?>


<div class="row">
    <div class="col-lg-1"></div>
    <div class="col-lg-3">
        <a href="/task/index/" class="btn btn-info">На главную</a><br><br>
        <p class="text-danger"><?=$mistake?></p><br>
        <form action="" method="post">
            <label class="control-label">Логин</label><br>
            <input type="text" name="login" class="form-control"><br>
            <label class="control-label">Пароль</label><br>
            <input type="password" name="password" class="form-control"><br>
            <input type="submit" class="btn btn-primary" value="Войти">
    </div>
    <div class="col-lg-8"></div>
    </form>
</div>

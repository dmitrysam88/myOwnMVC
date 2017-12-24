<?php
/**
 * Created by PhpStorm.
 * User: Dima
 * Date: 23.12.2017
 * Time: 15:58
 */

namespace controller;

use core\Paginator;
use core\Routing;
use model\Task as ModelTask;
use core\ImageManager;


class Task extends \core\Controller{

    public function index(){

        $mistake = "";

        if (count($_POST)>0){
            $newModel = new ModelTask();
            $newModel->loadData($_POST);
        }

        if (count($_FILES)>0 && isset($newModel)){
            ImageManager::save();
            $newModel->loadImage($_FILES['image']['name']);
        }

        if (isset($newModel)){
            $newModel->done = 0;
            $mistake = $newModel->save();
            if ($mistake == ""){
                Routing::redirect("task/index?page=1");
            }
        }
        $sort = "";
        if (isset($_GET['sort'])){
            $sort = $_GET['sort'];
        }
        if (isset($_GET['page']) && ctype_digit($_GET['page'])){
            $nowPage = ((int)$_GET['page']);
        }

        $models = ModelTask::findAll($sort);
        $pageModel = Paginator::getPages($models,3);
        if (count($pageModel)>0){
            $countPages = max($pageModel);
        }else{
            $countPages = 0;
        }
        $this->render('index',[
            'models' => $models,
            'mistake' => $mistake,
            'isAdmin'=>(isset($_SESSION['user'])&&$_SESSION['user']==admin_login),
            'countPages' => $countPages,
            'pageModel' => $pageModel,
            'nowPage' => $nowPage,
            'sort' => $sort
        ]);
    }

    public function login(){
        $mistake = "";
        if (count($_POST)>0 && $_POST['login'] == admin_login && $_POST['password'] == admin_password){
            $_SESSION['user'] = $_POST['login'];
        }elseif (isset($_POST['login']) && isset($_POST['password'])){
            $mistake = "Неверный логин или пароль";
        }
        if ($_SESSION['user'] == admin_login){
            Routing::redirect("task/index?page=1");
        }else{
            $this->render('login',['mistake' => $mistake]);
        }
    }

    public function change(){

        $mistake = "";

        if (count($_POST)>0 && ctype_digit($_GET['id'])) {
            $model = ModelTask::findOne((int)$_GET['id']);
            $model->text = $_POST['text'];
            if (isset($_POST['done']) && $_POST['done'] == "on") {
                $model->done = 1;
            } else {
                $model->done = 0;
            }
            $mistake = $model->save();
            if ($mistake == "") {
                Routing::redirect("task/index?page=1");
            }
        }
        if ($_SESSION['user'] != admin_login){
            Routing::redirect("task/login/");
        }elseif (!ctype_digit($_GET['id'])){
            Routing::redirect("task/index?page=1");
        }else{
            $model = ModelTask::findOne((int)$_GET['id']);
            $this->render('change',['model' => $model,'mistake' => $mistake]);
        }
    }

    public function logout(){
        unset($_SESSION['user']);
        Routing::redirect("task/index?page=1");
    }

}
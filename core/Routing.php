<?php
/**
 * Created by PhpStorm.
 * User: Dima
 * Date: 21.12.2017
 * Time: 22:53
 */

namespace core;

use Composer\Autoload\ClassLoader;
use controller;

class Routing
{

    static public function execute(){
        $mistake = false;
        //$type = $_REQUEST['type'];
        $controllerName = ucwords($_REQUEST['controller']);
        $actionName = $_REQUEST['action'];

        if (is_null($controllerName)){
            self::redirect(default_controller."/index?page=1");
            return;
        }

        $controllerName = "controller\\".$controllerName;

        if (class_exists($controllerName)){
            $objControl = new $controllerName();
            if (method_exists($objControl,$actionName)){
                $objControl->$actionName();
            }else{
                $mistake = true;
            }
        }else{
            $mistake = true;
        }
        if ($mistake){
            self::redirect("404");
        }
    }

    static public function redirect($path){
        header("Location: http://".root_url."/".$path);
    }

}
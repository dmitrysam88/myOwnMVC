<?php
/**
 * Created by PhpStorm.
 * User: Dima
 * Date: 23.12.2017
 * Time: 0:37
 */

namespace core;


class Controller{

    public function render($view,$data=null){

        if (is_array($data)){
            foreach ($data as $key => $datum){
                $$key = $datum;
            }
        }
        $className = str_replace("controller\\","",get_class($this));
        $fileName = __DIR__;
        $fileMain = str_replace("core","view\main.php",$fileName);
        $fileName = str_replace("core","view\\".$className."\\".$view.".php", $fileName);
        include_once $fileMain;
    }

}
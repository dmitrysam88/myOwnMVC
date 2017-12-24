<?php
/**
 * Created by PhpStorm.
 * User: Dima
 * Date: 24.12.2017
 * Time: 11:23
 */

namespace core;


class Paginator{

    public static function getPages($models,$countPageModels){
        $pageModel = array();
        foreach ($models as $key => $model){
            $pageModel[$key] = intdiv ($key,$countPageModels)+1;
        }
        return $pageModel;
    }

}
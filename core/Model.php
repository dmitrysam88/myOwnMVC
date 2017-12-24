<?php
/**
 * Created by PhpStorm.
 * User: Dima
 * Date: 23.12.2017
 * Time: 11:12
 */

namespace core;


use model\MyTable;

class Model{

    protected $rules;

    public function getFields($className){
        $result = get_class_vars($className);
        unset($result['rules']);
        return $result;
    }

    public function getTable($className){
        return str_replace("model\\","",$className);
    }

    public function save(){
        $mistake = $this->validate();
        if ($mistake == ""){
            $vars = self::getFields(get_class($this));
            $table = self::getTable(get_class($this));
            $newVars =array();
            foreach ($vars as $key => $var){
                if (is_null($var) && !is_null($this->$key)){
                    $newVars[$key] = $this->$key;
                }
            }
            $db = new \core\db();
            $db->tableFields($newVars,$table)->write();
            $result = "";
        }else{
            $result = $mistake;
        }
        return $result;
    }

    public function validate(){
        $mistake = "";
        foreach ($this->rules as $key => $rule){
            if ($rule == 'string'){
                if (mb_strlen($this->$key)<2){
                    $mistake = ($key=='userName'?"Имя пользователя слишком короткое":"Текст слишко короткий");
                }
            }elseif ($rule == 'email'){
                if (!filter_var($this->$key,FILTER_VALIDATE_EMAIL)){
                    $mistake = "E-mail не правильный";
                }
            }
        }
        return $mistake;
    }

    public static function findAll($orderBy = null){
        $model = new static();
        $table = self::getTable(get_class($model));
        $fields = self::getFields(get_class($model));

        unset($model);

        $db = new \core\db();
        $querry = $db->tableFields($fields,$table);
        if (!is_null($orderBy)){
            $querry->orderBy($orderBy);
        }
        $results = $querry->select();
        $modelArray = array();
        foreach ($results as $result){
            $model = new static();
            foreach ($result as $key => $item){
                $model->$key = $item;
            }
            array_push($modelArray,$model);
        }
        return $modelArray;
    }

    public static function findOne($id){
        if (!is_int($id)){
            $id = 0;
        }
        $model = new static();
        $table = self::getTable(get_class($model));
        $fields = self::getFields(get_class($model));

        $db = new \core\db();
        $result = $db->tableFields($fields,$table)->where(['id'=>$id])->limit(1)->select();
        foreach ($result[0] as $key => $item){
            $model->$key = $item;
        }
        return $model;
    }

}
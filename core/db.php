<?php
/**
 * Created by PhpStorm.
 * User: Dima
 * Date: 22.12.2017
 * Time: 20:13
 */

namespace core;


class db{

    private $fields;
    private $table;
    private $where;
    private $orderBy;
    private $values;
    private $limit;

    public function __construct(){
        $this->fields = "";
        $this->table = "";
        $this->where = "";
        $this->orderBy = "";
        $this->limit = "";
    }

    public static function connect(){
        return new \mysqli(sql_host,sql_user,sql_pass,sql_db,sql_port);
    }

    public static function doingQuerry($textQuerry){
        $mysqli = self::connect();
        $result = $mysqli->query($textQuerry);
        $mysqli->close();
        return $result;
    }

    public function select(){
        $mysqli = self::connect();
        $arrayRes = array();
        if ($this->fields == "" || $this->table == ""){
            return $arrayRes;
        }
        $textQuerry = " SELECT ".$this->fields." FROM ".$this->table;
        if ($this->where != ""){
            $textQuerry .= " WHERE ".$this->where;
        }
        if ($this->orderBy != ""){
            $textQuerry .= " ORDER BY ".$this->orderBy;
        }
        if ($this->limit != ""){
            $textQuerry .= " LIMIT ".$this->limit;
        }
        $result = $mysqli->query($textQuerry);
        if (!$result){
            return $arrayRes;
        }
        while ($row = $result->fetch_assoc()){
            array_push($arrayRes,$row);
        }
        $mysqli->close();
        return $arrayRes;
    }

    public function write(){
        $mysqli = self::connect();
        $textQuerry = " INSERT INTO ".$this->table." SET ".$this->values." ON DUPLICATE KEY UPDATE ".$this->values;
        $result = $mysqli->query($textQuerry);
        $mysqli->close();
        return $result;
    }

    public function tableFields($fields=null,$table){
        if(is_array($fields)){
            $strFields = "";
            $strValue = "";
            foreach ($fields as $key => $field){
                if (is_int($key)){
                    $strFields .= $field.",";
                }else {
                    $strFields .= $key.",";
                    $strValue .= $key." = ".(is_string($field)?"'".$field."'":$field).",";
                }
            }
            $strValue = substr($strValue,0,-1);
            $fields = substr($strFields,0,-1);
        }elseif (is_null($fields)){
            $fields = " * ";
        }
        $this->values = $strValue;
        $this->fields = $fields;
        $this->table = $table;
        return $this;
    }

    public function where($conditions){
        if (is_array($conditions)){
            $strWhere = "";
            foreach ($conditions as $key => $condition){
                if (is_array($condition)){
                    $strIn = "(";
                    foreach ($condition as $item){
                        $strIn .= $item.",";
                    }
                    $strIn = substr($strIn,0,-1).")";
                    $strWhere .= $key." IN ".$strIn.",";
                }else{
                    $strWhere .= $key." = ".$condition.",";
                }
            }
            $this->where = substr($strWhere,0,-1);
        }
        return $this;
    }

    public function orderBy($conditions){
        if (is_array($conditions)){
            $strOrder = "";
            foreach ($conditions as $condition){
                $strOrder .= $condition.",";
            }
            $this->orderBy = substr($strOrder,0,-1);
        }elseif(is_string($conditions)){
            $this->orderBy = $conditions;
        }
        return $this;
    }

    public function limit($limit){
        if (is_int($limit)){
            $this->limit = $limit;
        }
        return $this;
    }

}
<?php
/**
 * Created by PhpStorm.
 * User: Dima
 * Date: 23.12.2017
 * Time: 16:08
 */

namespace model;


class Task extends \core\Model{

    public $id;
    public $userName;
    public $email;
    public $text;
    public $image;
    public $done;

    public function __construct(){
        $this->rules = ['userName' => 'string','text' => 'string','email' => 'email'];
    }

    public function loadImage($fileName){
        $this->image = $fileName;
        return $this;
    }

    public function loadData($data){
        foreach ($data as $key => $datum){
            $this->$key = htmlspecialchars($datum);
        }
        return $this;
    }

}
<?php
/**
 * Created by PhpStorm.
 * User: Dima
 * Date: 23.12.2017
 * Time: 23:11
 */

namespace core;


class ImageManager{

    public static function save(){
        $uploadfile = __DIR__;
        $uploadfile = str_replace("core","image",$uploadfile)."\\".$_FILES['image']['name'];
        move_uploaded_file($_FILES['image']['tmp_name'],$uploadfile);
        self::imageresize($uploadfile,$uploadfile,320,240,75);
    }

    public static function imageresize($outfile,$infile,$neww,$newh,$quality) {

        $im=imagecreatefromjpeg($infile);
        $im1=imagecreatetruecolor($neww,$newh);
        imagecopyresampled($im1,$im,0,0,0,0,$neww,$newh,imagesx($im),imagesy($im));

        imagejpeg($im1,$outfile,$quality);
        imagedestroy($im);
        imagedestroy($im1);
    }
}
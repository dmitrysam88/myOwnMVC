<?php
/**
 * Created by PhpStorm.
 * User: Dima
 * Date: 20.12.2017
 * Time: 22:01
 */

use core\Routing;

session_start();

require_once __DIR__."/vendor/autoload.php";
require_once __DIR__."/config.php";

$type = $_REQUEST['type'];

Routing::execute();

core\db::doingQuerry(file_get_contents(__DIR__."/CreateTable.txt"));

?>

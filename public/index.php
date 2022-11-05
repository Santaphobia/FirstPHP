<?php
session_start();

use app\engine\App;
use app\models\entities\Orders;

$config = include realpath("../config/config.php");
include realpath("../engine/Autoload.php");


try {
    App::call()->run($config);
} catch (\Exception $e) {
    var_dump($e);
};






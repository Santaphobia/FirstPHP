<?php
session_start();

use app\engine\App;
use app\models\entities\Orders;

$config = include realpath("../config/config.php");
include realpath("../engine/Autoload.php");


try {

App::call()->run($config);
//$product = new \app\models\entities\Product('f','ff',232323, 'fffff');
//var_dump($product);
//App::call()->productRepository->save($product);
//$login = $_SESSION['login'];
//$basket = App::call()->basketRepository->getAll();
//$order = new Orders($login, 'ff' , 'fff', 'fff', json_encode($basket));
//var_dump($order);
//App::call()->ordersRepository->save($order);
//die();
////json_encode($basket) $price = App::call()->productRepository->getPrice(5);
//var_dump($price);
////var_dump(App::call()->basketRepository->getSumFieldWhere('quantity', 'session_id', session_id()));
//$basket = App::call()->basketRepository->getWhereTwo('session_id', session_id(), 'product_id', 5);
//var_dump($basket);
//////$basket->quantity += 1;
//////var_dump($basket);
//////App::call()->basketRepository->update($basket);
//die();

} catch (\Exception $e) {
    var_dump($e);
};






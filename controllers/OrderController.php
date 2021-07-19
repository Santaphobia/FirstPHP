<?php


namespace app\controllers;


use app\engine\App;
use app\models\entities\Orders;

class OrderController extends Controller
{
    public function actionIndex()
    {
        $orders = App::call()->ordersRepository->getAll();
        echo $this->render('orders', ['orders' => $orders]);
    }

    public function actionAddOrder()
    {
        $login = $_SESSION['login'];
        $name = App::call()->request->getParams()['order_name'];
        $phone = App::call()->request->getParams()['order_phone'];
        $adress = App::call()->request->getParams()['order_adress'];
        $basket = App::call()->basketRepository->getBasket(session_id());
        $order = new Orders($login, $name , $phone, $adress, json_encode($basket));
        App::call()->ordersRepository->save($order);
        App::call()->basketRepository->delWhere('session_id', session_id());
        header('Content-Type: application/json');
        echo json_encode([
            'response' => 'ok',
            'count' => 0,
            'order_id' => $order->id
        ]);
        die();
    }

    public function actionCard() {
        $id = App::call()->request->getParams()['id'];
        $order = App::call()->ordersRepository->getOne($id);
        echo $this->render('orderCard', ['order' => $order]);
    }

    public function actionConfirm() {
        $id = App::call()->request->getParams()['id'];
        $order = App::call()->ordersRepository->getOne($id);
        $order->status = 'confirmed';
        App::call()->ordersRepository->save($order);
        header('Location: /order/index');
        exit();
    }
}
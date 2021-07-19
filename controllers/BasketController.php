<?php


namespace app\controllers;


use app\engine\App;
use app\models\entities\Basket;


class BasketController extends Controller
{

    public function actionIndex()
    {
        $basket = App::call()->basketRepository->getBasket(session_id());
        echo $this->render('basket', ['products' => $basket]);
    }

    public function actionAddToBasket()
    {
        $id = App::call()->request->getParams()['id'];
        $basket = App::call()->basketRepository->getWhereTwo('session_id', session_id(), 'product_id', $id);
        if ($basket) {
            $basket->quantity += 1;
            App::call()->basketRepository->update($basket);
        } else {
            $basket = new Basket(session_id(), $id);
            App::call()->basketRepository->save($basket);
        }
        header('Content-Type: application/json');
        echo json_encode([
            'response' => 'ok',
            'count' => App::call()->basketRepository->getSumFieldWhere('quantity', 'session_id', session_id())
        ]);
        die();
    }

    public function actionDelete()
    {
        $id = App::call()->request->getParams()['id'];
        $session = session_id();
        $basket = App::call()->basketRepository->getOne($id);
        if ($basket->quantity > 1) {
            $basket->quantity -= 1;
            $quantity = $basket->quantity;
            App::call()->basketRepository->update($basket);
            $price = App::call()->productRepository->getPrice($basket->product_id);
        } else {
            $quantity = 0;
            $price = 0;
            App::call()->basketRepository->delete($basket);
        }
        echo json_encode([
            'response' => 'ok',
            'count' => App::call()->basketRepository->getSumFieldWhere('quantity', 'session_id', session_id()),
            'price' => $price,
            'quantity' => $quantity
        ]);
        die();
    }

    public function vieweForm() {
        $basket = App::call()->basketRepository->getBasket(session_id());

    }

}
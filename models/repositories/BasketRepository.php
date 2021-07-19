<?php


namespace app\models\repositories;

use app\engine\App;
use app\models\entities\Basket;
use app\models\Repository;

class BasketRepository extends Repository
{
    public function getBasket($session) {
        $sql = "SELECT p.id id_prod, b.id id_basket, b.quantity, p.name, p.description, p.price FROM basket b,products p WHERE b.product_id=p.id AND session_id = :session";
        return App::call()->db->queryAll($sql, ['session' => $session]);
    }

    public function checkProduct($field, $value, $field2, $value2) {
        $tableName = $this->getTableName();
        $sql = "SELECT exists(SELECT {$field} FROM {$tableName} WHERE {$field} = :value AND {$field2} = :value2)";
        return array_values(App::call()->db->queryOne($sql, ["value" => $value, "value2" => $value2]))[0];
    }

    public function getSum($basket) {
        $sum = 0;
        foreach ($basket as $item) {
            $sum += $item['price']*$item['quantity'];
        }
        return $sum;
    }

    public function delWhere($field, $value)
    {
        $tableName = $this->getTableName();
        $sql = "DELETE FROM {$tableName} WHERE `$field`=:value";
        return App::call()->db->execute($sql, ["value" => $value]);
    }

    public function getTableName()
    {
        return "basket";
    }

    public function getEntityClass()
    {
        return Basket::class;
    }
}
<?php


namespace app\models\entities;


use app\models\Model;

class Orders extends Model
{
    protected $id;
    protected $user_login;
    protected $name;
    protected $phone;
    protected $adress;
    protected $products;
    protected $status;

    protected $props = [
        'user_login' => false,
        'name' => false,
        'phone' => false,
        'adress' => false,
        'products' => false,
        'status' => false
    ];

    /**
     * Orders constructor.
     * @param $user_login
     * @param $name
     * @param $phone
     * @param $adress
     * @param $products
     */
    public function __construct($user_login = null, $name = null, $phone = null, $adress = null, $products = null, $status = 'processing')
    {
        $this->user_login = $user_login;
        $this->name = $name;
        $this->phone = $phone;
        $this->adress = $adress;
        $this->products = $products;
        $this->status = $status;
    }

}
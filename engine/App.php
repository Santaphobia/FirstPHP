<?php


namespace app\engine;


use app\models\repositories\BasketRepository;
use app\models\repositories\OrdersPepository;
use app\models\repositories\ProductRepository;
use app\models\repositories\UsersRepository;
use app\traits\TSingletone;

/**
 * Class App
 * @property Request $request
 * @property BasketRepository $basketRepository
 * @property UsersRepository $usersRepository
 * @property ProductRepository $productRepository
 * @property OrdersRepository $ordersRepository
 * @property Db $db
 */
class App
{
    use TSingletone;
    public $config;

    /** @var  Storage */
    private $components;

    private $controller;
    private $action;

    /**
     * @return static
     */
    public static function call()
    {
        return static::getInstance();
    }

    public function runController()
    {
        $this->controller = $this->request->getControllerName() ?: 'product';
        $this->action = $this->request->getActionName();

        $controllerClass = $this->config['controllers_namespaces'] . ucfirst($this->controller) . "Controller";

        if (class_exists($controllerClass)) {
            $controller = new $controllerClass(new Render());
            $controller->runAction($this->action);
        } else {
            echo "Не правильный контроллер";
        }
    }


    public function createComponent($name)
    {
        if (isset($this->config['components'][$name])) {
            $params = $this->config['components'][$name];
            $class = $params['class'];
            if (class_exists($class)) {
                unset($params['class']);
                $reflection = new \ReflectionClass($class);
                return $reflection->newInstanceArgs($params);

            }
        }
        return null;
    }

    public function run($config)
    {
        $this->config = $config;
        $this->components = new Storage();
        $this->runController();
    }

    function __get($name)
    {
        return $this->components->get($name);
    }

}
<?php


namespace app\core;


use app\models\repositories\CartRepository;
use app\models\repositories\OrderRepository;
use app\models\repositories\ProductRepository;
use app\models\repositories\UserRepository;
use app\traits\TSingleton;

/**
 * Class App
 * @property  Request $request
 * @property  Session $session
 * @property  Db $db
 * @property  CartRepository $cartRepository
 * @property  productRepository $productRepository
 * @property  UserRepository $userRepository
 * @property  OrderRepository $orderRepository
 */
class App
{
    use TSingleton;

    public $config;
    /**
     * @var Storage
     */
    private $components;
    private $controller;

    public function run($config)
    {
        $this->config = $config;
        $this->components = new Storage();

        try {
            $this->runController();
        } catch (\Exception $exception) {
            var_dump($exception);
        }
    }

    public function runController()
    {
        $this->controller = $this->request->getControllerName();

        $controllerClass = $this->config['ctrl_namespaces'] . ucfirst($this->controller) . "Controller";

        if (class_exists($controllerClass)) {
            new $controllerClass(new TwigRender());
        } else {
            $message = "Not found controller: {$controllerClass}. Url is incorrect ({$_SERVER['REQUEST_URI']}).";
            throw new \Exception($message);
        }
    }

    public function createComponent($name)
    {
        if (isset($this->config['components'][$name])) {
            $params = $this->config['components'][$name];
            $class = $params['class'];
            if (class_exists($class)) {
                unset($params['class']);
                try {
                    $reflection = new \ReflectionClass($class);
                    return $reflection->newInstanceArgs($params);
                } catch (\ReflectionException $e) {
                    var_dump($e);
                }
            }
        }
    }

    /**
     * @return static
     */
    public static function call()
    {
        return static::getInstance();
    }

    public function __get($name)
    {
        return $this->components->get($name);
    }
}

<?php

use app\core\Db;
use app\core\{Request, Session};
use app\models\repositories\CartRepository;
use app\models\repositories\ProductRepository;
use app\models\repositories\UserRepository;
use app\models\repositories\OrderRepository;

return [
    'dir_root' => $_SERVER['DOCUMENT_ROOT'],
    'dir_tpl' => dirname(__DIR__) . DIRECTORY_SEPARATOR . 'templates',
    'ctrl_namespaces' => 'app\controllers\\',
    'components' => [
        'db' => [
            'class' => Db::class,
            'driver' => 'mysql',
            'host' => 'localhost',
            'login' => 'root',
            'password' => '',
            'database' => 'shop',
            'charset' => 'utf8'
        ],
        'request' => [
            'class' => Request::class
        ],
        'session' => [
            'class' => Session::class
        ],
        //TODO По хорошему сделать для репозиториев отедьное простое хранилищебез reflection
        'cartRepository' => [
            'class' => CartRepository::class
        ],
        'productRepository' => [
            'class' => ProductRepository::class
        ],
        'userRepository' => [
            'class' => UserRepository::class
        ],
        'orderRepository' => [
            'class' => OrderRepository::class
        ],
    ]
];

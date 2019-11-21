<?php


namespace app\controllers;


use app\models\entities\CartModel;
use app\models\entities\OrderModel;
use app\models\repositories\CartRepository;
use app\models\repositories\OrderRepository;

class OrderController extends Controller
{
    public function createParams()
    {
        return true;
    }

    public function formApiAnswer()
    {
        $action = $this->request->getActionName();

        if (method_exists($this, $action)) {
            $result = $this->$action();
        } else {
            $result['status'] = false;
            $result['message'] = 'Метода не существует';
        }

        echo json_encode($result, JSON_UNESCAPED_UNICODE);
        die();
    }

    public function checkout()
    {
        $order = new OrderModel(
            $this->session->sessionId,
            $this->request->getParams()['email']
        );
        $result['status'] = (new OrderRepository())->insert($order);

        if ($result['status']) {
            $result['order_num'] = (int) $order->id;

            $cart = new CartModel();
            $cart->order_num = $result['order_num'];
            (new CartRepository())->addOrderNumber($this->session->sessionId, $result['order_num']);
            session_regenerate_id();
        } else {
            $result['message'] = 'Во время выполнения операции произошла ошибка!';
        }

        return $result;
    }
}
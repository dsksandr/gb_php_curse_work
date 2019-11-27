<?php


namespace app\controllers;


use app\core\App;
use app\models\entities\OrderModel;

class OrderController extends Controller
{
    public
    function createParams()
    {
        return true;
    }

    public
    function formApiAnswer()
    {
        $action = App::call()->request->getActionName();

        if (method_exists($this, $action)) {
            $result = $this->$action();
        } else {
            $result['status'] = false;
            $result['message'] = 'Метода не существует';
        }

        echo json_encode($result, JSON_UNESCAPED_UNICODE);
        die();
    }

    public
    function checkout()
    {
        $order = new OrderModel(
            null,
            App::call()->session->getSessionID(),
            App::call()->request->getParams()['email']
        );
        $result['status'] = App::call()->orderRepository->insert($order);

        if ($result['status']) {

            $result['order_num'] = (int)$order->getID();

            App::call()->cartRepository->addOrderNumber($order->getID());
            App::call()->session->regenerateSessionID();

        } else {

            $result['message'] = 'Во время выполнения операции произошла ошибка!';

        }

        return $result;
    }

    public
    function change_status()
    {
        $order = new OrderModel(
            App::call()->request->getParams()['id'],
        );

        $order->status = (int) App::call()->request->getParams()['status'];

        $result['status'] = App::call()->orderRepository->update($order);

        if (!$result['status']) {

            $result['message'] = 'Во время выполнения операции произошла ошибка!';
        }

        return $result;
    }
}
<?php


namespace app\controllers;


use app\core\TwigRender;
use app\models\CartModel;

class CartController extends Controller
{
    public function createParams()
    {
        $cart = New CartModel();

        $this->params['page'] = 'cart';
        $this->params['cart'] = $cart->cart;
        $this->params['cart_count'] = $cart->count;

        echo $this->renderer->render($this->params);
    }

    public function formApiAnswer()
    {
        $action = $this->request->getActionName();

        if (method_exists($this, $action)) {
            $result['status'] = $this->$action($this->request->getParams()['id']);
            if ($result['status']) {
                $result['count'] = CartModel::getCartCount();
            } else {
                $result['message'] = 'В ходе выполнеия операции возникла ошибка';
            }
        } else {
            $result['status'] = false;
            $result['message'] = 'Метода не существует';
        }

        echo json_encode($result, JSON_UNESCAPED_UNICODE);
        die();
    }

    public function add($id)
    {
        return CartModel::changeProductCount($id, 1);
    }

    public function del($id)
    {
        return CartModel::changeProductCount($id, -1);
    }
}
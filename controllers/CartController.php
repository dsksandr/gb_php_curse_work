<?php


namespace app\controllers;


use app\models\repositories\CartRepository;

class CartController extends Controller
{
    public function createParams()
    {
        $this->params['page'] = 'cart';
        $this->params['cart'] = (new CartRepository())->getProductsFromCart();
        $this->params['cart_count'] = (new CartRepository())->getCartCount();

        echo $this->renderer->render($this->params);
    }

    public function formApiAnswer()
    {
        $action = $this->request->getActionName();

        if (method_exists($this, $action)) {
            $result['status'] = $this->$action($this->request->getParams()['id']);
            if ($result['status']) {
                $result['count'] = (new CartRepository())->getCartCount();
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
        return (new CartRepository())->changeProductCount($id, 1);
    }

    public function del($id)
    {
        return (new CartRepository())->changeProductCount($id, -1);
    }
}
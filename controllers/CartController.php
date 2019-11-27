<?php


namespace app\controllers;


use app\core\App;

class CartController extends Controller
{
    public
    function createParams()
    {
        $this->params['page'] = 'cart';
        $this->params['cart_products'] = App::call()->cartRepository->getProductsFromCart();
        $this->params['cart_count'] = App::call()->cartRepository->getCartCount();

        echo $this->renderer->render($this->params);
    }

    public
    function formApiAnswer()
    {
        $action = App::call()->request->getActionName();

        if (method_exists($this, $action)) {

            $id = App::call()->request->getParams()['id'];

            $result['status'] = $this->$action($id);

            if ($result['status']) {
                $result['count'] = App::call()->cartRepository->getCartCount();

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

    public
    function add($id)
    {
        return App::call()->cartRepository->changeProductCount($id, 1);
    }

    public
    function del($id)
    {
        return App::call()->cartRepository->changeProductCount($id, -1);
    }
}
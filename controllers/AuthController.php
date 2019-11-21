<?php


namespace app\controllers;


use app\models\repositories\UserRepository;

class AuthController extends Controller
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

    public function login()
    {
        $result = [];
        $login = $this->request->getParams()['login'];
        $pass = $this->request->getParams()['pass'];

        $user = (new UserRepository())->getUser('login', $login);

        if (!(new UserRepository())->checkLogPwd($login, $pass, $user, $this->session)) {
            $result['status'] = false;
            $result['text'] = 'Не верный логин или пароль';
        } else {
            if ($this->request->getParams()['save']) {
                $user->hash = uniqid(rand(), true);

                (new UserRepository())->update($user);

                setcookie('hash', $user->hash, time() + 3600, '/');
            }
            $result['status'] = true;
            $result['login'] = $user->login;
            $result['access'] = $user->access;
        }

        return $result;
    }

    public function logout()
    {
        session_destroy();
        session_unset();
        setcookie('hash', '', time() + 3600, '/');

        $result['status'] = true;
        $result['http_referer'] = $_SERVER['HTTP_REFERER'];

        return $result;
    }
}

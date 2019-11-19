<?php


namespace app\controllers;


use app\core\Session;
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

        if (!$this->checkLogPwd($login, $pass)) {
            $result['status'] = false;
            $result['text'] = 'Не верный логин или пароль';
        } else {
            if (isset($this->request->getParams()['save'])) {
                $hash = uniqid(rand(), true);
                $id = $this->session->getUserId();

                (new UserRepository())->updateUserData($id, $hash);

                setcookie('hash', $hash, time() + 3600);
            }
            $result['status'] = true;
            $result['login'] = $login;
        }

        return $result;
    }

    public function logout()
    {
        session_destroy();
        session_unset();
        setcookie('hash');

        $result['status'] = true;
        $result['http_referer'] = $_SERVER['HTTP_REFERER'];

        return $result;
    }

    public static function isAuth(Session $session)
    {
        if (isset($_COOKIE['hash'])) {
            $hash = $_COOKIE['hash'];
            $user_data = (new UserRepository())->getUser('hash', $hash);
            $user = $user_data['login'];
            if (!empty($user)) {
                $session->setUserLogin($user);
            }
        }
        return isset($session->login) ? true : false;
    }

    protected function checkLogPwd($login, $pass)
    {
        $user_data = (new UserRepository())->getUser('login', $login);


        if (password_verify($pass, $user_data->password)) {
            $this->session->setUserLogin($login);
            $this->session->setUserId($user_data->id);

//            var_dump($user_data);
//            var_dump($pass);
            return true;
        }
        return false;
    }
}
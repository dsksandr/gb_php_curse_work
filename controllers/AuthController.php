<?php


namespace app\controllers;


use app\core\Session;
use app\models\UserModel;

class AuthController extends Controller
{
    public function createParams()
    {
        return true;
    }

    public function formApiAnswer()
    {
        $action = $this->params['action'];

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
        $login = $this->request['login'];
        $pass = $this->request['pass'];

        if (!$this->checkLogPwd($login, $pass)) {
            $result['status'] = false;
            $result['text'] = 'Не верный логин или пароль';
        } else {
            if (isset($this->request['save'])) {
                $hash = uniqid(rand(), true);
                $id = $this->session['id'];

                UserModel::updateUserData($id, $hash);

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
            $user_data = UserModel::getUser('hash', $hash);
            $user = $user_data['login'];
            if (!empty($user)) {
                $session['login'] = $user;
            }
        }
        return isset($session['login']) ? true : false;
    }

    protected function checkLogPwd($login, $pass)
    {
        $user_data = UserModel::getUser('login', $login);

        if (password_verify($pass, $user_data->password)) {
            $this->session['login'] = $login;
            $this->session['id'] = $user_data->id;
            return true;
        }
        return false;
    }
}
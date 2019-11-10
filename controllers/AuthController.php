<?php


namespace app\controllers;


use app\models\UserModel;

class AuthController extends Controller
{
    public function createParams()
    {
        $action = $this->params['action'];

        echo json_encode($this->$action(), JSON_UNESCAPED_UNICODE);
        die();
    }

    public function login()
    {
        $result = [];
        $login = $_POST['login'];
        $pass = $_POST['pass'];

        if (!$this->checkLogPwd($login, $pass)) {
            $result['status'] = false;
            $result['text'] = 'Не верный логин или пароль';
        } else {
            if (isset($_POST['save'])) {
                $hash = uniqid(rand(), true);
                $id = ($_SESSION['id']);

                UserModel::updateUserData($id, $hash);

                setcookie("hash", $hash, time() + 3600);
            }
            $result['status'] = true;
            $result['login'] = $login;
        }

        return $result;
    }

    public function actionLogout()
    {

    }

    public static function isAuth()
    {
        if (isset($_COOKIE["hash"])) {
            $hash = $_COOKIE["hash"];
            $user_data = UserModel::getUser('hash', $hash);
            $user = $user_data['login'];
            if (!empty($user)) {
                $_SESSION['login'] = $user;
            }
        }
        return isset($_SESSION['login']) ? true : false;
    }

    public static function getUser()
    {
        return $_SESSION['login'];
    }

    protected function checkLogPwd($login, $pass)
    {
        $user_data = UserModel::getUser('login', $login);

        if (password_verify($pass, $user_data->password)) {
            $_SESSION['login'] = $login;
            $_SESSION['id'] = $user_data->id;
            return true;
        }
        return false;
    }
}
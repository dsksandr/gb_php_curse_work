<?php


namespace app\controllers;


use app\core\App;

class AuthController extends Controller
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
    function login()
    {
        $result = [];
        $login = App::call()->request->getParams()['login'];
        $pass = App::call()->request->getParams()['pass'];

        $user = App::call()->userRepository->getUser('login', $login);

        if (!App::call()->userRepository->checkLogPwd($pass, $user)) {

            $result['status'] = false;
            $result['text'] = 'Не верный логин или пароль';

        } else {

            App::call()->session->setUserLogin($user->login);
            App::call()->session->setUserID($user->id);
            App::call()->session->setUserAccess($user->access);


            if (App::call()->request->getParams()['save']) {

                $user->hash = uniqid(rand(), true);

                App::call()->userRepository->update($user);

                setcookie('hash', $user->hash, time() + 3600, '/');
            }

            $result['status'] = true;
            $result['login'] = $user->login;
            $result['access'] = $user->access;
        }

        return $result;
    }

    public
    function logout()
    {
        session_destroy();
        session_unset();
        setcookie('hash', '', time() + 3600, '/');

        $result['status'] = true;
        $result['http_referer'] = $_SERVER['HTTP_REFERER'];

        return $result;
    }
}

<?php

namespace app\core;


class Request
{
    protected $requestString;
    protected $controllerName;
    protected $actionName;
    protected $params;
    protected $method;
    protected $type;

    public function __construct()
    {
        $this->requestString = $_SERVER['REQUEST_URI'];
        $this->parseRequest();
    }

    private function parseRequest()
    {
        $this->method = $_SERVER['REQUEST_METHOD'];
        $url = explode('/', $this->requestString);

        if ($url[1] === 'api') {
            $this->controllerName = $url[2];
            $this->type = $url[1];
        } else {
            $this->controllerName = empty($url[1]) ? 'index' : $url[1];
        }

        $this->actionName = $_REQUEST['action'];
        $this->params = $_REQUEST;
        $data = json_decode(file_get_contents('php://input'));
        if (!is_null($data)) {
            foreach ($data as $key => $elem) {
                $this->params[$key] = $elem;
            }
        }
    }

    /**
     * @return mixed
     */
    public function getControllerName()
    {
        return $this->controllerName;
    }

    /**
     * @return mixed
     */
    public function getActionName()
    {
        return $this->actionName;
    }

    /**
     * @return mixed
     */
    public function getParams()
    {
        return $this->params;
    }

    /**
     * @return mixed
     */
    public function getMethod()
    {
        return $this->method;
    }

    /**
     * @return mixed
     */
    public function getType()
    {
        return $this->type;
    }
}

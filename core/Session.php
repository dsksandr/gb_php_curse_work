<?php

namespace app\core;


class Session
{
    protected $sessionId;
    protected $userLogin;
    protected $userId;
    protected $userAccess;

    /**
     * Session constructor.
     */
    public function __construct()
    {
        $this->sessionId = session_id();
        $this->userLogin = isset($_SESSION['userLogin']) ? $_SESSION['userLogin'] : null;
        $this->userId = isset($_SESSION['userId']) ? $_SESSION['userId'] : null;
        $this->userAccess = isset($_SESSION['userAccess']) ? $_SESSION['userAccess'] : null;
    }

    public function __get($name)
    {
        return $this->$name;
    }

    public function __set($name, $value)
    {
        if (property_exists($this, $name)) {
            $_SESSION[$name] = $value;
            $this->$name = $value;
        }
    }
}

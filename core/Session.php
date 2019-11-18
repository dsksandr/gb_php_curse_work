<?php

namespace app\core;


class Session
{
    protected $sessionId;
    protected $userLogin;
    protected $userId;

    /**
     * Session constructor.
     */
    public function __construct()
    {
        $this->sessionId = session_id();
        $this->userLogin = isset($_SESSION['login']) ? $_SESSION['login'] : null;
        $this->userId = isset($_SESSION['id']) ? $_SESSION['id'] : null;
    }

    /**
     * @return mixed
     */
    public function getSessionId()
    {
        return $this->sessionId;
    }

    /**
     * @return mixed
     */
    public function getUserLogin()
    {
        return $this->userLogin;
    }

    /**
     * @param string $value
     */
    public function setUserLogin($value)
    {
        $this->userLogin = $value;
    }

    /**
     * @return mixed
     */
    public function getUserId()
    {
        return $this->sessionId;
    }

    /**
     * @param string $value
     */
    public function setUserId($value)
    {
        $this->userId = $value;
    }
}

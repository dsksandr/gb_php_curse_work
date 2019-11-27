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
    public
    function __construct()
    {
        session_start();

        $this->sessionId = session_id();
        $this->userLogin = isset($_SESSION['userLogin']) ? $_SESSION['userLogin'] : null;
        $this->userId = isset($_SESSION['userId']) ? $_SESSION['userId'] : null;
        $this->userAccess = isset($_SESSION['userAccess']) ? $_SESSION['userAccess'] : null;
    }

    public
    function getSessionID()
    {
        return $this->sessionId;
    }

    public
    function regenerateSessionID()
    {
        session_regenerate_id();
    }

    public
    function getUserLogin()
    {
        return $this->userLogin;
    }

    public
    function setUserLogin($value)
    {
        $_SESSION['userLogin'] = $value;
        $this->userLogin = $value;
    }

    public
    function getUserID()
    {
        return $this->userId;
    }

    public
    function setUserID($value)
    {
        $_SESSION['userId'] = $value;
        $this->userId = $value;
    }

    public
    function getUserAccess()
    {
        return $this->userAccess;
    }

    public
    function setUserAccess($value)
    {
        $_SESSION['userAccess'] = $value;
        $this->userAccess = $value;
    }
}

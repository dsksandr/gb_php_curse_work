<?php

namespace app\core;


class Session
{
    public $sessionId;

    public function __construct()
    {
        $this->parseSession();
        $this->sessionId = session_id();
    }

    private function parseSession()
    {
        $data = $_SESSION;
        if (!is_null($data)) {
            foreach ($data as $key => $value) {
                $this->$key = $value;
            }
        }
    }
}

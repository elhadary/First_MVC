<?php

namespace app\Core;

class Response
{
    public function setErrorCode($code)
    {
        http_response_code($code);
    }
}
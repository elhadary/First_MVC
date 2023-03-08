<?php

namespace app\Core;

class Session
{


    public function login($username)
    {
        $_SESSION['username'] = $username;
    }

    public function destroy()
    {
        session_destroy();
    }

}
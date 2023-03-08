<?php

namespace app\Core;

class Session
{


    public function login($username,$id)
    {
        $_SESSION['username'] = $username;
        $_SESSION['id'] = $id;

    }

    public function destroy()
    {
        session_destroy();
    }

}
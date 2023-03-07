<?php

namespace app\Models;

use app\Core\Model;
use PDO;

class User extends Model
{

    public function __construct()
    {
        $this->table = 'users';
        $this->pdo = new PDO($this->dsn,'root','',$this->opt);
    }



}
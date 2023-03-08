<?php

namespace app\Models;

use app\Core\Model;
use PDO;

class Post extends Model
{

    public function __construct()
    {
        $this->table = 'posts';
        $this->pdo = new PDO($this->dsn,'root','',$this->opt);
    }

}
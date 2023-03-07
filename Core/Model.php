<?php

namespace app\Core;

use PDO;

class Model
{
    protected string $dsn = 'mysql:host=localhost;dbname=blog';
    protected array $opt = array(
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::MYSQL_ATTR_FOUND_ROWS => true,
    );
    protected PDO $pdo;
    protected string $table;
    public string $query;
    public string $error = '';

    public function select()
    {
        $this->query = 'SELECT * FROM '.$this->table;
        return $this;
    }
    public function delete()
    {
        $this->query = "DELETE FROM $this->table";
        return $this;
    }

    public function insert($array)
    {
        $sql = '';
        foreach ($array as $key => $value) {

            $sql .= "$key = '$value'";
            if ($key !== array_key_last($array)) {
                $sql .= ", ";
            }
        }
        $this->query = "INSERT INTO $this->table SET $sql";
        return $this;
    }

    public function update($array)
    {
        $sql = '';
        foreach ($array as $key => $value) {
            $sql .= "$key = '$value'";
            if ($key !== array_key_last($array)) {
                $sql .= ", ";
            }
        }
        $this->query = "UPDATE $this->table SET $sql";
        return $this;
    }

    public function where($first,$condition,$second)
    {
        $this->query .= " WHERE $first $condition '$second'";
        return $this;
    }



    public function fetchAll()
    {
        $stmt = $this->pdo->query($this->query);
        return $stmt->fetchAll();
    }

    public function execute()
    {
        $stmt = $this->pdo->prepare($this->query);
        try {
            $stmt->execute();
            return $stmt->rowCount();
        }catch (\PDOException $e)
        {
            return $this->showError($e);

        }
    }

    public function showError($e)
    {
        $this->error =  '<div class="alert alert-danger" role="alert">'.$e->getMessage().'</div>';
    }



}


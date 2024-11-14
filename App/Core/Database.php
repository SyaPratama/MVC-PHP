<?php

namespace App\Core;

require_once __DIR__ . "/../../config/config.php";

class Database
{
    private $dbh;
    private $opt;
    private $statement;
    private string $type = DB_CONNECT;
    private string $host = DB_HOST;
    private string $name = DB_NAME;
    private string $user = DB_USER;
    private string $pass = DB_PASS;
    public function __construct()
    {
      try{
        $this->opt = [
            \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,
            \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC,
            \PDO::ATTR_PERSISTENT => true,
        ];
        
        $this->dbh = new \PDO("{$this->type}:host={$this->host};dbname={$this->name}", username: $this->user, password: $this->pass, options: $this->opt);
      }catch(\PDOException $e){
        if($e->getCode() == 1049)
        {
            $pdo = new \PDO("{$this->type}:host={$this->host}",username: $this->user,password: $this->pass,options: [\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION]);
            $pdo->query("CREATE DATABASE IF NOT EXISTS $this->name");
            $pdo->query("use $this->name");
        }
      }
    }

    public function prepare(string $sql): void
    {
        $this->statement = $this->dbh->prepare($sql);
    }

    public function bind(string $param, mixed $value, $type = null): void
    {
        if ($type === null) {
            match (true) {
                is_int($value) => $type = \PDO::PARAM_INT,
                is_bool($value) => $type = \PDO::PARAM_BOOL,
                $value === null => $type = \PDO::PARAM_NULL,
                default => $type = \PDO::PARAM_STR,
            };
        }
        $this->statement->bindParam($param, $value, $type);
    }

    public function execute(): void
    {
        $this->statement->execute();
    }

    public function fetch(): mixed
    {
        $this->execute();
        return $this->statement->fetch();
    }

    public function fetchAll(): mixed
    {
        $this->execute();
        return $this->statement->fetchAll();
    }

    public function rowCount(): int
    {
        return $this->statement->rowCount();
    }
}
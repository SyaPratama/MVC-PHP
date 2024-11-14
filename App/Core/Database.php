<?php

namespace App\Core;

class Database
{
    private $dbh;
    private $opt;
    private $statement;
    public function __construct(private string $dbType = getenv("DB_TYPE"), private string $host = getenv("DB_HOST"), private string $name = getenv("DB_NAME"), private string $user = getenv("DB_USER"), private string $pass = getenv("DB_PASS"))
    {
        $this->opt = [
            \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,
            \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC,
            \PDO::ATTR_PERSISTENT => true,
        ];

        $this->dbh = new \PDO("{$this->dbType}:host={$this->host};dbname={$this->name}",username: $this->user,password: $this->pass,options: $this->opt);
    }

    public function prepare(string $sql): void
    {
        $this->statement = $this->dbh->prepare($sql);
    }

    public function bind(string $param, mixed $value, $type = null): void
    {
        if ($type === null) {
            match(true) {
                is_int($value) => $type = \PDO::PARAM_INT,
                is_bool($value) => $type = \PDO::PARAM_BOOL,
                $value === null => $type = \PDO::PARAM_NULL,
                default => $type = \PDO::PARAM_STR,
            };
        }
        $this->statement->bindParam($param,$value,$type);
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
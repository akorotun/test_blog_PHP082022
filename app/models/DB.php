<?php

require_once ('Singleton.php');

class DB extends Singleton
{
    private string $host = 'localhost';
    private PDO $connection ;

    /**
     * @return PDO|null
     */
    public function getConnection() :PDO
    {
        if (!isset($this->connection)) {
            $this->connection = new PDO("mysql:host={$this->host};dbname=cupcakes_blog", 'root', '');
        }
        return $this->connection;
    }
}
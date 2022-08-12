<?php
require_once ('DB.php');

class Model
{
    protected static function getConnection()
    {
        return DB::getInstance()->getConnection();
    }

    protected static function query(string $sql)
    {
        return self::getConnection()->query($sql);
    }

    protected static function prepare(string $sql)
    {
        return self::getConnection()->prepare($sql);
    }

    protected static function execute(string $sql, array $params = [])
    {
        $query = self::prepare($sql); // Подготовили sql запрос
        $query->execute($params);
    }

}
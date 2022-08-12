<?php

require_once('Model.php');

class PostsModel extends Model
{
    public string $name = '';
    public string $text = '';

    public static function getPosts()
    {
        $result = self::query("SELECT * FROM `posts` ORDER BY `id` ASC");
        return $result->fetchAll(PDO::FETCH_ASSOC);//преобразуем данные из базы данных в ассоциативный массив
    }

    //не получается сделать так же с комментариями - ругается
    //Cannot declare class DbModel, because the name is already in use

    public function save()
    {
        $sql = "INSERT INTO `posts` (`visitore_name`, `text`) VALUES (?, ?)";
        $params = [
            $this->name,
            $this->text
        ];
        self::execute($sql, $params);
    }
}

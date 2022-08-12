<?php

require_once('Model.php');

class CommentModel extends Model
{
    public string $name = '';
    public string $text = '';

    public function getComments()
    {
        $result = self::query("SELECT * FROM `comments` ORDER BY `id` ASC");
        return $result->fetchAll(PDO::FETCH_ASSOC);//преобразуем данные из базы данных в ассоциативный массив
    }

//    public function saveComments($name, $text, $id_post)
//    {
//        $sql = "INSERT INTO `posts` (`visitore_name`, `text`) VALUES (?, ?)";
//        $query = $this->_db->prepare($sql); // Подготовили sql запрос
//        $query->execute([$name, $text]);
//    }

}
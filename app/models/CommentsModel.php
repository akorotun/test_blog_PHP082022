<?php

require_once('Model.php');

class CommentsModel extends Model
{
    public string $name = '';
    public string $text = '';
    public int $postId;

    public function getComments()
    {
        $result = self::query("SELECT * FROM `comments` ORDER BY `id` DESC ");
        return $result->fetchAll(PDO::FETCH_ASSOC);
    }

    public function save()
    {
        $sql = "INSERT INTO `comments` (`visitore_name`, `comment`, `post_id`) VALUES (?, ?, ?)";
        $params = [
            $this->name,
            $this->text,
            $this->postId,
        ];
        self::execute($sql, $params);
    }

    public function getCommentsByPostId($postId)
    {
        $result = self::query("SELECT * FROM `comments` WHERE `post_id` = '$postId' ORDER BY `id` DESC ");
        return $result->fetchAll(PDO::FETCH_ASSOC);
    }
}
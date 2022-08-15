<?php

class Comment extends Controller
{
    public function store()
    {
        //убираем лишние пробелы, делаем FILTER_SANITIZE_STRING
        $name = $this->getPost('name');
        $text = $this->getPost('text');
        $postId = $this->getPost('postId');

        //проверяем, чтобы обязательные поля были заполнены
        if(strlen($name) <= 2){
            return $this->errorJsonAnswer('Введите имя больше 2-х символов');
        }
        if(strlen($text) <= 2){
            return $this->errorJsonAnswer('Введите текст больше 2-х символов');
        }

        //сохранили коммент
        /** @var CommentsModel $newComment */
        $newComment = $this->model('CommentsModel');
        $newComment->name = $name;
        $newComment->text = $text;
        $newComment->postId = $postId;
        $newComment->save();

        //получаем нужные комментарии к посту
        /** @var CommentsModel $commentsModel */
        $commentsModel = $this->model('CommentsModel');
        $comments = $commentsModel->getCommentsByPostId($postId);


        $html = $this->renderView('home/comments', ['comments'=>$comments]);
        $this->successJsonAnswer(['html'=>$html]);
    }
}
<?php

class Home extends Controller
{
    public function index()
    {
        $posts = $this->model('PostsModel');// создали объект на основе модели PostsModel
        //в Controller уже определили массив $data = [];

        $comments = $this->model('CommentModel');// - Cannot declare class DbModel, because the name is already in use
        //надо как-то переделать подключение к базе
        $data = [
            'posts' => $posts->getPosts(),
            'comments' => $comments->getComments()
        ];
        $this->view('home/index', $data);
    }
}
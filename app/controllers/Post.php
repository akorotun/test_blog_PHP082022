<?php

class Post extends Controller
{
    public function store()
    {
        $name =  trim(filter_var($_POST['name'], FILTER_SANITIZE_STRING));
        $text =  trim(filter_var($_POST['text'], FILTER_SANITIZE_STRING));
//        $error = '';
//        if(strlen($name) <= 3)
//            $error = 'Введите имя (больше 3-х символов)';
//        else if(strlen($text) <= 10)
//            $error = 'Введите текст статьи (больше 10-ти символов)';
//
//        if($error != '') {
//            echo $error;
//            exit();
//        }
        /** @var \PostsModel $newPost */
        $newPost = $this->model('PostsModel');// создали объект на основе модели PostsModel
        $newPost->name = $name;
        $newPost->text = $text;
        $newPost->save();


        $this->successJsonAnswer();
    }
}
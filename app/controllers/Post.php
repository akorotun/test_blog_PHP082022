<?php

class Post extends Controller
{
    public function store()
    {
        //убираем лишние пробелы, делаем FILTER_SANITIZE_STRING
        $name = $this->getPost('name');
        $text =  $this->getPost('text');

        //проверяем, чтобы обязательные поля были заполнены
        if(strlen($name) <= 2){
            return $this->errorJsonAnswer('Введите имя больше 2-х символов');
        }
        if(strlen($text) <= 2){
            return $this->errorJsonAnswer('Введите текст больше 2-х символов');
        }

        //сохранили пост
        /** @var PostsModel $newPost */
        $newPost = $this->model('PostsModel');// создали объект на основе модели PostsModel
        $newPost->name = $name;
        $newPost->text = $text;
        $newPost->save();

        //получили посты
        /** @var PostsModel $postsModel */
        $postsModel = $this->model('PostsModel');
        $posts = $postsModel->getPostsFilledWithRelations();
        $allPosts = $postsModel->countPosts();

        $html = $this->renderView('home/posts', ['posts'=>$posts]);
//        $this->successJsonAnswer(['html'=>$html]);
        $this->successJsonAnswer(['html'=>$html, 'allPosts' => $allPosts]);

    }
}
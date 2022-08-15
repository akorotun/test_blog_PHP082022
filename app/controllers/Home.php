<?php

class Home extends Controller
{
    public function index()
    {
        $postsModel = $this->model('PostsModel');
//        $commentsModel = $this->model('CommentsModel');// удалить
        $ratingsModel = $this->model('RatingsModel');

        //получили посты
        $posts = $postsModel->getPostsFilledWithRelations();

        //количество всех постов, негативных и позитивных
        $countPosts = $postsModel->countPosts();
        $countRatings = $ratingsModel->ratingCounter();// количество негативных и позитивных постов

        $data = [
            'posts' => $posts,
            'countPosts' => $countPosts,
            'countRatings' => $countRatings,
        ];
        $this->view('home/index', $data);
    }
}
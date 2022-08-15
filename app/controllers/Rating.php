<?php

class Rating extends Controller
{
    public function store()
    {
        //убираем лишние пробелы, делаем FILTER_SANITIZE_STRING
        $rating = $this->getPost('rating');
        $postId = $this->getPost('postId');

        //сохранили рейтинг
        $newRating = $this->model('RatingsModel');
        $newRating->rating = $rating;
        $newRating->postId = $postId;
        $newRating->save();

        //получил рейтинг
        $ratingsModel = $this->model('RatingsModel');
        $rating = $ratingsModel->getRatingByPostId($postId);


        //получили подсчет рейтингов к постам
        $countRatings = $ratingsModel->ratingCounter();

        $this->successJsonAnswer([
            'rating'=>$rating,
            'negativePosts' => $countRatings['negativePosts'],
            'positivePosts' => $countRatings['positivePosts'],
//            'allPosts' => $countRatings['allPosts']
        ]);
    }
}
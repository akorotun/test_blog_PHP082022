<?php
require_once('Model.php');
require_once('PostsModel.php');

class RatingsModel extends Model
{
    public string $rating = '';
    public int $postId;

    public function save()
    {
        $sql = "INSERT INTO `ratings` (`rating`, `post_id`) VALUES (?, ?)";
        $params = [
            $this->rating,
            $this->postId,
        ];
        self::execute($sql, $params);
    }

    // получили все рейтинги постов
    public function getPostRatings()
    {
        $postsRatings = self::query("SELECT `post_id`, ROUND(AVG(rating)) as 'post_rating' FROM `ratings` GROUP By `post_id`");
        return $postsRatings->fetchAll(PDO::FETCH_ASSOC);
    }

    //подсчет негативных и позитивных постов (по оценке рейтинга)
    public function ratingCounter()
    {
        $postModel = new PostsModel();
//        $allPosts = $postModel->countPosts();

        $negativePosts = 0;
        $positivePosts = 0;
        foreach ($this->getPostRatings() as $postRating){
            if ($postRating['post_rating'] <= 2){
                $negativePosts++;
            }
            if ($postRating['post_rating'] >= 4){
                $positivePosts++;
            }
        }
        return [
            'negativePosts' => $negativePosts,
            'positivePosts' => $positivePosts,
//            'allPosts' => $allPosts
        ];
    }

    public function getRatingByPostId($postId)
    {
        $result = self::query("SELECT `post_id`, ROUND(AVG(rating)) as 'post_rating' FROM `ratings` 
                                    WHERE `post_id` = '$postId' GROUP By `post_id`");
        $rating = $result->fetch(PDO::FETCH_ASSOC);
        return $rating['post_rating'] ?? 0; // если рейтинга нет, то вернется рейтинг поста ноль
    }
}
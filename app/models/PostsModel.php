<?php
require_once('Model.php');
require_once('CommentsModel.php');
require_once('RatingsModel.php');

class PostsModel extends Model
{
    public string $name = '';
    public string $text = '';

    public function getPosts()
    {
        $result = self::query("SELECT * FROM `posts` ORDER BY `id` DESC");
        return $result->fetchAll(PDO::FETCH_ASSOC);
    }

    //выбор постов, комментов и заполнение комментариями постов
    /**
     * @return array
     */
    public function getPostsFilledWithRelations()
    {
        $commentsModel = new CommentsModel();
        $ratingsModel = new RatingsModel();

        $posts = $this->getPosts();
        $comments = $commentsModel->getComments();
        $ratings = $ratingsModel->getPostRatings();

        foreach ($posts as $key => $post){
            foreach ($comments as $comment){
                if(!isset($posts[$key]['comments'])){
                    $posts[$key]['comments'] = [];
                }

                if ($post['id'] == $comment['post_id']){
                    $posts[$key]['comments'][] = $comment;
                }
            }
        }

        foreach ($posts as $key => $post){
            foreach ($ratings as $rating){
                if (!isset($posts[$key]['rating'])){
                    $posts[$key]['rating'] = '0';
                }
                if ($post['id'] == $rating['post_id']){
                    $posts[$key]['rating'] = $rating['post_rating'];
                }
            }
        }
        return $posts;
    }

    // подсчет общего количества постов
    public function countPosts()
    {
        $query = self::query("SELECT * FROM `posts`");
        return count($query->fetchAll(PDO::FETCH_ASSOC));

//        $amountAllPosts = count($query->fetchAll(PDO::FETCH_ASSOC));
//        return ['amountAllPosts' => $amountAllPosts];
    }

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

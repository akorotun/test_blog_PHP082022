<?php /* @var array $post*/?>
<?php
//    if (isset($data['comments'])){
//        $comments = $data['comments'];
//    } elseif (isset($post['comments'])){
//        $comments = $post['comments'];
//    } else {
//        $comments = [];
//    }
    $comments = $data['comments'] ?? $post['comments']??[];
?>
<?php
//echo '<pre>';
//var_dump($post);
//die();?>
<div class="comments">
    <?php foreach($comments as $comment) : ?>
        <p><span class="post-author">
                        by <?=$comment['visitore_name']?>
                    </span>
            <span class="post-date">
                        - <?=$comment['create_at']?>
                    </span></p>
        <p class="post-text"><?=$comment['comment']?></p>
    <?php endforeach; ?>
</div>
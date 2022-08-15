<?php /* @var array $data*/?>

<h3>List Posts</h3>
<?php
//echo '<pre>';
//var_dump($data);
//die();?>

<?php foreach ($data['posts'] as $post): ?>

    <div class="posts" id="post-<?=$post['id']?>">
        <p>
            <span class="post-author">by <?=$post['visitore_name']?></span>
            <span class="post-date"> - <?=$post['create_at']?> / post rating - </span>
            <span class="post_rating"><?=$post['rating']?></span>
        </p>
        <p class="post-text"><?=$post['text']?></p>

        <div class="bt-rt">
            <button class="btn btn-new-comment addNewComment" value="<?= $post['id'] ?>">
                new comment
            </button>

            <fieldset class="rating">
                <legend>Please rate:</legend>
                <input type="radio" data-post_id="<?= $post['id'] ?>" class="ratePost" id="star5_<?= $post['id'] ?>" name="rating_<?= $post['id'] ?>" value="5" /><label for="star5_<?= $post['id'] ?>" title="Rocks!">5 stars</label>
                <input type="radio" data-post_id="<?= $post['id'] ?>" class="ratePost" id="star4_<?= $post['id'] ?>" name="rating_<?= $post['id'] ?>" value="4" /><label for="star4_<?= $post['id'] ?>" title="Pretty good">4 stars</label>
                <input type="radio" data-post_id="<?= $post['id'] ?>" class="ratePost" id="star3_<?= $post['id'] ?>" name="rating_<?= $post['id'] ?>" value="3" /><label for="star3_<?= $post['id'] ?>" title="Meh">3 stars</label>
                <input type="radio" data-post_id="<?= $post['id'] ?>" class="ratePost" id="star2_<?= $post['id'] ?>" name="rating_<?= $post['id'] ?>" value="2" /><label for="star2_<?= $post['id'] ?>" title="Kinda bad">2 stars</label>
                <input type="radio" data-post_id="<?= $post['id'] ?>" class="ratePost" id="star1_<?= $post['id'] ?>" name="rating_<?= $post['id'] ?>" value="1" /><label for="star1_<?= $post['id'] ?>" title="Sucks big time">1 star</label>
            </fieldset>

        </div>

        <div class="list_comments">
            <?php require ('comments.php')?>
        </div>

    </div>
<?php endforeach; ?>
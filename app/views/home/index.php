<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Blog</title>
    <link rel="stylesheet" href="/public/css/main.css">
    <link rel="stylesheet" href="/public/css/form.css">
    <link rel="stylesheet" href="/public/css/rating.css">



    <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css"
          integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous"> -->

</head>
<body>
<header>
    <div class="container top-menu">
        <div class="nav">
            <span>Easy Cupcake Recipes</span>
        </div>
    </div>

    <div class="container middle">
        <div>
            <img class="middle-img" src="/public/imeges/mafin.jpeg" alt="Logo">
        </div>
    </div>
</header>
<div class="content">
    <div class="container menu sticky">
        <ul>
            <li>Negative Post</li>
            <li>All Posts</li>
            <li>Positive Posts</li>
        </ul>
    </div>

    <div class="container main">
        <form action="" method="post" class="form-comment">
            <h4>New comment</h4>
            <input type="text" name="name" id="name_comment" placeholder="Name" value=""><br>
            <textarea name="text" id="text_comment" rows="2" placeholder="Text"></textarea>
            <div class="errorBlockNewComment"></div>
            <button class="btn" id="comment_save">Save comment</button>
        </form>
    </div>

    <div class="container main">
            <button class="btn" id="addNewPost">Add new Post</button>
    </div>

    <div class="container main" id="formNewPost">
        <form action="" method="post" class="form-control">
            <h3>New post</h3>
            <input type="text" name="name" id="name" placeholder="Name"><br>
            <textarea name="text" id="text" rows="3" placeholder="Text"></textarea>
            <div class="error" id="errorBlock"></div>
            <button class="btn" id="post_save">Save post</button>
        </form>
    </div>

    <div class="container main" id="list_post">
        <h3>List Posts</h3>
        <pre>
            <!--<?php print_r($data) ?>-->
        </pre>
            <?php for ($i=0; $i < count($data['posts']); $i++): ?>
            <div class="posts">
                <p><span class="post-author">by <?=$data['posts'][$i]['visitore_name']?></span><span class="post-date"> - <?=$data['posts'][$i]['create_at']?></span></p>
                <p class="post-text"><?=$data['posts'][$i]['text']?></p>




                <div class="bt-rt">
                    <button class="btn btn-new-comment" id="addNewComment">new comment</button>

                    <fieldset class="rating">
                        <legend>Please rate:</legend>
                        <input type="radio" id="star5" name="rating" value="5" /><label for="star5" title="Rocks!">5 stars</label>
                        <input type="radio" id="star4" name="rating" value="4" /><label for="star4" title="Pretty good">4 stars</label>
                        <input type="radio" id="star3" name="rating" value="3" /><label for="star3" title="Meh">3 stars</label>
                        <input type="radio" id="star2" name="rating" value="2" /><label for="star2" title="Kinda bad">2 stars</label>
                        <input type="radio" id="star1" name="rating" value="1" /><label for="star1" title="Sucks big time">1 star</label>
                    </fieldset>

                </div>

                <div class="comments">
                <?php for ($y=0; $y < count($data['comments']); $y++): ?>
                    <?php
                        if ($data['comments'][$y]['id_post'] == $data['posts'][$i]['id']):
                    ?>
                <p><span class="post-author">by <?=$data['comments'][$y]['visitore_name']?></span><span class="post-date"> - <?=$data['comments'][$y]['create_at']?></span></p>
                <p class="post-text"><?=$data['comments'][$y]['comment']?></p>
                <?php endif ?>
                <?php endfor ?>
                </div>

            </div>
            <?php endfor ?>
    </div>

</div>

    <script src="/public/js/jquery-3.6.0.min.js"></script>

    <script>
        <!-- открываем форму для добавления нового поста -->
        $('#addNewPost').click(function() {
            $('.form-control').css('display', 'block');
        });
    </script>

    <script>
        <!-- открываем форму для добавления нового коммента -->
        $('#addNewComment').click(function() {
            $('.form-comment').css('display', 'block');
        });
    </script>

    <script>
        <!-- сохраняем новый пост -->
        $(document).ready(function() {
            console.log( "ready!" );//после загрузки всего документа

            $('#post_save').click(function(event) {//действие на клик
                // alert( "Handler for .submit() called." );
                event.preventDefault();

                let name = $('#name').val();
                let text = $('#text').val();

                $.ajax({
                    type: 'POST',
                    url: '/post/store',
                    data: {'name' : name, 'text' : text},
                    // contentType: false,
                    // cache: false,
                    // processData: false,
                    success: function (result){
                        console.log(result.success);
                    },
                });
                $('.form-control').css('display', 'none');
            });
        });
    </script>
</body>
</html>

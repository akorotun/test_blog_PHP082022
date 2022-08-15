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

</head>
<body>
<header>
    <div class="container top-menu">
        <div class="nav">
            <a href="/"><span>Easy Cupcake Recipes</span></a>
        </div>
    </div>

    <div class="container middle">
        <div>
            <img class="middle-img" src="/public/images/muffin.jpeg" alt="Logo">
        </div>
    </div>
</header>
    <div class="content">
        <div class="container menu sticky">
            <ul>
                <li>Negative Post - <span id="negativePostsCounter"><?= $data['countRatings']['negativePosts'] ?></span>
                </li>
                <li>
                    All Posts - <span id="allPostsCounter"><?= $data['countPosts'] ?? $data['allPosts'] ?? '' ?></span>
                </li>
                <li>Positive Posts - <span id="positivePostsCounter"><?= $data['countRatings']['positivePosts'] ?></span>
                </li>
            </ul>
        </div>

        <div class="container main">
                <button class="btn" id="addNewPost">Add new Post</button>
        </div>

        <!-- Content: Posts, Comments, Rating-->
        <div class="container main" id="list_post">
            <?php require ('posts.php')?>
        </div>

        <!-- Opening a form for a new post -->
        <div class="container main" id="formNewPost">
            <form action="" method="post" class="form-control">
                <h3>New post</h3>
                <input type="text" name="name" id="name" placeholder="Name"><br>
                <textarea name="text" id="text" rows="3" placeholder="Text"></textarea>
                <div class="error" id="errorBlock"></div>
                <button class="btn" id="post_save">Save post</button>
            </form>
        </div>

        <!-- Opening a form for a new comment -->
        <div class="container main">
            <form action="" method="post" id="form-comment" class="form-comment">
                <h4>New comment</h4>
                <input type="text" name="name" id="name_comment" placeholder="Name"><br>
                <textarea name="text" id="text_comment" rows="2" placeholder="Text"></textarea>
                <input type="hidden" id="comment-post_id" name="comment-post_id">
                <div class="errorBlockNewComment"></div>
                <button class="btn" id="comment_save">Save comment</button>
            </form>
        </div>

    </div>

    <script src="/public/js/jquery-3.6.0.min.js"></script>
    <script src="/public/js/script.js"></script>

</body>
</html>

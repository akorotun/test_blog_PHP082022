<!-- Opening a form for a new post -->
$('#addNewPost').click(function() {
    $('.form-control').css({
        'display':'block',
        'position':'fixed',
        'left':'25%',
        'top':'50%',
        'background':'#E7F3D9'
    });
});

<!-- Opening a form for a new comment -->
var openCommentForm = function (){
    $('.addNewComment').click(function() {
        let postId = this.value;

        $('#comment-post_id').val(postId);
        $('.form-comment').css({
            'display':'block',
            'position':'fixed',
            'left':'25%',
            'top':'50%',
            'background':'#E7F3D9'
        });
        console.log(postId);
        console.log($('#comment-post_id').val());
    });
}

<!-- Save the new comment -->
var saveComment = function (){
    $('#comment_save').click(function(event) {//действие на клик
        event.preventDefault();

        let name = $('#name_comment').val();
        let text = $('#text_comment').val();
        let postId = $('#comment-post_id').val();
        $.ajax({
            type: 'POST',
            url: '/comment/store',
            data: {
                'name' : name,
                'text' : text,
                'postId' : postId
            },

            success: function (result){
                // console.log(JSON.parse(result));//надо переводить в объект
                let jsonResult = JSON.parse(result);//перевели в объект
                if (jsonResult['success'] === true){
                    $('.form-comment').css({
                        'display':'none',
                        'position':'static'
                    });//спрятали форму
                    console.log($('#post-' + postId).find('.list_comments'));
                    let commentsContainer = $('#post-' + postId).find('.list_comments');
                    commentsContainer.empty();
                    commentsContainer.prepend(jsonResult['html']);
                    alert('Comment saved')
                } else if (jsonResult['success'] === false){
                    alert(jsonResult['errorMassage']);
                } else {
                    alert('Something went wrong comment is not saved')
                }
            },
        });
    });
}

<!-- Save the new rating -->
var saveRating = function (){
    $('.ratePost').click(function(event) {//действие на клик
        event.preventDefault();
        let postId = this.dataset.post_id;// взяли значение post_id с атрибута data-post_id
        console.log(postId);
        console.log($(this).closest('.rating'));
        $(this).closest('.rating').hide();
        let rating = $(this).val();
        console.log(rating);

        $.ajax({
            type: 'POST',
            url: '/rating/store',
            data: {
                'rating' : rating,
                'postId' : postId
            },
            success: function (result){
                console.log(result);//
                let jsonResult = JSON.parse(result);
                if (jsonResult['success'] === true){
                    console.log($('#post-' + postId).find('.post_rating'));
                    let ratingContainer = $('#post-' + postId).find('.post_rating');

                    $('#negativePostsCounter').html(jsonResult['negativePosts']);
                    $('#positivePostsCounter').html(jsonResult['positivePosts']);
                    // $('#allPostsCounter').html(jsonResult['allPosts']);

                    ratingContainer.html(jsonResult['rating']);
                    alert('Rating saved')
                } else if (jsonResult['success'] === false){
                    alert(jsonResult['errorMassage']);
                } else {
                    alert('Something went wrong rating is not saved')
                }
            },
        });
    });
}

<!-- Save the new post -->
var savePost = function (){
    $('#post_save').click(function(event) {//действие на клик
        event.preventDefault();

        let name = $('#name').val();
        let text = $('#text').val();

        $.ajax({
            type: 'POST',
            url: '/post/store',
            data: {
                'name' : name,
                'text' : text
            },

            success: function (result){
                console.log(JSON.parse(result));
                let jsonResult = JSON.parse(result);//перевели в объект

                if (jsonResult['success'] === true){
                    $('.form-control').css({
                        'display':'none',
                        'position':'static'
                    });//спрятали форму

                    $('#list_post').empty();
                    $('#list_post').prepend(jsonResult['html']);
                    $('#allPostsCounter').html(jsonResult['allPosts']);
                    console.log($('#allPostsCounter').html(jsonResult['allPosts']))

                    openCommentForm();
                    saveRating();

                    alert('Post saved');
                } else if (jsonResult['success'] === false){
                    alert(jsonResult['errorMassage']);
                } else {
                    alert('Something went wrong post is not saved');
                }
            },
        });
    });
}


$(document).ready(function() {
    console.log( "ready!" );//после загрузки всего документа
    saveRating();
    saveComment();
    savePost();
    openCommentForm();
});








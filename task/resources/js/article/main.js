let $article = {};

$article.addComment = function ($action, $values) {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $.ajax({
        type: "POST",
        url: $action,
        data: $values,
        dataType: 'json',
    })
        .done(function ($response) {
            $('.reset-intro').append
            (`
                <br>
                <h2 style="text-align: center; color: #86d993">${$response.data.author}</h2>
                <p style="text-align: center; color: rgb(113, 113, 113)">${$response.data.article.text}</p>
                 <span style="font-size: 12px">${$response.data.article.created_at.split('.')[0].replaceAll('T',"-")}</span>
                <br>            
            `);

            $('.form-input').val("");
        });
}

$article.like = function ($action, $articleId) {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $.ajax({
        type: "POST",
        url: $action,
        data: {
            id: $articleId
        },
        dataType: 'json',
    })
        .done(function ($response) {
            $(`#${$response.data.id}`).text($response.data.likes_count)

        });
}

$article.init = function () {
    $('.comment-form').each(function() {
       $(this).on('submit', function (e) {
           $article.addComment(event.target.action, $(this).children().serialize());
           e.preventDefault();
       } );
    })

    $('.like').click(function (e) {
        console.log(5)
        $article.like($(this).data('href'), $(this).data('article-id'));
        e.preventDefault();
    })
}

$article.init();

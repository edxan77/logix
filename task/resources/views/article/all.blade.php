<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Home - Logix</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link
            href="https://fonts.googleapis.com/css2?family=Kanit:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
            rel="stylesheet">
    <link rel="stylesheet" href="{{mix('css/app.css')}}" />
    <link rel="stylesheet" href="{{mix('css/bootstrap.css')}}" />
</head>

<body>

<header>
    <div id="header-block" class="wrapper">
        <a href="/" style="text-decoration: none;"><h1 id="logo"><-</h1></a>
    </div>


</header>


<div id="content">
    <main id="main">

        <div id="register-block" class="reset-main">
            <div class="reset-wrapper">
                <div class="reset-intro">
                    <h1 class="intro-title">Search</h1>

                    <div id="register-form-block" class="reset-form">
                        <form class="form" id="email-reset" action="/articles" method="GET">
                            @csrf

                            <div class="reset-input">
                                <input class="form-input" type="text" placeholder="By Title" name="f[title]">
                            </div>

                            <div class="reset-input">
                                <input class="form-input" type="text" placeholder="By Tags" name="f[tags]">
                            </div>

                            <div class="reset-input">
                                <input class="form-input" type="text" placeholder="By Description" name="f[description]">
                            </div>

                            <div class="reset-input">
                                <button type="submit" class="sign-up-form-button">Search</button>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>
        <div class="wrapper">
            <div class="main-intro">
                <h2 class="intro-title">Blog <mark>and</mark> News</h2>
                <div style="word-wrap: break-word">
                    @foreach($articles as $article)
                        <div style="border: 4px dotted #86d993; width: 600px; margin-left: 200px; margin-top: 50px; padding: 10px 10px 10px">
                            <img style="width: 600px; height: 600px" src="data:image/jpeg;base64,{{ $article->image }}" alt="Image">
                            <h1 style="text-align: center">{{$article->title}}</h1>
                            <p style="text-align: center">{{$article->description}}</p>

                            @if(\Illuminate\Support\Facades\Auth::check())
                                <div id="register-block" class="reset-main">
                                    <div class="reset-wrapper">
                                        <div class="reset-intro">
                                            <div data-article-id="{{$article->id}}" class="reset-form comment-form">
                                                <form class="form" id="comment-form" action="article/comment/add" method="POST">
                                                    @csrf

                                                    <div class="reset-input">
                                                        <input style="width: 500px" class="form-input" type="text" placeholder="Type Your Comment Here" name="text">
                                                    </div>
                                                    <input style="width: 500px" class="form-input" type="hidden"  name="article_id" value="{{$article->id}}">

                                                </form>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            @endif

                            @foreach($article->comments as $comment)
                                <br>
                                <h2 style="text-align: center; color: #86d993">{{$comment->user->first_name . ' ' . $comment->user->last_name}}</h2>
                                <span style="font-size: 12px">{{$comment->created_at}}</span>
                                <p style="text-align: center; color: rgb(113, 113, 113); ">{{$comment->text}}</p>
                                <br>
                            @endforeach

                            @if(\Illuminate\Support\Facades\Auth::check())
                                <div style="margin-left: 45%; margin-bottom: 40px" class="quicksearch">
                                    <div class="quicksearch-input">
                                        <a class="like" data-article-id="{{$article->id}}" data-href="{{url('/article/like')}}"><button style="background-color: white; color:#86d993; font-size: 20px " type="button">like <span id="{{$article->id}}" style="color: #1a202c">{{$article->likes->count()}}</span></button></a>
                                    </div>
                                </div>
                            @endif
                        </div>

                    @endforeach
                </div>
            </div>
            <span style="display: flex; justify-content: center">{{$articles->links()}}</span>
        </div>
    </main>
</div>


<footer>

</footer>
<script src="{{mix('js/article.js')}}"></script>
</body>

</html>

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
    <link
            href="https://fonts.googleapis.com/css2?family=Kanit:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
            rel="stylesheet">
    <link rel="stylesheet" href="{{mix('css/app.css')}}" />
</head>

<body>
<header>
    <div id="header-block" class="wrapper">
        <a href="/" style="text-decoration: none"><h1 id="logo"><-</h1></a>
    </div>
</header>

<div id="content">
    <main id="main">
        <div class="wrapper">
            <div class="main-intro">
                <h2 class="intro-title">Add <mark>your</mark> Article</h2>
            </div>
        </div>
    </main>

    <div id="register-block" class="reset-main">
        <div class="reset-wrapper">
            <div class="reset-intro">
                <h1 class="intro-title">Add Article</h1>

                <div  class="reset-form">
                    <form class="form" enctype="multipart/form-data" action="/article/store" method="POST">
                        @csrf

                        <div class="reset-input">
                            <input class="form-input" type="text" placeholder="Title" value="{{ old('title') }}" name="title">
                        </div>

                        @error('title')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror

                        <div class="reset-input">
{{--                            <input class="form-input" type="text" placeholder="Description" value="{{ old('description') }}" name="description">--}}
                            <textarea placeholder="Description" name="description">{{ old('description') }}</textarea>
                        </div>

                        @error('description')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror

                        <div class="reset-input">
                            <input class="form-input" type="text" placeholder="Tags" value="{{ old('tags') }}" name="tags">
                        </div>

                        @error('tags')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror

                        <div class="reset-input">
                            <input class="form-input" type="file" placeholder="image" name="image">
                        </div>

                        @error('image')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror

                        <div class="reset-input">
                            <input type="radio" id="blog" name="type" value="{{\App\Models\Article::TYPE_BLOG}}">
                            <label for="blog">Blog</label><br>
                        </div>

                        <div class="reset-input">
                            <input type="radio" id="news" name="type" value="{{\App\Models\Article::TYPE_NEWS}}">
                            <label for="news">News</label><br>
                        </div>

                        @error('type')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror

                        <div class="reset-input">
                            <button type="submit" class="sign-up-form-button">Create</button>
                        </div>

                    </form>
                </div>
            </div>

        </div>
    </div>
</div>

<footer>

</footer>
</body>

</html>

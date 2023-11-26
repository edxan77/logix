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
        <h1 id="logo">Logix</h1>
        <h2 id="logo">{{$user->first_name . ' ' . $user->last_name}}</h2>
        <nav>
            <ul>
                <div class="buttons">
                    <li id="login"><a href="{{route('logout')}}" class="login">Log out</a></li>
                </div>
            </ul>
        </nav>
    </div>
</header>


<div id="content">
    <main id="main">
        <div class="wrapper">
            <div class="main-intro">
                <h2 class="intro-title"><mark>Logix</mark> Task</h2>
                <p class="intro-desc">
                    <span>With anyone, anywhere & anytime</span>
                </p>
                <div class="quicksearch">
                    <div class="quicksearch-input">
                        <a href="{{url('/article')}}"><button style="margin-left: 430px" type="button">Create Your Article</button></a>
                    </div>

                    <div class="quicksearch-input">
                        <a href="{{url('user/image/upload')}}"><button style="margin-left: 445px" type="button">Upload Image</button></a>
                    </div>

                    <div class="quicksearch-input">
                        <a href="{{url('user/images')}}"><button style="margin-left: 465px" type="button">Images</button></a>
                    </div>

                    <div class="quicksearch-input">
                        <a href="{{url('/articles')}}"><button style="margin-left: 465px" type="button">Articles</button></a>
                    </div>

                </div>
            </div>
        </div>
    </main>
</div>

<footer>

</footer>

</body>

</html>

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
        <nav>
            <ul>
                <div class="buttons">
                    <li><a href="#" class="signup" id="signup">Sign up</a></li>
                    <li id="login"><a href="#" class="login">Log in</a></li>
                </div>
            </ul>
        </nav>
    </div>
</header>

<div id="content">
    <main id="main">
        <div class="wrapper">
            <div class="main-intro">
                <h2 class="intro-title">Logix <mark>Blog</mark> News</h2>
                <p class="intro-desc">
                    <span>With anyone, anywhere & anytime</span>
                </p>
                <div class="quicksearch">
                    <div class="quicksearch-input">
                        <a href="{{url('/article')}}"><button style="margin-left: 430px" type="button">Create Your Article</button></a>
                    </div>

                    <div class="quicksearch-input">
                        <a href="{{url('/articles')}}"><button style="margin-left: 465px" type="button">Articles</button></a>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <div id="register-block" class="register-main">
        <div class="register-wrapper">
            <div class="register-intro">
                <h1 class="intro-title">Registration</h1>

                <div id="register-form-block" class="register-form">
                    <form class="form" action="/register" method="POST">
                        @csrf

                        <div class="register-input">
                            <input class="form-input" type="text" placeholder="First Name" name="first_name">
                        </div>
                        <div class="register-input">
                            <input class="form-input" type="text" placeholder="Last Name" name="last_name">
                        </div>
                        <div class="register-input">
                            <input class="form-input" type="text" placeholder="E-mail" name="email">
                        </div>

                        <div class="register-input">
                            <input class="form-input" type="password" placeholder="Password" name="password">
                        </div>

                        <div class="register-input">
                            <input class="form-input" type="password" placeholder="Password Confirmation" name="password_confirmation">
                        </div>

                        <div class="register-input">
                            <button type="submit" class="sign-up-form-button">Sign up</button>
                        </div>
                    </form>
                </div>
        </div>

    </div>
</div>

    <div id="login-block" class="login-main">
        <div class="login-wrapper">
            <div class="login-intro">
                <h1 id="login-intro-title" class="intro-title">Let`s do it</h1>

                <div id="login-form-block" class="login-form">
                        <form class="form" action="/login" method="post">
                            <div class="login-input">
                                <input class="form-input" type="text" placeholder="E-mail" name="email">
                            </div>

                            <div class="login-input">
                                <input class="form-input" type="password" placeholder="Password" name="password">
                            </div>

                            <div class="login-input">
                                <button type="submit" class="login-form-button">Log in</button>
                            </div>

                            <br>
                            <br>

                            <div class="login-input">
                                <button id="pass-reset" type="button" class="login-form-button">Reset Password</button>
                            </div>

                            <div class="login-input">
                                <button id="mail-reset" type="button" class="login-form-button">Reset E-mail</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>

<footer>

</footer>
<script src="{{mix('js/main.js')}}"></script>
</body>

</html>

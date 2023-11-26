let $homePage = {};
let $formValidator = $.extend({}, $validator);

$homePage.locations = {
    main: 'main',
    register: 'register',
    login: 'login',
};

$homePage.currentLocation = $homePage.locations.main;

$homePage.main = $('#main');
$homePage.content = $('#content');
$homePage.logo = $('#logo');

$homePage.headerBlock = $('#header-block');
$homePage.headerButtons = $('.buttons');

$homePage.registerBlock = $('#register-block');
$homePage.registerBtn = $('#signup');

$homePage.loginBlock = $('#login-block');
$homePage.loginBtn = $('#login');
$homePage.signUpFormBtn = $('.sign-up-form-button');

$homePage.showRegistrationBlock = function () {

    $homePage.registerBtn.click(function (e) {
        e.preventDefault();
        $formValidator.removeErrorWarnings();

        $homePage.currentLocation = $homePage.locations.register;

        $homePage.registerBlock.css({
            display: 'none',
            height: '50%',
            transform: 'rotateY(180deg)',
        })

        $homePage.headerBlock.css({transform: 'rotateX(360deg)', transition: 'all 1s linear'});
        $homePage.headerButtons.hide();
        $homePage.headerBlock.css({justifyContent: 'center', gap: '20px'});

        $homePage.content.css({transform: 'rotateY(180deg)', transition: 'all 1s linear'});

        setTimeout(function () {
            $homePage.main.hide();
            $homePage.headerBlock.css({transform: '', transition: ''});
        }, 500);

        setTimeout(function () {
            $homePage.registerBlock.css({
                display: 'flex',
                flexDirection: 'column',
                justifyContent: 'center',
                height: '100%',
                alignItems: 'center',
                transition: '2s all ease',
            });
        }, 500);

    })
}

$homePage.showMainBlock = function () {

    $homePage.logo.click(function (e) {
        e.preventDefault();

        if ($homePage.currentLocation !== $homePage.locations.main) {

            $homePage.currentLocation = $homePage.locations.main;

            $homePage.headerBlock.css({transform: 'rotateX(720deg)', transition: 'all 1s linear'});

            $homePage.content.css({transform: 'rotateY(360deg)', transition: 'all 1s linear'});

            setTimeout(function () {
                $homePage.main.show();
                $homePage.headerBlock.css({justifyContent: 'space-between', alignItems: 'center'});
                $homePage.headerBlock.css({transform: '', transition: ''});
                $homePage.headerButtons.css({display: 'flex'});
            }, 500);

            setTimeout(function () {
                $homePage.registerBlock.hide();
                $homePage.loginBlock.hide();
            }, 500);
        }
    });
}

$homePage.showLoginBlock = function () {

    $homePage.loginBtn.click(function (e) {
        e.preventDefault();
        $formValidator.removeErrorWarnings();

        $homePage.currentLocation = $homePage.locations.login;

        $homePage.headerBlock.css({transform: 'rotateX(360deg)', transition: 'all 1s linear'});
        $homePage.headerBlock.css({justifyContent: 'center', gap: '20px'});
        $homePage.headerButtons.hide();

        $homePage.content.css({transform: 'rotateY(180deg)', transition: 'all 1s linear'});

        setTimeout(function () {
            $homePage.main.hide();
            $homePage.headerBlock.css({transform: '', transition: ''});
        }, 500);

        setTimeout(function () {
            $homePage.loginBlock.css({
                display: 'flex',
                flexDirection: 'column',
                justifyContent: 'center',
                height: '100%',
                alignItems: 'center'
            });
        }, 500);

    })
}

$homePage.validationInit = function () {
    $('form').submit(function (e) {
        e.preventDefault();
        $formValidator.attemptToValidate(event.target.action, $(this).serialize(), function () {
            location.reload();
        });
    });
}

$homePage.init = function () {

    $('#pass-reset').click(function () {
        window.location.href = '/reset/password'
    })

    $('#mail-reset').click(function () {
        window.location.href = '/reset/email'
    })

    $homePage.showMainBlock();
    $homePage.showRegistrationBlock();
    $homePage.showLoginBlock();
    $homePage.validationInit();
}

$homePage.init();

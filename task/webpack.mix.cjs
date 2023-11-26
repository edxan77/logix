// webpack.mix.js

let mix = require('laravel-mix');

// mix.js('src/app.js', 'dist').setPublicPath('dist');

mix.scripts([
    'resources/js/jquery.js',
    'resources/js/forms_validation/validator.js',
    'resources/js/home_page/main.js',
], 'public/js/main.js')

mix.scripts([
    'resources/js/jquery.js',
    'resources/js/forms_validation/validator.js',
    'resources/js/reset_page/main.js',
], 'public/js/reset.js')

mix.scripts([
    'resources/js/jquery.js',
    'resources/js/article/main.js',
], 'public/js/article.js')

mix.css('resources/css/home_page/styles.css', 'public/css/app.css')
mix.css('resources/css/bootstrap/bootstrap.css', 'public/css/bootstrap.css')

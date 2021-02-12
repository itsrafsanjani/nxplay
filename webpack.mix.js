const mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */

mix.js('resources/js/app.js', 'public/js/app.js')
    .sass('resources/sass/app.scss', 'public/css/app.css')
    .styles([
        'resources/css/admin.css',
    ], 'public/css/admin.css')
    .styles([
        'resources/css/frontend/main.css',
    ], 'public/css/frontend.css')
    .js([
        'resources/js/admin.js',
    ], 'public/js/admin.js')
    .js([
        'resources/js/frontend/jquery.morelines.min.js',
        'resources/js/frontend/main.js',
    ], 'public/js/frontend.js')
    .sourceMaps();


// 'resources/css/frontend/owl.carousel.min.css',
// 'resources/css/frontend/nouislider.min.css',
// 'resources/css/frontend/plyr.css',
// 'resources/css/frontend/photoswipe.css',
// 'resources/css/frontend/default-skin.css',

// 'resources/js/frontend/owl.carousel.min.js',
// 'resources/js/frontend/wNumb.js',
// 'resources/js/frontend/nouislider.min.js',
// 'resources/js/frontend/photoswipe.min.js',
// 'resources/js/frontend/photoswipe-ui-default.min.js',

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

mix.js('resources/js/app.js', 'public/js')
    .sass('resources/sass/app.scss', 'public/css');
    
mix.copyDirectory('resources/vendor', 'public/vendor');

mix.scripts([
    'node_modules/select2/dist/js/select2.js',
    'node_modules/sweetalert2/dist/sweetalert2.all.min.js',
    'node_modules/toastr/build/toastr.min.js',
    'node_modules/owl.carousel/dist/owl.carousel.min.js',
    ], 'public/js/vender.js');
mix.styles([
    'node_modules/select2/dist/css/select2.css',
    'node_modules/sweetalert2/dist/sweetalert2.min.css',
    'node_modules/toastr/build/toastr.min.css',
    'node_modules/owl.carousel/dist/assets/owl.carousel.min.css',
], 'public/css/vender.css');
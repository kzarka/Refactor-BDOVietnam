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

mix.js('resources/assets/js/app.js', 'public/assets/js')
	.js('resources/assets/admin/games/game.js', 'public/assets/admin/js/games')
    .sass('resources/sass/admin/custom.scss', 'public/assets/admin/css')
    .sass('resources/sass/custom.scss', 'public/assets/css');

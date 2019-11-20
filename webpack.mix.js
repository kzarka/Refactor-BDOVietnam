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
	.js('resources/assets/admin/category/category.js', 'public/assets/admin/js/category')
	.js('resources/assets/admin/validator.js', 'public/assets/admin/js/')
	.js('resources/assets/admin/common.js', 'public/assets/admin/js/')
    .sass('resources/sass/admin/custom.scss', 'public/assets/admin/css')
    .sass('resources/sass/custom.scss', 'public/assets/css');

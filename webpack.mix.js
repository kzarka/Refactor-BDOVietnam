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

mix.js('resources/assets/js/app.js', 'public/js')
    .sass('resources/sass/app.scss', 'public/css');

mix.scripts([
	'node_modules/jquery/dist/jquery.min.js',
    'node_modules/popper.js/dist/umd/popper.min.js',
    'node_modules/bootstrap/dist/js/bootstrap.min.js',
    'node_modules/pace-progress/pace.min.js',
    'node_modules/perfect-scrollbar/dist/perfect-scrollbar.min.js',
    'node_modules/@coreui/coreui/dist/js/coreui.min.js',
    'node_modules/chart.js/dist/Chart.min.js',
    'node_modules/@coreui/coreui-plugin-chartjs-custom-tooltips/dist/js/custom-tooltips.min.js'
],  'public/assets/admin/js/app.js')
.styles([
    'node_modules/@coreui/icons/css/coreui-icons.min.css',
    'node_modules/flag-icon-css/css/flag-icon.min.css',
    'node_modules/simple-line-icons/css/simple-line-icons.css',
    'resources/assets/admin/css/style.css'
],  'public/assets/admin/css/app.css');

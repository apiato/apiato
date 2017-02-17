const { mix } = require('laravel-mix');

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

var styles = [
    /* Fuentes */
    './node_modules/font-awesome/css/font-awesome.min.css',
    './node_modules/ionicons/dist/css/ionicons.min.css',
    /* Animate */
    './node_modules/animate.css/animate.min.css',
    /* AdminLTE */
    './node_modules/admin-lte/dist/css/AdminLTE.min.css',
    './node_modules/admin-lte/dist/css/skins/_all-skins.min.css',
];

var scripts = [
    /* AdminLTE */
    './node_modules/admin-lte/dist/js/app.min.js',
];

mix.js(scripts, 'public/js/plugins.js')
   .js('resources/assets/js/app.js', 'public/js/app.js')
   .sass('resources/assets/sass/app.scss', 'public/css/app.css')
   .combine(styles, 'public/css/plugins.css');

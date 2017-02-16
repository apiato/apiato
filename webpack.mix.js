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
    /* Compiled Bootstrap */
    './public/css/bootstrap.css',
    /* Fuentes */
    './node_modules/font-awesome/css/font-awesome.min.css',
    './node_modules/ionicons/dist/css/ionicons.min.css',
    // /* Animate */
    './node_modules/animate.css/animate.min.css',
    /* AdminLTE */
    './node_modules/admin-lte/dist/css/AdminLTE.min.css',
    './node_modules/admin-lte/dist/css/skins/_all-skins.min.css',
];

var scripts = [
    /* Bootstrap */
    './node_modules/bootstrap-sass/assets/javascripts/bootstrap.min.js',
    /* AdminLTE */
    './node_modules/admin-lte/dist/js/app.min.js',
];

mix.js(scripts, 'public/js/plugins.js')
   .sass('./node_modules/bootstrap-sass/assets/stylesheets/_bootstrap.scss', 'public/css/bootstrap.css')
   .combine(styles, 'public/css/plugins.css');

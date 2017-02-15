const elixir = require('laravel-elixir');

require('laravel-elixir-vue');

/*
 |--------------------------------------------------------------------------
 | Elixir Asset Management
 |--------------------------------------------------------------------------
 |
 | Elixir provides a clean, fluent API for defining some basic Gulp tasks
 | for your Laravel application. By default, we are compiling the Sass
 | file for our application, as well as publishing vendor resources.
 |
 */

var styles = [
    /* Bootstrap */
    './public/plugins/bootstrap/dist/css/bootstrap.min.css',
    /* Select2 */
    './public/plugins/select2/dist/css/select2.min.css',
    /* Bootstrap-Select */
    './public/plugins/bootstrap-select/dist/css/bootstrap-select.min.css',
    /* iCheck */
    './public/plugins/icheck2/square/blue.css',
    './public/plugins/icheck2/square/red.css',
    /* Bootstrap DateRangePicker */
    './public/plugins/bootstrap-daterangepicker/daterangepicker.css',
    /* BootstrapSwitch */
    './public/plugins/bootstrap-switch/dist/css/bootstrap3/bootstrap-switch.min.css',
    /* Bootstrap DateTimePicker */
    './public/plugins/eonasdan-bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.min.css',
    /* Fuentes */
    './public/plugins/fontawesome/css/font-awesome.min.css',
    './public/plugins/ionicons/css/ionicons.min.css',
    /* Animate */
    './public/plugins/animate-css/animate.min.css',
    /* AdminLTE */
    './public/plugins/AdminLTE/dist/css/AdminLTE.min.css',
    './public/plugins/AdminLTE/dist/css/skins/_all-skins.min.css',
];

var scripts = [
    /* jQuery */
    './public/plugins/jquery/dist/jquery.min.js',
    /* Bootstrap */
    './public/plugins/bootstrap/dist/js/bootstrap.min.js',
    /* Metis Menu */
    './public/plugins/metisMenu/dist/metisMenu.min.js',
    /* SlimScroll */
    './public/plugins/slimScroll/jquery.slimscroll.min.js',
    /* FastClick */
    './public/plugins/fastclick/lib/fastclick.js',
    /* Select2 */
    './public/plugins/select2/dist/js/select2.full.min.js',
    './public/plugins/select2/dist/js/i18n/es.js',
    /* Bootstrap-Select */
    './public/plugins/bootstrap-select/dist/js/bootstrap-select.min.js',
    './public/plugins/bootstrap-select/dist/js/i18n/defaults-es_CL.min.js',
    /* iCheck */
    './public/plugins/icheck2/icheck.min.js',
    /* Bootstrap DateRangePicker */
    './public/plugins/moment/min/moment.min.js',
    './public/plugins/bootstrap-daterangepicker/daterangepicker.js',
    /* BootstrapSwitch */
    './public/plugins/bootstrap-switch/dist/js/bootstrap-switch.min.js',
    /* Bootstrap DateTimePicker */
    './public/plugins/moment/min/moment-with-locales.min.js',
    './public/plugins/eonasdan-bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js',
    /* Bootbox */
    './public/plugins/bootbox/bootbox.js',
    /* AdminLTE */
    './public/plugins/AdminLTE/dist/js/app.min.js',
];

var fonts = [
    'public/plugins/fontawesome/fonts/',
    'node_modules/bootstrap-sass/assets/fonts/bootstrap',
    'public/plugins/ionicons/fonts/'
];

var cssCopy = [
    'public/plugins/icheck2/square/blue.png',
    'public/plugins/icheck2/square/red.png'
];

elixir(mix => {
    mix
        .styles(styles, 'public/css/plugins.css')
        .scripts(scripts, 'public/js/plugins.js')
        // .sass('app.scss')
        // .webpack('app.js')
        .copy(fonts, 'public/fonts')
        .copy(cssCopy, 'public/css')
        ;
});

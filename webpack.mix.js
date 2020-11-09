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

mix.sass('resources/sass/back.scss', 'public/assets/css/dev/back.css');
mix.sass('resources/sass/front.scss', 'public/assets/css/dev/front.css');
mix.sass('resources/sass/both.scss', 'public/assets/css/dev/both.css');
mix.sass('resources/sass/app.scss', 'public/assets/css/app.css').version();
mix.sass('resources/sass/recipient.scss', 'public/assets/css/recipient.css').version();

mix.js('resources/js/app.js', 'public/assets/js/app.js').version();
mix.js('resources/js/admin.js', 'public/assets/js/admin.js').version();
mix.js('resources/js/recipient.js', 'public/assets/js/recipient.js').version();

//front all css

mix.styles([
    'public/assets/css/app.css',
    'public/assets/vendors/fontawesome/fontawesome.min.css',
    'public/assets/vendors/tooltip/tooltipster.bundle.min.css',
    'public/assets/vendors/izitoastr/iziToast.min.css',
    'public/assets/vendors/tooltip/tooltipster-sideTip-noir.min.css',
    'public/assets/css/dev/both.css',
    'public/assets/css/dev/front.css'
], 'public/assets/css/style.css').version();

//front all js.
mix.scripts([
    'public/assets/js/app.js',
    'public/assets/vendors/izitoastr/iziToast.min.js',
    'public/assets/vendors/tooltip/tooltipster.bundle.min.js',
    'public/assets/js/dev2/progressive-image.js',
    'public/assets/js/dev/front.js',
    'public/assets/js/dev/both.js'
], 'public/assets/js/script.js').version();


//admin | user panel all css.
mix.styles([
    'public/assets/vendors/base/vendors.bundle.css',
    'public/assets/vendors/base/style.bundle.css',
    'public/assets/vendors/datatable/datatables.min.css',
    'public/assets/vendors/izitoastr/iziToast.min.css',
    'public/assets/vendors/tooltip/tooltipster.bundle.min.css',
    'public/assets/vendors/tooltip/tooltipster-sideTip-noir.min.css',
    'public/assets/css/dev/both.css', 'public/assets/css/dev/back.css'
], 'public/assets/css/all.css').version();

//admin | user all js.
mix.scripts([
    'public/assets/vendors/base/vendors.bundle.js',
    'public/assets/vendors/base/scripts.bundle.js',
    'public/assets/vendors/datatable/datatables.min.js',
    'public/assets/vendors/izitoastr/iziToast.min.js',
    'public/assets/vendors/tooltip/tooltipster.bundle.min.js',
    'public/assets/js/dev2/progressive-image.js',
    'public/assets/js/dev/back.js',
    'public/assets/js/dev/both.js'
], 'public/assets/js/all.js').version();


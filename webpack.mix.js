let mix = require('laravel-mix');

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

mix.js('resources/assets/js/app.js', 'public/js/app.min.js')
  .sass('resources/assets/scss/styles.scss', 'public/css/styles.min.css')
  .sass('resources/assets/vendor/bootstrap/bootstrap.scss', 'public/css/bootstrap.min.css')
  .styles([
    'resources/assets/vendor/css/feather.min.css',
    'resources/assets/vendor/css/iziToast.min.css',
    'resources/assets/vendor/css/pe-icon-7-stroke.min.css',
    'resources/assets/vendor/css/photoswipe.min.css',
    'resources/assets/vendor/css/socicon.min.css',
  ], 'public/css/vendor.min.css')
  .scripts([
    'resources/assets/vendor/js/bootstrap.min.js',
  ], 'public/js/bootstrap.min.js')
  .scripts([
    'resources/assets/vendor/js/popper.min.js',
  ], 'public/js/popper.min.js')
  .scripts([
    'resources/assets/js/scripts.js',
  ], 'public/js/scripts.min.js')
  .scripts([
    'resources/assets/vendor/js/jquery.min.js',
  ], 'public/js/jquery.min.js')
  .scripts([
    'resources/assets/vendor/axios.min.js',
  ], 'public/js/axios.min.js')
  .scripts([
    'resources/assets/vendor/jsmodernizr.min.js',
  ], 'public/js/modernizr.min.js')
  .scripts([
    'resources/assets/vendor/js/downCount.min.js',
    'resources/assets/vendor/js/gmap3.min.js',
    'resources/assets/vendor/js/imagesloaded.pkgd.min.js',
    'resources/assets/vendor/js/isotope.pkgd.min.js',
    'resources/assets/vendor/js/iziToast.min.js',
    'resources/assets/vendor/js/nouislider.min.js',
    'resources/assets/vendor/js/owl.carousel.min.js',
    'resources/assets/vendor/js/photoswipe-ui-default.min.js',
    'resources/assets/vendor/js/photoswipe.min.js',
    'resources/assets/vendor/js/velocity.min.js',
  ], 'public/js/vendor.min.js');
mix.copyDirectory('resources/assets/img', 'public/img')
mix.copyDirectory('resources/assets/fonts', 'public/fonts')
  .options({
    processCssUrls: false
  });


// Admin
mix.styles([
    'resources/assets/admin/css/bootstrap.min.css',
  ], 'public/admin/css/bootstrap.min.css')
  .styles([
    'resources/assets/admin/font-awesome/css/font-awesome.min.css',
  ], 'public/admin/font-awesome/css/font-awesome.min.css')
  .styles([
    'resources/assets/admin/css/animate.css',
  ], 'public/admin/css/animate.min.css')
  .styles([
    'resources/assets/admin/css/style.css',
  ], 'public/admin/css/style.min.css')
  .styles([
    'resources/assets/admin/css/plugins/toastr/toastr.min.css',
    'resources/assets/admin/css/plugins/select2/select2.min.css',
    'resources/assets/admin/css/plugins/select2/select2-bootstrap.css',
    'node_modules/dropzone/dist/dropzone.css',
  ], 'public/admin/css/vendor.min.css')
  .scripts([
    'resources/assets/admin/js/jquery-3.1.1.min.js',
  ], 'public/admin/js/jquery-3.1.1.min.js')
  .scripts([
    'resources/assets/admin/js/bootstrap.min.js',
  ], 'public/admin/js/bootstrap.min.js')
  .scripts([
    'resources/assets/admin/js/plugins/metisMenu/jquery.metisMenu.js',
  ], 'public/admin/js/plugins/metisMenu/jquery.metisMenu.min.js')
  .scripts([
    'resources/assets/admin/js/plugins/slimscroll/jquery.slimscroll.min.js',
  ], 'public/admin/js/plugins/slimscroll/jquery.slimscroll.min.js')
  .scripts([
    'resources/assets/admin/js/inspinia.js',
  ], 'public/admin/js/inspinia.min.js')
  .scripts([
    'resources/assets/admin/js/plugins/pace/pace.min.js',
  ], 'public/admin/js/plugins/pace/pace.min.js')
  .scripts([
    'resources/assets/admin/js/plugins/pace/pace.min.js',
  ], 'public/admin/js/plugins/pace/pace.min.js')
  .scripts([
    'node_modules/dropzone/dist/dropzone.js',
    'resources/assets/admin/js/plugins/select2/select2.full.min.js',
  ], 'public/admin/js/vendor.min.js')
mix.copyDirectory('resources/assets/admin/font-awesome/fonts', 'public/admin/font-awesome/fonts')
mix.copyDirectory('resources/assets/admin/img', 'public/admin/img')
mix.copyDirectory('resources/assets/admin/css/patterns', 'public/admin/css/patterns')
  .options({
    processCssUrls: false
  });

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

/*
.sourceMaps() added to avoid next error on console:

Source map error: request failed with status 404
Resource URL: http://mbook.test/js/app.js
Source Map URL: bootstrap.js.map

jimezam. 20181030.
*/

mix.js('resources/js/app.js', 'public/js')
   .sourceMaps()
   .sass('resources/sass/app.scss', 'public/css');

mix.js('vendor/tinymce/tinymce/tinymce.min.js', 'public/js/tinymce');
mix.copy('vendor/tinymce/tinymce/themes', 'public/js/tinymce/themes');
mix.copy('vendor/tinymce/tinymce/skins', 'public/js/tinymce/skins');
mix.copy('vendor/tinymce/tinymce/plugins', 'public/js/tinymce/plugins');
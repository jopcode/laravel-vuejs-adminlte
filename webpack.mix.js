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

// ADMIN
mix.js('resources/assets/js/admin/admin.js', 'public/js')
   	.sass('resources/assets/sass/admin/admin.scss', 'public/css')
   	.sourceMaps();

// FRONT
mix.js('resources/assets/js/front/front.js', 'public/js')
   	.sass('resources/assets/sass/front/front.scss', 'public/css')
   	.sourceMaps();


if (mix.inProduction()) {
    mix.version();
}
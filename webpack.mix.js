const mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel applications. By default, we are compiling the CSS
 | file for the application as well as bundling up all the JS files.
 |
 */


mix.copyDirectory('resources/fonts', 'public/css/fonts');

mix.styles([
    'resources/css/backend/dashlite.css',
    'resources/css/backend/jquery.minicolors.css',
    'resources/css/backend/custom.css',
], 'public/css/backend/dashlite_style.css');
mix.styles([
    'resources/css/frontend/project_styles.css',
], 'public/css/frontend/project_styles_css.css');

mix.scripts([
    'resources/js/backend/nioapp.min.js',
    'resources/js/backend/scripts.js',
    'resources/js/backend/custom.js',
], 'public/js/backend/theme.js');

mix.scripts([
        'resources/js/backend/FontPicker.js',
        'resources/js/backend/jquery.minicolors.js'
    ],
    'public/js/backend/FontPicker.js');


if (mix.inProduction()) {
    mix.version();
}

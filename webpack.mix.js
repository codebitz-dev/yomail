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



mix.js('resources/js/yomail.js', 'public').vue({ version: 2 })
    .postCss('resources/css/yomail.css', 'public', [
        require("tailwindcss"),
    ]);

mix.copy('public/yomail.js', '../../../public/vendor/yomail/yomail.js');
mix.copy('public/yomail.css', '../../../public/vendor/yomail/yomail.css');



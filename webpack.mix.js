let mix = require('laravel-mix');

mix
    .setPublicPath('dist')
    .sass('resources/scss/app.scss', 'dist/css')

    .postCss('resources/scss/admin.css', 'dist/css/admin', [
        require("tailwindcss"),
    ])
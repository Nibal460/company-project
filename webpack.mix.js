const mix = require('laravel-mix');
const path = require('path');
require('laravel-mix-vue3');

mix.js('resources/js/app.js', 'public/js')
   .vue() // Add this line to handle Vue files
   .sass('resources/sass/app.scss', 'public/css')
   .css('resources/css/app2.css', 'public/css')
   .sourceMaps();

mix.webpackConfig({
    resolve: {
        alias: {
            '@': path.resolve('resources/js'),
        },
    },
    module: {
        rules: [
            {
                test: /\.vue$/,
                loader: 'vue-loader'
            },
        ],
    },
});


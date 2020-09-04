const mix = require('laravel-mix');
let ImageminPlugin = require( 'imagemin-webpack-plugin' ).default;
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

mix.webpackConfig({
    plugins:[
        new ImageminPlugin({
            pngquant:{
                quality: "95-100",
            },
            test: /\.(jpe?g|png|gif|svg)$/i,
        })
    ]
})

mix.js('resources/js/app/*.js', 'public/js/app')
    .js('resources/js/app.js', 'public/js')
    //.css('resources/css/funcs.sss', 'public/css') no va!
    .sass('resources/sass/app.scss', 'public/css');

mix.copy( 'resources/assets/images', 'public/assets/images', false );

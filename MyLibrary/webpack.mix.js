const {mix} = require('laravel-mix');

const path = require('path');
/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for your application, as well as bundling up your JS files.
 |
 */
let networkInterfaces = require('os').networkInterfaces(), IPv4;
let $assets_path = 'resources/vue/';

if (networkInterfaces.en0) {
    for (i of networkInterfaces.en0) {
        if (i.family == 'IPv4') IPv4 = i.address;
    }
} else {
    IPv4 = '127.0.0.1';
}

mix
    .setPublicPath('public')
    .js($assets_path + 'app.js', 'vue/js')
    .sass($assets_path + 'assets/scss/app.scss', 'vue/css')
    .extract([
        'vue',
        'vue-router',
        // 'vuex',
        'axios'
    ])
    .webpackConfig({
        output: {
            publicPath: process.argv.includes('--hot') ? 'http://' + IPv4 + ':8080/' : '',
            // chunkFilename: 'vue/chunk/[name].js'
        },
        resolve: {
            alias: {
                '/api': path.resolve(__dirname, $assets_path + 'api'),
                '/assets': path.resolve(__dirname, $assets_path + 'assets'),
                '/components': path.resolve(__dirname, $assets_path + 'components'),
                '/config': path.resolve(__dirname, $assets_path + 'config'),
                '/modules': path.resolve(__dirname, $assets_path + 'modules'),
                '/directives': path.resolve(__dirname, $assets_path + 'directives'),

                'axios': 'axios/dist/axios.min.js',
            },
        },
        devServer: {
            host: '0.0.0.0',
        },
    })
    .sourceMaps()
    .options({
        postCss: [
            require('autoprefixer')({
                browsers: [
                    'last 4 versions',
                ]
            })
        ]
    });

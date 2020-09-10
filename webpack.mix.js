const mix = require('laravel-mix');
const WebpackShellPlugin = require('webpack-shell-plugin');

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

mix.webpackConfig({
    resolve: {
        extensions: ['.js', '.json', '.vue'],
        alias: {
            '~': path.join(__dirname, './resources/js')
        }
    }
}).js('resources/js/app.js', 'public/js')
    .sass('resources/sass/app.scss', 'public/css');


if (mix.inProduction()) {

    mix.webpackConfig({
        plugins: [
            new WebpackShellPlugin({
                onBuildStart: ['php artisan fixer:fix --path app'],
                onBuildEnd: []
            }),
        ],
    });

    mix.version();
}

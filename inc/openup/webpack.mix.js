const mix = require('laravel-mix');
const { CleanWebpackPlugin } = require('clean-webpack-plugin');

//need to rename local-example.json to local.json and set local url
const local = 'http://openup/';

const sassDir = 'src/scss/';
const jsDir = 'src/js/';

mix.setPublicPath('./dist');

mix.options({
    //remove generating license
    terser: {
        extractComments: false,
    },
    processCssUrls: false,
    purifyCss: false,
    postCss: [
        require('autoprefixer')({
            grid: true,
        }),
    ]
});

mix.browserSync({
    proxy: local,
    injectChanges: true,
    port: 8001,
    files: [
        './dist/css/*.css', 
        './dist/js/*.js'
    ],
    open: false
});


mix.sass(sassDir + '/style.scss', 'css')
    .js(jsDir + 'app.js', 'js').sourceMaps();

//example for adding additional js file
/* mix.js(jsDir + 'separateScriptExample.js', 'js')
    .version(); */
    
mix.version();


mix.webpackConfig({
    //latest versions of swiper doesn't support module import, and show errors in ie 11
    resolve: {
        alias: {
            'swiper$': path.resolve(__dirname, 'node_modules/swiper/js/swiper.js'),
        }
    },
    plugins: [
        new CleanWebpackPlugin()
    ],
});

if (mix.inProduction()) {
    mix.sourceMaps();
}
const mix = require('laravel-mix');

mix.webpackConfig(webpack => {
   return {
       output: {
           publicPath: '/',
           chunkFilename: '[name].js',
       },
   };
});

mix.js('resources/js/app.js', 'public/js')
   .sass('resources/sass/app.scss', 'public/css');

mix.options({
    processCssUrls: true, // Process/optimize relative stylesheet url()'s. Set to false, if you don't want them touched.
});
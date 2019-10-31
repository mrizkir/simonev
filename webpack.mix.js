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

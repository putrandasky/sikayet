const mix = require('laravel-mix');
require('laravel-mix-alias');

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
  resolve: {
    extensions: ['.js', '.vue', '.json'],
    alias: {
      '@': __dirname + '/resources/js'
    },
  },
})
mix.js('resources/js/website/app.js', 'public/js')
  .vue()
  .sass('resources/sass/app.scss', 'public/css');
mix.js('resources/js/admin/app.js', 'public/js/app-admin.js')
  .vue();

if (mix.inProduction()) {
  mix.version();
  // mix.options({
  //   terser: {
  //     terserOptions: {
  //       compress: {
  //         drop_console: true
  //       }
  //     }
  //   }
  // });
}

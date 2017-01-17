const elixir = require('laravel-elixir');

require('laravel-elixir-vue-2');

/*
 |--------------------------------------------------------------------------
 | Elixir Asset Management
 |--------------------------------------------------------------------------
 |
 | Elixir provides a clean, fluent API for defining some basic Gulp tasks
 | for your Laravel application. By default, we are compiling the Sass
 | file for our application, as well as publishing vendor resources.
 |
 */
elixir.config.sourcemaps = false;

elixir(mix => {
  mix.sass('app.scss')

  mix.webpack('app.js')

  mix.styles([
    'css/app.css',
    'vendors/prism/prism.css'
  ], './public/css/all.css', './public')

  mix.scripts([
    'js/app.js',
    'vendors/clipboard.js/clipboard.js',
    'vendors/prism/prism.js',
    'vendors/matchHeight.min.js'
  ], './public/js/all.js', './public')
});

var elixir = require('laravel-elixir');
require('laravel-elixir-stylus');

elixir(function(mix) {
  // mix.browserSync({
  //     proxy: "mt.dev"
  //   })
  mix
    .stylus('app.styl')
    .stylus('admin.styl')
    .scripts('app.js')
    .scripts('admin.js');
});

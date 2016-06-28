var elixir = require('laravel-elixir');

require('laravel-elixir-stylus');

elixir(function(mix) {
   mix.stylus('app.styl')
      .browserify('app.js');
});

elixir(function(mix) {
   mix.stylus('admin.styl')
      .browserify('admin.js');
});

elixir(function(mix) {
   mix.stylus('admin.styl');
});

var elixir = require('laravel-elixir');

elixir(function(mix) {

    mix.less('home.less');

    mix.scripts([
        'node_modules/jquery/dist/jquery.js',
    ], 'public/js/home.js', './');

    mix.copy('node_modules/bootstrap/fonts', 'public/fonts');

    mix.version(['css/home.css', 'js/home.js']);
});

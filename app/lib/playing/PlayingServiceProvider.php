<?php namespace lib\playing;


use Illuminate\Support\ServiceProvider;

class PlayingServiceProvider extends ServiceProvider {

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bindShared('playing', function($app) {
            $arrays = $this->app->make('lib\arrays\Arrays');
            return new Playing($app['files'], $arrays);
        });
    }
}
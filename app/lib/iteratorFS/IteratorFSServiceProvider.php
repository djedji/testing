<?php namespace lib\iteratorFS;


use Illuminate\Support\ServiceProvider;

class IteratorFSServiceProvider extends ServiceProvider {

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->register_iteratorFS();
    }

    public function register_iteratorFS() {
        $this->app->bindShared('iteratorFS', function($app) {
            $fs = $this->app->make('lib\iteratorFS\FS');
            $parser = $this->app->make('lib\iteratorFS\Parser');
            return new IteratorFS($fs, $parser);
        });
    }
}
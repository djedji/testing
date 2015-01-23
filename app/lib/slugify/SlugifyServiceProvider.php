<?php namespace lib\slugify;


use Illuminate\Support\ServiceProvider;

class SlugifyServiceProvider extends ServiceProvider {

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->register_slugify();
    }

    private function register_slugify() {
        $this->app->bindShared('slugify', function() {
            return new Slugify();
        });
    }
}
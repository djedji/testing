<?php namespace lib\arrays;


use Illuminate\Support\ServiceProvider;

class ArraysServiceProvider extends ServiceProvider {

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bindShared('arrays', function() {
            return new Arrays();
        });
    }
}
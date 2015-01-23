<?php namespace lib\autoloadFS;


use Illuminate\Support\ServiceProvider;

class AutoloadFSServiceProvider extends ServiceProvider {

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bindShared('autoloadFS', function() {
            $iteratorfs = $this->app->make('lib\iteratorFS\IteratorFS');
            $loaderHtml = $this->app->make('lib\autoloadFS\LoaderHtml');
            return new AutoloadFS($iteratorfs, $loaderHtml);
        });
    }
}
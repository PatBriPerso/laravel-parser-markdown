<?php namespace ViKon\ParserMarkdown;

use Illuminate\Support\ServiceProvider;

class ParserMarkdownServiceProvider extends ServiceProvider {

    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides() {
        return [];
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register() {
        //
    }

}

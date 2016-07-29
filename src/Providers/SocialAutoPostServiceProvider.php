<?php

namespace Edujugon\SocialAutoPost\Providers;

use Edujugon\SocialAutoPost\SocialAutoPost;
use Illuminate\Support\ServiceProvider;

class SocialAutoPostServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $config_path = function_exists('config_path') ? config_path('socialAutoPost.php') : 'socialAutoPost.php';

        $this->publishes([ __DIR__.'/../Config/Config.php' => $config_path ], 'config');
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app['socialAutoPost'] = $this->app->share(function($app)
        {
            return new SocialAutoPost();
        });
    }
}

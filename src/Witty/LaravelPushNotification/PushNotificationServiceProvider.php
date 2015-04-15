<?php namespace Witty\LaravelPushNotification;

use Illuminate\Support\ServiceProvider;

class PushNotificationServiceProvider extends ServiceProvider {

    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    /**
     * Bootstrap the application events.
     *
     * @return void
     */
    public function boot()
    {
    	$this->app->bind(
            'Witty\LaravelPushNotification\PushNotificationBuilder',
            'Witty\LaravelPushNotification\PushNotifier'
        );

        $this->publishes([
        	__DIR__ . '/../../config/config.php' 					=> config_path('pushnotification.php'),
        	__DIR__ . '/../../config/ios-certificates/development'  => config_path('ios-push-nofitication-certificates/development'),
        	__DIR__ . '/../../config/ios-certificates/production' 	=> config_path('ios-push-nofitication-certificates/production')
    	]);
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app['pushNotification'] = $this->app->share(function($app)
        {
            return new PushNotificationBuilder;
        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return array();
    }

}
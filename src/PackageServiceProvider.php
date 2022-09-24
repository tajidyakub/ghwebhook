<?php

namespace Tj\Ghwebhook;

use Illuminate\Routing\Router;
use Illuminate\Support\ServiceProvider;

class PackageServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->mergeConfigFrom(__DIR__.'/../config/config.php', 'ghwebhook');

        if (!config('ghwebhook.enabled')) {
            return 1;
        }
        $this->app->singleton(\Tj\Ghwebhook\Webhook::class, function ($app) {
            return new \Tj\Ghwebhook\Webhook(request());
        });
    }

    public function boot()
    {
        $this->registerRoutes();

        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__.'/../config/config.php' => config_path('ghwebhook.php'),
            ], 'config');
        }
    }

    /**
     * Register routes definition in `../routes/web.php`
     */
    protected function registerRoutes()
    {
        $router = $this->app->make(Router::class);

        $router->aliasMiddleware('ghwebhook.verify.signature', \Tj\Ghwebhook\Http\VerifySignatureMiddleware::class);

        $router->aliasMiddleware('ghwebhook.log.request', \Tj\Ghwebhook\Http\LogIncomingRequestMiddleware::class);

        $this->loadRoutesFrom(__DIR__.'/../routes/web.php');
    }
}

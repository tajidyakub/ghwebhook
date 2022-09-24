<?php
namespace Tj\Ghwebhook;

use Illuminate\Http\Request;
use Illuminate\Support\ServiceProvider;

class PackageServiceProvider extends ServiceProvider
{

    public function register()
    {
        $this->mergeConfigFrom(__DIR__.'/../config/config.php', 'ghwebhook');

        $this->app->singleton(\Tj\Ghwebhook\Webhook::class, function ($app, Request $request) {
            $app->make(\Tj\Ghwebhook\Webhook::class, ['request' => $request]);
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

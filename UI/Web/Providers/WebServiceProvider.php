<?php

declare(strict_types=1);

namespace UI\Web\Providers;

use Illuminate\Support\ServiceProvider;
use UI\Web\Services\HttpRequest\HttpRequestContract;
use UI\Web\Services\HttpRequest\LaravelRequestImpl;

class WebServiceProvider extends ServiceProvider
{
    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadRoutesFrom(__DIR__.'/../routes.php');

         $this->loadViewsFrom(__DIR__.'/../Resources/views', 'web');

        // $this->loadViewComponentsAs('order', [
        //     Alert::class,
        //     Button::class,
        // ]);
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        // $this->mergeConfigFrom(__DIR__.'/../config/order.php', 'order');
        $this->app->bind(HttpRequestContract::class, LaravelRequestImpl::class);
    }
}

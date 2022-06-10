<?php

declare(strict_types=1);

namespace UI\Admin\Providers;

use Illuminate\Support\ServiceProvider;
use UI\Admin\Services\HttpRequest\HttpRequestContract;
use UI\Admin\Services\HttpRequest\LaravelRequestImpl;

class AdminServiceProvider extends ServiceProvider
{
    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadRoutesFrom(__DIR__.'/../routes.php');

         $this->loadViewsFrom(__DIR__.'/../Resources/views', 'admin');

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

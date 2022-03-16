<?php

namespace Modules\Product\app\Providers;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

class ProductServiceProvider extends ServiceProvider
{
    protected $productNamspass = "Modules\Product\app\Http\Controllers";
    protected $webRoute       = "Modules/Product/routes/web.php";

    public function boot()
    {
        $this->registerRoutes();
        $this->registerMigrations();
        $this->registerViews();
    }

    protected function registerRoutes()
    {
        Route::prefix('dashboard')
            ->middleware('web')
            ->namespace($this->productNamspass)
            ->group(base_path($this->webRoute));
    }

    protected function registerMigrations()
    {
        $this->loadMigrationsFrom(__DIR__ . '/../../database/migrations');
    }

    protected function registerViews()
    {
        $this->loadViewsFrom(__DIR__ . '/../../views','Product');
    }
}
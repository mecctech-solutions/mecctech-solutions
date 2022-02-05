<?php


namespace App\PortfolioManagement\Infrastructure\Providers;

use HomeDesignShops\LaravelDdd\BaseModuleServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Route;

class PortfolioManagementServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {

    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPortfolioManagementRoutes();
        $this->registerDoctrineEntityManager();
    }

    /**
     * Registers the portfoliomanagement routes
     */
    protected function registerPortfolioManagementRoutes(): void
    {
        Route::prefix('portfoliomanagement')
            ->middleware('web')
            ->namespace('App\\PortfolioManagement\\Presentation\\Http')
            ->group(__DIR__ . '/../../Presentation/Http/Routes/web.php');

        Route::prefix('api/portfoliomanagement')
            ->middleware('api')
            ->namespace('App\\PortfolioManagement\\Presentation\\Http')
            ->group(__DIR__ . '/../../Presentation/Http/Routes/api.php');
    }

}

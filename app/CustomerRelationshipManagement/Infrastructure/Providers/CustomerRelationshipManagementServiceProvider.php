<?php


namespace App\CustomerRelationshipManagement\Infrastructure\Providers;

use HomeDesignShops\LaravelDdd\BaseModuleServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Route;

class CustomerRelationshipManagementServiceProvider extends ServiceProvider
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
        $this->registerCustomerRelationshipManagementRoutes();
        $this->registerDoctrineEntityManager();
    }

    /**
     * Registers the customerrelationshipmanagement routes
     */
    protected function registerCustomerRelationshipManagementRoutes(): void
    {
        Route::prefix('customerrelationshipmanagement')
            ->middleware('web')
            ->namespace('App\\CustomerRelationshipManagement\\Presentation\\Http')
            ->group(__DIR__ . '/../../Presentation/Http/Routes/web.php');

        Route::prefix('api/customerrelationshipmanagement')
            ->middleware('api')
            ->namespace('App\\CustomerRelationshipManagement\\Presentation\\Http')
            ->group(__DIR__ . '/../../Presentation/Http/Routes/api.php');
    }

}

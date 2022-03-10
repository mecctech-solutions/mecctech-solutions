<?php


namespace App\CustomerRelationshipManagement\Infrastructure\Providers;

use App\CustomerRelationshipManagement\Domain\Repositories\CustomerRepositoryInterface;
use App\CustomerRelationshipManagement\Domain\Services\NotificationSenderServiceInterface;
use App\CustomerRelationshipManagement\Infrastructure\Persistence\Eloquent\Repositories\EloquentCustomerRepository;
use App\CustomerRelationshipManagement\Infrastructure\Services\EmailNotificationSenderService;
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
        $this->app->bind(CustomerRepositoryInterface::class, EloquentCustomerRepository::class);
        $this->app->bind(NotificationSenderServiceInterface::class, EmailNotificationSenderService::class);
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

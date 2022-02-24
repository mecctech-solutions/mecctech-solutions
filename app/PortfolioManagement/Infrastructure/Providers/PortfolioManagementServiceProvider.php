<?php


namespace App\PortfolioManagement\Infrastructure\Providers;

use App\PortfolioManagement\Domain\PortfolioItems\PortfolioItem;
use App\PortfolioManagement\Domain\Repositories\PortfolioItemRepositoryInterface;
use App\PortfolioManagement\Domain\Services\PortfolioManagementServiceInterface;
use App\PortfolioManagement\Infrastructure\Persistence\Eloquent\PortfolioItems\Repositories\EloquentPortfolioItemRepository;
use App\PortfolioManagement\Infrastructure\Services\PortfolioManagementService;
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
        $this->app->bind(PortfolioItemRepositoryInterface::class, EloquentPortfolioItemRepository::class);
        $this->app->bind(PortfolioManagementServiceInterface::class, PortfolioManagementService::class);
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

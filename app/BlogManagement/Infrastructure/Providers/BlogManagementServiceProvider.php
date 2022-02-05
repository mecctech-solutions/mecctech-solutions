<?php


namespace App\BlogManagement\Infrastructure\Providers;

use HomeDesignShops\LaravelDdd\BaseModuleServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Route;

class BlogManagementServiceProvider extends ServiceProvider
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
        $this->registerBlogManagementRoutes();
        $this->registerDoctrineEntityManager();
    }

    /**
     * Registers the blogmanagement routes
     */
    protected function registerBlogManagementRoutes(): void
    {
        Route::prefix('blogmanagement')
            ->middleware('web')
            ->namespace('App\\BlogManagement\\Presentation\\Http')
            ->group(__DIR__ . '/../../Presentation/Http/Routes/web.php');

        Route::prefix('api/blogmanagement')
            ->middleware('api')
            ->namespace('App\\BlogManagement\\Presentation\\Http')
            ->group(__DIR__ . '/../../Presentation/Http/Routes/api.php');
    }

}

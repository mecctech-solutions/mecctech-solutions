<?php


namespace App\Contacts\Infrastructure\Providers;

use HomeDesignShops\LaravelDdd\BaseModuleServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Route;

class ContactsServiceProvider extends ServiceProvider
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
        $this->registerContactsRoutes();
        $this->registerDoctrineEntityManager();
    }

    /**
     * Registers the contacts routes
     */
    protected function registerContactsRoutes(): void
    {
        Route::prefix('contacts')
            ->middleware('web')
            ->namespace('App\\Contacts\\Presentation\\Http')
            ->group(__DIR__ . '/../../Presentation/Http/Routes/web.php');

        Route::prefix('api/contacts')
            ->middleware('api')
            ->namespace('App\\Contacts\\Presentation\\Http')
            ->group(__DIR__ . '/../../Presentation/Http/Routes/api.php');
    }

}

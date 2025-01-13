<?php

namespace App\Providers;

use App\BlogManagement\Domain\Repositories\BlogManagementRepositoryInterface;
use App\BlogManagement\Infrastructure\Repositories\EloquentBlogManagementRepository;
use App\CustomerRelationshipManagement\Domain\Repositories\CustomerRepositoryInterface;
use App\CustomerRelationshipManagement\Domain\Services\NotificationSenderServiceInterface;
use App\CustomerRelationshipManagement\Infrastructure\Persistence\Eloquent\Repositories\EloquentCustomerRepository;
use App\CustomerRelationshipManagement\Infrastructure\Services\EmailNotificationSenderService;
use App\PortfolioManagement\Domain\Repositories\PortfolioItemRepositoryInterface;
use App\PortfolioManagement\Domain\Services\PortfolioManagementServiceInterface;
use App\PortfolioManagement\Infrastructure\Persistence\Eloquent\Repositories\EloquentPortfolioItemRepository;
use App\PortfolioManagement\Infrastructure\Services\PortfolioManagementService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(CustomerRepositoryInterface::class, EloquentCustomerRepository::class);
        $this->app->bind(BlogManagementRepositoryInterface::class, EloquentBlogManagementRepository::class);
        $this->app->bind(NotificationSenderServiceInterface::class, EmailNotificationSenderService::class);
        $this->app->bind(PortfolioManagementServiceInterface::class, PortfolioManagementService::class);
        $this->app->bind(PortfolioItemRepositoryInterface::class, EloquentPortfolioItemRepository::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}

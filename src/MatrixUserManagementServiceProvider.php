<?php
namespace Mukul\Matrixusermanagement;

use Illuminate\Support\ServiceProvider;
use Mukul\Matrixusermanagement\Contracts\CompanyContract;
use Mukul\Matrixusermanagement\Repositories\CompanyRepository;

class MatrixUserManagementServiceProvider extends ServiceProvider
{
    protected $repositories = [
        CompanyContract::class => CompanyRepository::class,
    ];

    public function boot()
    {
        $this->loadRoutesFrom(__DIR__.'/routes/web.php');
        $this->loadViewsFrom(__DIR__.'/views', 'matrixusermanagement');
        $this->loadMigrationsFrom(__DIR__.'/database/migrations');

        $this->mergeConfigFrom(
            __DIR__.'/config/matrixusermanagement.php', 'matrixusermanagement'
        );

        $this->publishes([
            __DIR__.'/config/matrixusermanagement.php' => config_path('matrixusermanagement.php'),
        ]);

        $this->loadTranslationsFrom(__DIR__.'/translations', 'matrixusermanagement');
        $this->publishes([
            __DIR__.'/translations' => resource_path('lang/vendor/matrixusermanagement'),
        ]);
    }

    public function register()
    {
        foreach ($this->repositories as $interface => $implementation) {
            $this->app->bind($interface, $implementation);
        }
    }
}

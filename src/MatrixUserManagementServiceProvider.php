<?php
namespace Mukul\Matrixusermanagement;

use Illuminate\Support\ServiceProvider;
use Mukul\Matrixusermanagement\Contracts\BranchContract;
use Mukul\Matrixusermanagement\Contracts\CompanyContract;
use Mukul\Matrixusermanagement\Contracts\DepartmentContract;
use Mukul\Matrixusermanagement\Contracts\DesignationContract;
use Mukul\Matrixusermanagement\Contracts\MenuContract;
use Mukul\Matrixusermanagement\Contracts\ModuleContract;
use Mukul\Matrixusermanagement\Contracts\RoleContract;
use Mukul\Matrixusermanagement\Repositories\BranchRepository;
use Mukul\Matrixusermanagement\Repositories\CompanyRepository;
use Mukul\Matrixusermanagement\Repositories\DepartmentRepository;
use Mukul\Matrixusermanagement\Repositories\DesignationRepository;
use Mukul\Matrixusermanagement\Repositories\MenuRepository;
use Mukul\Matrixusermanagement\Repositories\ModuleRepository;
use Mukul\Matrixusermanagement\Repositories\RoleRepository;

class MatrixUserManagementServiceProvider extends ServiceProvider
{
    protected $repositories = [
        CompanyContract::class => CompanyRepository::class,
        BranchContract::class => BranchRepository::class,
        DepartmentContract::class => DepartmentRepository::class,
        DesignationContract::class => DesignationRepository::class,
        ModuleContract::class => ModuleRepository::class,
        MenuContract::class => MenuRepository::class,
        RoleContract::class => RoleRepository::class,
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
    }

    public function register()
    {
        foreach ($this->repositories as $interface => $implementation) {
            $this->app->bind($interface, $implementation);
        }
    }
}

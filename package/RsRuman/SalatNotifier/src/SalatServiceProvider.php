<?php
namespace RsRuman\SalatNotifier;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Support\ServiceProvider;
use RsRuman\SalatNotifier\Commands\SalatNotify;
use RsRuman\SalatNotifier\Commands\UpdateOrCreateSalatTime;
use RsRuman\SalatNotifier\Interfaces\SalatTimeInterface;
use RsRuman\SalatNotifier\Repositories\SalatTimeRepository;

class SalatServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        if ($this->app->runningInConsole()) {
            $this->registerCommands();
        }

        $this->app->bind(SalatTimeInterface::class, SalatTimeRepository::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        $this->callAfterResolving(Schedule::class, function (Schedule $schedule) {
            $schedule->command('salat:notify')->everyMinute();
        });

        $this->loadMigrationsFrom(__DIR__ . '/Database/Migrations');
    }

    public function registerCommands(): void
    {
        $this->commands([
            SalatNotify::class,
            UpdateOrCreateSalatTime::class
        ]);
    }
}

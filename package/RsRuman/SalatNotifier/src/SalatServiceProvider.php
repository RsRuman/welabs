<?php
namespace RsRuman\SalatNotifier;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Support\ServiceProvider;
use RsRuman\SalatNotifier\Commands\SalatNotify;

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
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        $this->callAfterResolving(Schedule::class, function (Schedule $schedule) {
            $schedule->command('salat:notify')->everyMinute();
        });
    }

    public function registerCommands(): void
    {
        $this->commands([
            SalatNotify::class
        ]);
    }
}

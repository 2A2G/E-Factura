<?php
namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Registra los comandos artisan disponibles.
     */
    protected $commands = [
        // Puedes registrar comandos personalizados aquí
    ];

    /**
     * Define la programación de tareas.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->job(new \App\Jobs\SendFactureDian(app(\App\Services\ExternalApiService::class)))
            ->onQueue('default')
            ->withoutOverlapping()
            ->timeout(180);
    }


    /**
     * Registra los comandos de consola para la aplicación.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__ . '/Commands');
        require base_path('routes/console.php');
    }
}

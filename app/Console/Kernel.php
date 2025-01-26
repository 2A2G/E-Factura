<?php
namespace App\Console;

use App\Jobs\SendFactureDian;
use Illuminate\Console\Scheduling\Schedule;
use App\Services\ExternalApiService;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Illuminate\Support\Facades\Log;

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
        $schedule->call(function () {
            Log::info('Despachando job SendFactureDian');
            dispatch(new SendFactureDian(app(ExternalApiService::class)));

            Log::info('Job SendFactureDian despachado');
        })->everyTwoMinutes();

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

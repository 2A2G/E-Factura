<?php
namespace App\Console;

use Illuminate\Support\Facades\Artisan; // Importar Artisan
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use App\Jobs\SendFactureDian;
use App\Services\ExternalApiService;

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
    public function schedule(Schedule $schedule)
    {
        $schedule->timezone('America/Bogota');

        $schedule->call(function () {
            Artisan::call('queue:clear', ['--queue' => 'default']);
        })->withoutOverlapping()->runInBackground();

        $schedule->call(function () {
            dispatch(new SendFactureDian(app(ExternalApiService::class)));
        })->withoutOverlapping()->runInBackground();
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

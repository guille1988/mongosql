<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class ClearLogCommand extends Command
{
    protected $signature = 'clear:log';
    protected $description = "Clear the projects log file";

    public function checkIfSaved($file)
    {
        file_put_contents($file, '') === false ?
          $this->components->error("Something went wrong and the log file was not cleared") :
          $this->components->task('log');
    }

    public function handle()
    {
        $logFilePath = storage_path('logs/laravel.log');

        file_exists($logFilePath) ?
          $this->checkIfSaved($logFilePath) :
          $this->components->error("The laravel.log file doesn't exist");
    }
}

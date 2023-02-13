<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class ClearLogCommand extends Command
{
  protected $signature = 'clear:log';
  protected $description = 'Clears the project\'s log file';

  public function makeCommand()
  {
    $logFilePath = storage_path('logs/laravel.log');

    file_exists($logFilePath) ? 
      $this->checkIfSaved($logFilePath) :
      $this->showMessage('The laravel.log file doesn\'t exist!', 'error');
  }

  public function checkIfSaved($file)
  {
    file_put_contents($file, '') === false ? 
      $this->showMessage('Something went wrong and the log file was not cleared.', 'error') :
      $this->showMessage('Log file cleared succesfully!', 'info');
  }

  public function showMessage($message, $type)
  {
    $this->line(PHP_EOL);

    $this->$type($message);

    $this->line(PHP_EOL);
  }

  public function handle()
  {
    $this->makeCommand();
  }
}

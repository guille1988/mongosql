<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class ClearAllCommand extends Command
{
  protected $signature = 'clear:all';
  protected $description = 'Clear the app\'s cache and the log file by executing the optimize:clear and the clear:log commands';

  public function runCommands()
  {
    $this->call('optimize:clear');
    $this->call('clear:log');
  }

  public function handle()
  {
    $this->runCommands();
  }
}

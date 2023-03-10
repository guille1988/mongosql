<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class ClearAllCommand extends Command
{
    protected $signature = 'clear:all';
    protected $description = 'Clear the app\'s cache and the log file by executing the optimize:clear and the clear:log commands';

    public function handle()
    {
        $this->call('optimize:clear');
        $this->call('clear:log');
        echo PHP_EOL;
        $this->components->info('Clear all command successfully made');
    }
}

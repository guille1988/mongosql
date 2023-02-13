<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

abstract class BaseSeeder extends Seeder
{
    private string $interface;

    public function __construct()
    {
        $class = ucfirst(str_replace('Seeder', '', class_basename($this)));
        $this->interface = "App\Repositories\Interfaces\\$class" . 'RepositoryInterface';
    }

    public function run(int $quantity)
    {
        if(!app()->isProduction())
            collect(range(1,$quantity))->map(fn() => app($this->interface)->create($this->data()));
    }

    abstract public function data(): array;
}

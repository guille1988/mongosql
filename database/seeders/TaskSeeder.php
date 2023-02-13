<?php

namespace Database\Seeders;

class TaskSeeder extends BaseSeeder
{
    public function data(): array
    {
        $name = fake()->word;
        $duration = rand(0,20);
        $is_critical = fake()->boolean;

        return compact(['name', 'duration', 'is_critical']);
    }
}

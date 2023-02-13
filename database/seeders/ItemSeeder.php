<?php

namespace Database\Seeders;

use Carbon\Carbon;

class ItemSeeder extends BaseSeeder
{
    public function data(): array
    {
        $name = fake()->word;
        $description = fake()->realText(100);
        $expiration = Carbon::now()->addDays(rand(1,15));

        return compact(['name', 'description', 'expiration']);
    }
}

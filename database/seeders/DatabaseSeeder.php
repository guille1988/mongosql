<?php

namespace Database\Seeders;

use App\Repositories\Interfaces\ItemRepositoryInterface;
use App\Repositories\Interfaces\TaskRepositoryInterface;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    private int $quantity = 25;

    private array $seeders = [
        TaskSeeder::class,
        PostSeeder::class,
        ItemSeeder::class,
        UserSeeder::class
    ];
    public function run(): void
    {
        collect($this->seeders)
            ->map(fn($seeder) => $this->call(class: $seeder, parameters: ['quantity' => $this->quantity]));

        $items = app(ItemRepositoryInterface::class)->all();
        $taskIds = app(TaskRepositoryInterface::class)->all()->pluck('id');
        $items->each(fn($item) => $item->tasks()->sync($taskIds->take(rand(1,count($taskIds)))->toArray()));
    }
}

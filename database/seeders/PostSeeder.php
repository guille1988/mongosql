<?php

namespace Database\Seeders;

use App\Repositories\Interfaces\TaskRepositoryInterface;

class PostSeeder extends BaseSeeder
{
    public function data(): array
    {
        $title = fake()->jobTitle;
        $body = fake()->realText(200);
        $slug = fake()->slug;
        $task_id = app(TaskRepositoryInterface::class)->all()->random()->id;

        return compact(['title', 'body', 'slug', 'task_id']);
    }
}

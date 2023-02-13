<?php

namespace Database\Seeders;

use Carbon\Carbon;

class UserSeeder extends BaseSeeder
{
    public function data(): array
    {
        $name = fake()->name();
        $email = fake()->safeEmail;
        $email_verified_at = Carbon::now()->subDays(rand(1,15));
        $password = bcrypt('password');

        return compact(['name', 'email', 'email_verified_at', 'password']);
    }
}

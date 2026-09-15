<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        $accounts = [
            ['username' => 'admin', 'password' => 'admin123'],
            ['username' => 'maria.santos', 'password' => 'peso2026'],
            ['username' => 'juan.delacruz', 'password' => 'peso2026'],
        ];

        foreach ($accounts as $account) {
            Admin::updateOrCreate(
                ['username' => $account['username']],
                ['password' => $account['password']]
            );
        }
    }
}

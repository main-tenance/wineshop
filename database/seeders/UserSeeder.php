<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Root',
            'login' => 'root',
            'password' => '$2y$10$38yUyn379XXE2eFkD4qR2eGO2GCjFw4KtD4lQr3YDtqBMcV20Aiyq',
            'email' => 'root@test.ru',
        ]);
        User::factory(20)->create();
    }
}

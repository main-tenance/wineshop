<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Group;

class GroupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->insertIfNotExists('Администратор', 'admin', 'Административный доступ');
        $this->insertIfNotExists('Гость', 'guest', 'Все пользователи (в том числе неавторизованные)');
        $this->insertIfNotExists('Авторизованный', 'everyone', 'Зарегистрированные пользователи');
        $this->insertIfNotExists('Менеджер', 'manager', 'Менеджер компании');
        $this->insertIfNotExists('Тестировщик', 'tester', 'Тестировщик приложения');
        $this->insertIfNotExists('Vip', 'vip', 'Vip-клиент');
        Group::factory(5)->create();
    }


    private function insertIfNotExists($name, $code, $description)
    {
        $exists = $this->getByCode($code);
        if (!$exists) {
            Group::create([
                'name' => $name,
                'code' => $code,
                'description' => $description,
            ]);
        }
    }


    private function getByCode($code)
    {
        return Group::where('code', $code)->first();
    }
}

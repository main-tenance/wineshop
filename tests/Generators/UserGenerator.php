<?php

namespace Tests\Generators;

use App\Models\Group;
use App\Models\User;

class UserGenerator
{
    public static function create(int $cnt, array $data = [])
    {
        return User::factory($cnt)->create($data);
    }

    public static function getUser()
    {
        return User::factory()->create();
    }

    public static function getAdmin()
    {
        if (Group::whereCode('admin')->count() == 0) {
            Group::create([
                'name' => 'Администратор',
                'code' => 'admin',
                'description' => 'Администратор',
            ]);
        }

        return self::getUser()->becomeAdmin();
    }

    public static function getManager()
    {
        if (Group::whereCode('manager')->count() == 0) {
            Group::create([
                'name' => 'Менеджер',
                'code' => 'manager',
                'description' => 'Менеджер',
            ]);
        }

        return self::getUser()->becomeManager();
    }

    public static function getVip()
    {
        if (Group::whereCode('vip')->count() == 0) {
            Group::create([
                'name' => 'Vip',
                'code' => 'vip',
                'description' => 'Vip-клиент',
            ]);
        }

        return self::getUser()->addGroup('vip');
    }
}

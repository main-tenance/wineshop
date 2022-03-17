<?php

namespace Tests;

use App\Models\Group;
use App\Models\User;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    protected function getUser()
    {
        return User::factory()->create();
    }

    protected function getAdmin()
    {
        Group::create([
            'name' => 'Администратор',
            'code' => 'admin',
            'description' => 'Администратор',
        ]);

        return $this->getUser()->becomeAdmin();
    }

    protected function getManager()
    {
        Group::create([
            'name' => 'Менеджер',
            'code' => 'manager',
            'description' => 'Менеджер',
        ]);

        return $this->getUser()->becomeManager();
    }
}

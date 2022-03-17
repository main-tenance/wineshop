<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Group;
use App\Models\GroupUser;

class GroupUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        GroupUser::create([
            'user_id' => 1,
            'group_id' => 1,
        ]);
        foreach (User::all() as $user) {
            GroupUser::create([
                'user_id' => $user->id,
                'group_id' => Group::where('code', 'guest')->first()->id,
            ]);
        }
    }
}

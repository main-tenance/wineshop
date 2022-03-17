<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\DiscountGroup;
use App\Models\Discount;
use App\Models\Group;

class DiscountGroupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach (Discount::all() as $discount) {
            DiscountGroup::create([
                'discount_id' => $discount->id,
                'group_id' => Group::where('code', 'admin')->first()->id,
            ]);
        }
    }
}

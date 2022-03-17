<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Discount;
use App\Models\Category;

class DiscountSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach (Category::all() as $category) {
            $discount = Discount::factory()->create();
            $discount->update([
                'conditions' => [
                    [
                        'category_id' => $category->id,
                    ],
                ]
            ]);
        }
    }
}

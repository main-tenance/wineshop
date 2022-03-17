<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        $this->call([
            ImportSeeder::class,
            GenderSeeder::class,
            CodeSeeder::class,
            ColorSeeder::class,
            SugarSeeder::class,
            CategorySeeder::class,
            CreatorSeeder::class,
            CountrySeeder::class,
            AreaSeeder::class,
            SubregSeeder::class,
            VineSeeder::class,
            WineSeeder::class,
            OfferSeeder::class,
            OfferVineSeeder::class,
            GroupSeeder::class,
            DiscountSeeder::class,
            UserSeeder::class,
            ReviewSeeder::class,
            DiscountGroupSeeder::class,
            GroupUserSeeder::class,
            BannerSeeder::class,
        ]);
    }
}

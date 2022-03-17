<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Category;
use App\Models\Gender;

class CategorySeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $items = DB::connection('mysql')->select('select bie.xml_id, bie.detail_text
from b_iblock_element as bie
where bie.IBLOCK_ID = 35 and bie.ACTIVE = \'Y\'');
        $items = array_column($items, 'detail_text', 'xml_id');

        $this->insertIfNotExists(339, 'Игристое вино', 'sparkling_wine', 'neuter', $items[339]);
        $this->insertIfNotExists(341, 'Коньяк', 'cognac', 'masculine', $items[341]);
        $this->insertIfNotExists(342, 'Вино', 'wine', 'neuter', $items[342]);
        $this->insertIfNotExists(343, 'Арманьяк', 'armagnac', 'masculine', $items[343]);
        $this->insertIfNotExists(345, 'Ром', 'rom', 'masculine', $items[345]);
        $this->insertIfNotExists(346, 'Виски', 'whisky', 'neuter', $items[346]);
        $this->insertIfNotExists(347, 'Портвейн', 'port', 'masculine', $items[347]);
        $this->insertIfNotExists(348, 'Херес', 'sherry', 'neuter', $items[348]);
        $this->insertIfNotExists(354, 'Водка', 'vodka', 'feminine', '');
        $this->insertIfNotExists(577, 'Пиво', 'beer', 'neuter', $items[577]);
        $this->insertIfNotExists(1887, 'Джин', 'gin', 'masculine', '');
    }


    private function insertIfNotExists($id, $name, $code, $gender, $description)
    {
        $exists = $this->getById($id);
        if (!$exists) {
            $genderId = Gender::where('code', $gender)->first()->id;
            Category::create([
                'id' => $id,
                'name' => $name,
                'code' => $code,
                'gender_id' => $genderId,
                'description' => $description,
            ]);
        }
    }


    private function getById($id)
    {
        return Category::find($id);
    }
}

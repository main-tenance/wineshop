<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Creator;

class CreatorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $items = DB::connection('mysql')->select('select bie.id as img_id, fl.val, fl.code, fl.rus, bie.`name`, bie.detail_text
from b_iblock_element as bie
inner join filter_lists fl on fl.VAL = bie.XML_ID
where bie.IBLOCK_ID = 16');
        foreach ($items as $item) {
            $original = explode('/', $item->name);
            $original = isset($original[1]) ? trim($original[1]) : '';
            $this->insertIfNotExists($item->val, $item->rus, $item->code, $original, $item->detail_text, $item->img_id);
        }
    }


    private function insertIfNotExists($id, $name, $code, $original, $description, $imgId)
    {
        $exists = $this->getById($id);
        if (!$exists) {
            Creator::create([
                'id' => $id,
                'name' => $name,
                'code' => $code,
                'original' => $original,
                'description' => $description,
                'img_id' => $imgId,
             ]);
        }
    }


    private function getById($id)
    {
        return Creator::find($id);
    }

}

<?php


namespace App\Models;


use \Illuminate\Database\Eloquent\Model as EloquentModel;
use Illuminate\Support\Facades\DB;
use Watson\Rememberable\Rememberable;


abstract class Model extends EloquentModel
{
    use Rememberable;

    public function findByCode($code)
    {
        return DB::table($this->table)->where('code', $code);
    }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cartype extends Model
{
    /**
     * モデルと関連しているテーブル
     *
     * @var string
     */
    protected $table = 'mst_cartypes';
    
    /**
     * この車種の車両。（ Carモデルとの関係を定義）
     */
    public function cars()
    {
        return $this->hasMany(Car::class);
    }
    
    public static function cartypeSelectlist()
    {
        $types = Cartype::all();
        $list = array();
        $list += array( "" => "選択してください" ); //selectlistの先頭を空に
        foreach ($types as $type) {
           $list += array( $type->id => $type->cartype );
        }
        return $list;
    }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Maker extends Model
{
    /**
     * モデルと関連しているテーブル
     *
     * @var string
     */
    protected $table = 'mst_makers';
    
    /**
     * このメーカーの車両。（ Carモデルとの関係を定義）
     */
    public function cars()
    {
        return $this->hasMany(Car::class);
    }
    
    public static function makerSelectlist()
    {
        $makers = Maker::all();
        $list = array();
        $list += array( "" => "選択してください" ); //selectlistの先頭を空に
        foreach ($makers as $maker) {
           $list += array( $maker->id => $maker->maker );
        }
        return $list;
    }
}

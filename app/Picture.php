<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Picture extends Model
{
    /**
     * モデルと関連しているテーブル
     *
     * @var string
     */
    protected $table = 'tbl_pictures';
    
    /**
     * 画像が登録された車両。（ Carモデルとの関係を定義）
     */    
    public function car()
    {
        return $this->belongsTo(Car::class);
    }
}

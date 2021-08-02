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
}

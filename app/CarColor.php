<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CarColor extends Model
{
    /**
     * モデルと関連しているテーブル
     *
     * @var string
     */
    protected $table = 'mst_carcolors';
    
    /**
     * この色の車両。（ Carモデルとの関係を定義）
     */
    public function cars()
    {
        return $this->hasMany(Car::class);
    }

}

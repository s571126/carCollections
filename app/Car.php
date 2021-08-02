<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    /**
     * モデルと関連しているテーブル
     *
     * @var string
     */
    protected $table = 'tbl_cars';

    /**
     * この車両を登録したユーザ。（ Userモデルとの関係を定義）
     */    
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
    /**
     * この車両のメーカー。（ Makerモデルとの関係を定義）
     */    
    public function maker()
    {
        return $this->belongsTo(Maker::class);
    }
    
    /**
     * この車両の車種。（ Cartypeモデルとの関係を定義）
     */    
    public function cartype()
    {
        return $this->belongsTo(Cartype::class);
    }
    
    /**
     * この車両の色。（ CarColorモデルとの関係を定義）
     */    
    public function carcolor()
    {
        return $this->belongsTo(CarColor::class);
    }

    /**
     * この車両に登録した画像。（ Pictureモデルとの関係を定義）
     */
    public function pictures()
    {
        return $this->hasMany(Picture::class);
    }
    
}

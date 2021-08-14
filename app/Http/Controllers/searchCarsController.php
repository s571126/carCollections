<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Car;
use App\CarColor;
use App\Cartype;
use App\Maker;

class searchCarsController extends Controller
{
    public function searchCars(Request $request)
    {
        // 検索する項目を取得
        $maker_id = $request->maker_id;
        $cartype_id = $request->cartype_id;
        $name = $request->name;
        $price_id = $request->price_id;
        $created_at = $request->created_at;
        $carcolor_id = $request->carcolor_id;
        $query = Car::query();
        // 検索する情報が入力されている場合のみ
        if (!empty($maker_id)){
            $query->where('maker_id',$maker_id);
        }
        if (!empty($cartype_id)){
            $query->where('cartype_id',$cartype_id);
        }
        if (!empty($name)){
            $query->where('car_name','like','%'.$name.'%');
        }
        if (!empty($price_id)){
            switch ($price_id){
                case 1 :
                    $query->where('total_price','<=',1000000);
                    break;
                case 2 :
                    $query->whereBetween('total_price',[1000000,1999999]);
                    break;
                case 3 :
                    $query->whereBetween('total_price',[2000000,2999999]);
                    break;
                case 4 :
                    $query->where('total_price','>=',3000000);
                    break;
                default:
            }
        }
        if (!empty($created_at)){
            $query->where('created_at','like',$created_at.'%');
        }
        if (!empty($carcolor_id)){
            $query->where('carcolor_id',$carcolor_id);
        }
        $data['cars'] = $query->paginate(10);
        
        //mst_makersを取得
        $data['makers'] = Maker::makerSelectlist();
        //mst_cartypesを取得
        $data['types'] = Cartype::cartypeSelectlist();
        //mst_carcolorsを取得
        $data['colors'] = CarColor::carColorSelectlist(); 
        //tbl_carsを取得
        
        return view('cars.index', $data);
    }
}

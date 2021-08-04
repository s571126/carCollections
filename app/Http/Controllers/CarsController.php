<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Car;
use App\CarColor;
use App\Cartype;
use App\Maker;
use App\Picture;
use App\User;

class CarsController extends Controller
{
    public function index()
    {
        $data = [];
        //     // 認証済みユーザを取得
        //     $user = \Auth::user();
        
        //     // 車両情報全件を作成日時の降順で取得
        //     $cars = cars()->orderBy('created_at', 'desc')->paginate(10);
        //     $data = [
        //         'user' => $user,
        //         'cars' => $cars,
        //     ];
        
        //     mst_makersを取得
                $data['makers'] = Maker::all(); 
        //     mst_cartypesを取得
                $data['types'] = Cartype::all(); 
        //     mst_carcolorsを取得
                $data['colors'] = CarColor::all(); 

        // cars.indexビューでそれらを表示
        return view('cars.index', $data);
    }
    public function create()
    {
        $data = [];
        
        $data['car'] = new Car;
        //mst_makersを取得
        $data['makers'] = Maker::all(); 
        //mst_cartypesを取得
        $data['types'] = Cartype::all(); 
        //mst_carcolorsを取得
        $data['colors'] = CarColor::all(); 

        $year = date('Y');
        $years[] = $year;
        //年式を作成
        for($i = 1; $i < 20; $i++){
            $years[] = $year - $i ;
        }
        $data['years'] = $years;
        
        // 作成ビューを表示
        return view('cars.create', $data);
    }
    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // バリデーション
        $request->validate([
            'maker_id' => 'required',
            'cartype_id' => 'required',
            'car_name' => 'required',
            'price' => 'required',
            'carcolor_id' => 'required',
            'made_year' => 'required',
            'mileage' => 'required',
            'displacement' => 'required',
            'memo' => 'max:255',
        ]);
        
        // 車両を登録
        $car = new Car;
        $car->maker_id = $request->maker_id;
        $car->cartype_id = $request->cartype_id;
        $car->car_name = $request->car_name;
        $car->price = $request->price;
        $car->total_price = $request->price * 1.1;
        $car->carcolor_id = $request->carcolor_id;
        $car->made_year = $request->made_year;
        $car->mileage = $request->mileage;
        $car->displacement = $request->displacement;
        $car->memo = $request->memo;
        $car->created_user_id = \Auth::id();
        $car->save();

        // トップページへリダイレクトさせる
        return redirect('/');
    }
    
    
    public function show($id)
    {
        // idの値でメッセージを検索して取得
        $car = Car::findOrFail($id);
        // cars.showビューで表示
        return view('cars.show', [
            'car' => $car,
        ]);
    }
    
    public function destroy($id)
    {
        // idの値で車両を検索して取得
        $car = Car::findOrFail($id);
        
        //車両を保有しているユーザーかチェック
        if ($car->user_id == \Auth::id()){
            // メッセージを削除
            $car->delete();
        }

        // トップページへリダイレクトさせる
        return redirect('/');
    }
}

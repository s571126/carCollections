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
        
        //mst_makersを取得
        $data['makers'] = Maker::all();
        //mst_cartypesを取得
        $data['types'] = Cartype::all(); 
        //mst_carcolorsを取得
        $data['colors'] = CarColor::all(); 
        //tbl_carsを取得
        $data['cars'] = Car::paginate(10);

        // cars.indexビューでそれらを表示
        return view('cars.index', $data);
    }
    public function create()
    {
        $data = [];
        
        $data['car'] = new Car;
        //mst_makersを取得
        $maker = Maker::all(); 
        $data['makers'] = (array)$maker;
        //mst_cartypesを取得
        $data['types'] = Cartype::all(); 
        //mst_carcolorsを取得
        $data['colors'] = CarColor::all(); 

        //年式を作成
        $year = date('Y');
        $years = array();
        $years += array( "" => "選択してください" ); //selectlistの先頭を空に
        $years += array( $year => $year );
        for($i = 1; $i < 20; $i++){
            $years += array(($year - $i) => ($year - $i)) ;
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
            'displacement' => 'required|max:4',
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
    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = [];
        // idの値でタスクを検索して取得
        $car = Car::findOrFail($id);
        $data['car'] = $car;

        //年式を作成
        $year = date('Y');
        $years = array();
        $years += array( "" => "選択してください" ); //selectlistの先頭を空に
        $years += array( $year => $year );
        for($i = 1; $i < 20; $i++){
            $years += array(($year - $i) => ($year - $i)) ;
        }
        $data['years'] = $years;

        //車両を保有しているユーザーかチェック
        if ($car->created_user_id == \Auth::id()){
            // タスク編集ビューでそれを表示
            return view('cars.edit', $data);
        }else{
            // トップページへリダイレクトさせる
            return redirect('/');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
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
            'displacement' => 'required|max:4',
            'memo' => 'max:255',
        ]);
        
        // idの値で車両を検索して取得
        $car = Car::findOrFail($id);
        
        //車両を登録したユーザーかチェック
        if ($car->created_user_id == \Auth::id()){
            // 車両を更新
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
        }

        // トップページへリダイレクトさせる
        return redirect('/');
    }
    
    public function destroy($id)
    {
        // idの値で車両を検索して取得
        $car = Car::findOrFail($id);
        
        //車両を登録したユーザーかチェック
        if ($car->created_user_id == \Auth::id()){
            // 車両を削除
            $car->delete();
        }

        // トップページへリダイレクトさせる
        return redirect('/');
    }
}

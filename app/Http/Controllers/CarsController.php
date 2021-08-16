<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Car;
use App\CarColor;
use App\Cartype;
use App\Maker;
use App\Picture;
use App\User;
use Storage;

class CarsController extends Controller
{
    public function index()
    {
        $data = [];
        
        //mst_makersを取得
        $data['makers'] = Maker::makerSelectlist();
        //mst_cartypesを取得
        $data['types'] = Cartype::cartypeSelectlist();
        //mst_carcolorsを取得
        $data['colors'] = CarColor::carColorSelectlist(); 
        //tbl_carsを取得
        $data['cars'] = Car::paginate(5);
        $car_totalcnt = Car::count();
        $data['cars_totalcnt'] = $car_totalcnt;
        $data['cars_getcnt'] = $car_totalcnt;

        //検索フォームに設定する値（）
        $data['input_maker_id'] = "";
        $data['input_cartype_id'] = "";
        $data['input_name'] = "";
        $data['input_price_id'] = "";
        $data['input_created_at'] = "";
        $data['input_carcolor_id'] = "";
        
        $data['condition'] = [];

        // cars.indexビューでそれらを表示
        return view('cars.index', $data);
    }
    public function create()
    {
        $data = [];
        
        $data['car'] = new Car;
        //mst_makersを取得
        $data['makers'] = Maker::makerSelectlist();
        //mst_cartypesを取得
        $data['types'] = Cartype::cartypeSelectlist();
        //mst_carcolorsを取得
        $data['colors'] = CarColor::carColorSelectlist(); 
        //年式を作成
        $years = $this->madeyearSelectlist();
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
        $data = [];
        // idの値で車両を検索して取得
        $car = Car::findOrFail($id);
        $data['car'] = $car;
        
        // $data['car']=Car::with('pictures')->find($id);
        $data['maker']= Maker::find($car->maker_id);
        $data['type']= Cartype::find($car->cartype_id);
        $data['color']= CarColor::find($car->carcolor_id);

        $carImages = [
            '/noimage.png',
            '/noimage.png',
            '/noimage.png',
            '/noimage.png',
            '/noimage.png',
        ];
        foreach ($car->pictures as $picture) {
            $carImages[$picture->parts_code - 1] = $picture->parts_path;
        }
        $data['carImages']= $carImages;

        // cars.showビューで表示
        return view('cars.show', $data);
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
        
        //mst_makersを取得
        $data['makers'] = Maker::makerSelectlist();
        //mst_cartypesを取得
        $data['types'] = Cartype::cartypeSelectlist();
        //mst_carcolorsを取得
        $data['colors'] = CarColor::carColorSelectlist(); 

        //年式を作成
        $years = $this->madeyearSelectlist();
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

            $pictures = Picture::where('car_id',$car->id)->get();
            if ($pictures){
                foreach($pictures as $picture){
                    //S3から画像データを削除   
                    $s3_delete = Storage::disk('s3')->delete($picture->parts_path_del);
                    //tbl_picturesからデータを削除
                    $db_delete = Picture::where('car_id', $picture->car_id)
                                        ->where('parts_code', $picture->parts_code )
                                        ->delete();
                }
            }
            // 車両を削除
            $car->delete();
        }

        // トップページへリダイレクトさせる
        return redirect('/');
    }
    
    public function copy($id)
    {
        $data = [];
        // idの値でタスクを検索して取得
        $car = Car::findOrFail($id);
        $data['car'] = $car;

        //年式を作成
        $years = $this->madeyearSelectlist();
        $data['years'] = $years;

        //車両を保有しているユーザーかチェック
        if ($car->created_user_id == \Auth::id()){
            // タスク編集ビューでそれを表示
            return view('cars.copy', $data);
        }else{
            // トップページへリダイレクトさせる
            return redirect('/');
        }
    }
    
    public function image_upload(Request $request)
    {
        
        // バリデーション
        $request->validate([
            'image' => 'required|mimes:jpg,png',
        ]);
        
        $picture = new Picture;
        $car = Car::findOrFail($request->id);
        
        $form = $request->all();

        //拡張子付きでファイル名を取得
        $filename = $request->file("image")->getClientOriginalName();

        //アップロードした画像（部位）を取得
        $array = $request->input();
        $keys = array_keys($array);
        $parts =$keys[1];
        
        //s3アップロード開始
        $image = $request->file('image');
        // バケットの`carImage`フォルダへアップロード
        $path = Storage::disk('s3')->putFileAs('carImage/'.$car->car_name."/".$parts, $image, $filename,'public');
        // アップロードした画像のフルパスを取得
        $picture->parts_path_del = $path;
        $picture->parts_path = Storage::disk('s3')->url($path);
        
        // 1:front 2:rear 3:interior 4:side 5:other
        switch($parts){
            case "front":
                $parts_code = 1;
                break;
            case "rear":
                $parts_code = 2;
                break;
            case "interior":
                $parts_code = 3;
                break;
            case "side":
                $parts_code = 4;
                break;
            default:
                $parts_code = 5;
        }
        $picture->parts_code = $parts_code;
        $picture->car_id = $car->id;
        $picture->save();
    
        return redirect()->route('cars.show', ['id' => $car->id]);
    }

    public function destroyPictures(Request $request , $id)
    {

        if (isset($request->checks)){
            foreach($request->checks as $check){
                if (!$check) {
                    continue ;
                }
                //tbl_pictureから削除対象データを取得
                $picture = Picture::where('car_id', $id )
                                ->where('parts_code', $check )
                                ->first();
                //S3から画像データを削除   
                $s3_delete = Storage::disk('s3')->delete($picture->parts_path_del);
                //tbl_picturesからデータを削除
                $db_delete = Picture::where('car_id', $id)
                                ->where('parts_code', $check )
                                ->delete();
            }
        }

        // トップページへリダイレクトさせる
        return redirect()->route('cars.show', ['id' => $id]);

    }
    
    private function madeyearSelectlist()
    {
        $year = date('Y');
        $years = array();
        $years += array( "" => "選択してください" ); //selectlistの先頭を空に
        $years += array( $year => $year );
        for($i = 1; $i < 20; $i++){
            $years += array(($year - $i) => ($year - $i)) ;
        }
        return $years;
    }
    
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
        //     mst_cartypesを取得
        //     mst_carcolorsを取得


        // cars.indexビューでそれらを表示
        return view('cars.index', $data);
    }
    public function create()
    {
        $car = [];
        // 作成ビューを表示
        return view('cars.create', [
            'car' => $car,
        ]);
    }
    
    public function show($id)
    {
        // idの値でメッセージを検索して取得
        $car = Task::findOrFail($id);
        // cars.showビューで表示
        return view('cars.show', [
            'car' => $car,
        ]);
    }
    
    public function destroy($id)
    {
        // idの値で車両を検索して取得
        $car = Task::findOrFail($id);
        
        //車両を保有しているユーザーかチェック
        if ($car->user_id == \Auth::id()){
            // メッセージを削除
            $car->delete();
        }

        // トップページへリダイレクトさせる
        return redirect('/');
    }
}

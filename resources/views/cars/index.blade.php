@extends('layouts.app')

@section('content')

<!-- ここにページ毎のコンテンツを書く -->
    <h1>車両一覧</h1>

    <div class="p-3">
        <div class="form-group row">
            <!-- 576px以上の画面幅のとき、ラベルは2つ分のカラム幅で表示する指定を追加 -->
            <label class="col-form-label col-md-2">メーカー</label>
            <!-- メーカーセレクトボックス -->
            <select class="form-select col-md-2">
                <option selected></option>
                <option value="1">ホンダ</option>
                <option value="2">マツダ</option>
                <option value="3">トヨタ</option>
            </select>
            
            <!-- 576px以上の画面幅のとき、ラベル2つ分のカラム幅で表示する指定を追加 -->
            <label class="col-form-label col-md-2">車種</label>
            <!-- 576px以上の画面幅のとき、フォーム部品は2つ分のカラム幅で表示する指定を追加 -->
            <!-- 車種セレクトボックス -->
            <select class="form-select col-md-2">
                <option selected></option>
                <option value="1">軽</option>
                <option value="2">セダン</option>
                <option value="3">ＳＵＶ</option>
            </select>
            
            <!-- 576px以上の画面幅のとき、ラベルは3つ分のカラム幅で表示する指定を追加 -->
            <label class="col-form-label col-md-2">車名</label>
            <!-- 576px以上の画面幅のとき、フォーム部品は9つ分のカラム幅で表示する指定を追加 -->
            <div class="col-md-2">
                <input type="text" class="form-control" name="name">
            </div>
        </div>
    
        <div class="form-group row">
            <!-- 576px以上の画面幅のとき、ラベルは3つ分のカラム幅で表示する指定を追加 -->
            <label class="col-form-label col-md-2">価格</label>
            <!-- 576px以上の画面幅のとき、フォーム部品は2つ分のカラム幅で表示する指定を追加 -->
            <!-- 価格セレクトボックス -->
            <select class="form-select col-md-2">
                <option selected></option>
                <option value="1">1,000,000</option>
                <option value="2">2,000,000</option>
                <option value="3">3,000,000</option>
            </select>
            
            <!-- 576px以上の画面幅のとき、ラベルは3つ分のカラム幅で表示する指定を追加 -->
            <label class="col-form-label col-md-2">登録日</label>
            <!-- 576px以上の画面幅のとき、フォーム部品は2つ分のカラム幅で表示する指定を追加 -->
            <!-- 登録日セレクトボックス（？？？） -->
            <select class="form-select col-md-2">
                <option selected></option>
                <option value="1">2021/07/30</option>
                <option value="2">2021/08/01</option>
                <option value="3">2021/08/02</option>
            </select>
            
            <!-- 576px以上の画面幅のとき、ラベルは3つ分のカラム幅で表示する指定を追加 -->
            <label class="col-form-label col-md-2">色</label>
            <!-- 576px以上の画面幅のとき、フォーム部品は2つ分のカラム幅で表示する指定を追加 -->
            <!-- 色セレクトボックス -->
            <select class="form-select col-md-2">
                <option selected></option>
                <option value="1">白</option>
                <option value="2">黒</option>
                <option value="3">シルバー</option>
            </select>
        </div>
    </div>
    
    <div class="mt-4 border-bottom"></div>
    
    <div class="p-2">
        <div class="d-flex flex-row justify-content-end mt-4">
            <input type="submit" class="btn btn-secondary mr-4" value="条件をクリア">
            <input type="submit" class="btn btn-primary" value="条件で検索">
        </div>
    </div>
    
    <div class="mt-4 border">
        <div class="mt-2 p-4">
            <div class="d-flex flex-row justify-content-between">
                <div>
                    xxxxx / xxxxx 台     <!-- 検索してヒットした件数/車両テーブル全件数-->
                </div>
                <div>
                    <input type="submit" class="btn btn-primary mr-4" value="CSV出力">
                    <input type="submit" class="btn btn-primary mr-4" value="Excel出力">
                    <a href="cars/create" class="btn btn-primary">新規登録</a>
                </div>
            </div>
            <!-- 車両一覧（行）を表示 -->
            <!-- 後でincludeに変更 -->
            <div class="mt-2 border">        
                <div>画像（フロント）を表示</div>
                <p class="mt-2">{!! link_to_route('signup.get', '車名をテーブルから持ってきて表示') !!}</p>            
                <input type="submit" class="btn btn-primary" value="編集">
                <input type="submit" class="btn btn-danger" value="削除">
            </div>
            <div class="text-center mt-4">
                <!-- ページネーションのリンク -->
                リンク
            </div>
        </div>
    </div>
    
@endsection
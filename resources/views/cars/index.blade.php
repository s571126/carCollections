@extends('layouts.app')

@section('content')

<!-- ここにページ毎のコンテンツを書く -->
    <h1>車両一覧</h1>

    <form>
        <div class="p-3">
            <div class="form-group row">
                <!-- 576px以上の画面幅のとき、ラベルは2つ分のカラム幅で表示する指定を追加 -->
                <label class="col-form-label col-md-2">メーカー</label>
                <!-- メーカーセレクトボックス -->
                <select class="form-select col-md-2">
                        <option selected></option>
                    @foreach($makers as $maker)
                        <option value="{{$maker->id}}">{{$maker->maker}}</option>
                    @endforeach
                </select>
                
                <!-- 576px以上の画面幅のとき、ラベル2つ分のカラム幅で表示する指定を追加 -->
                <label class="col-form-label col-md-2">車種</label>
                <!-- 576px以上の画面幅のとき、フォーム部品は2つ分のカラム幅で表示する指定を追加 -->
                <!-- 車種セレクトボックス -->
                <select class="form-select col-md-2">
                    <option selected></option>
                    @foreach($types as $type)
                        <option value="{{$type->id}}">{{$type->cartype}}</option>
                    @endforeach
                </select>
                
                <!-- 576px以上の画面幅のとき、ラベルは2つ分のカラム幅で表示する指定を追加 -->
                <label class="col-form-label col-md-2">車名</label>
                <!-- 576px以上の画面幅のとき、フォーム部品は2つ分のカラム幅で表示する指定を追加 -->
                <div class="col-md-2">
                    <input type="text" class="form-control" name="name">
                </div>
            </div>
        
            <div class="form-group row">
                <!-- 576px以上の画面幅のとき、ラベルは2つ分のカラム幅で表示する指定を追加 -->
                <label class="col-form-label col-md-2">価格</label>
                <!-- 576px以上の画面幅のとき、フォーム部品は2つ分のカラム幅で表示する指定を追加 -->
                <!-- 価格セレクトボックス -->
                <select class="form-select col-md-2">
                    <option selected></option>
                    <option value="1">0</option>
                    <option value="2">1,000,000</option>
                    <option value="3">2,000,000</option>
                    <option value="4">3,000,000</option>
                </select>
                
                <!-- 576px以上の画面幅のとき、ラベルは2つ分のカラム幅で表示する指定を追加 -->
                <label class="col-form-label col-md-2">登録日</label>
                <!-- 576px以上の画面幅のとき、フォーム部品は2つ分のカラム幅で表示する指定を追加 -->
                <!-- 登録日セレクトボックス（？？？） -->
                <select class="form-select col-md-2">
                    <option selected></option>
                    <option value="1">2021/07/30</option>
                    <option value="2">2021/08/01</option>
                    <option value="3">2021/08/02</option>
                </select>
                
                <!-- 576px以上の画面幅のとき、ラベルは2つ分のカラム幅で表示する指定を追加 -->
                <label class="col-form-label col-md-2">色</label>
                <!-- 576px以上の画面幅のとき、フォーム部品は2つ分のカラム幅で表示する指定を追加 -->
                <!-- 色セレクトボックス -->
                <select class="form-select col-md-2">
                    <option selected></option>
                        @foreach($colors as $color)
                            <option value="{{$color->id}}">{{$color->color}}</option>
                        @endforeach
                </select>
            </div>
        </div>
        
        <div class="mt-4 border-bottom border-dark"></div>
        
        <div class="p-2">
            <div class="d-flex flex-row justify-content-end mt-4">
                <input type="reset" class="btn btn-secondary mr-4" value="条件をクリア">
                <input type="submit" class="btn btn-primary" value="条件で検索">
            </div>
        </div>
    </form>
    
    <div class="mt-4 border border-dark">
        <div class="mt-2 p-4">
            <div class="d-flex flex-row justify-content-between">
                <div>
                    xxxxx / xxxxx 台     <!-- 検索してヒットした件数/車両テーブル全件数-->
                </div>
                <div>
                    <input type="submit" class="btn btn-primary mr-4" value="CSV出力">
                    <input type="submit" class="btn btn-primary mr-4" value="Excel出力">
                    {{-- 車両登録ページへのリンク --}}
                    {!! link_to_route('cars.create', '新規登録', [], ['class' => 'btn btn-primary']) !!}
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
                ページネーション
            </div>
        </div>
    </div>
    
@endsection
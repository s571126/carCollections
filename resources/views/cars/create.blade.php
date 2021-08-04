@extends('layouts.app')

@section('content')

<!-- ここにページ毎のコンテンツを書く -->
    <h1>車両登録</h1>

    <div class="p-4">
        {!! Form::model($car, ['route' => 'cars.store']) !!}

            <div class="form-group row">
                <!-- 576px以上の画面幅のとき、ラベルは2つ分のカラム幅で表示する指定を追加 -->
                <label class="col-form-label col-md-2">メーカー</label>
                <!-- メーカーセレクトボックス -->
                <select class="form-select col-md-6" name="maker_id">
                    <option selected></option>
                        @foreach($makers as $maker)
                            <option value="{{$maker->id}}">{{$maker->maker}}</option>
                        @endforeach
                </select>
            </div>

            <div class="form-group row">
                <!-- 576px以上の画面幅のとき、ラベルは2つ分のカラム幅で表示する指定を追加 -->
                <label class="col-form-label col-md-2">車種</label>
                <!-- 車種セレクトボックス -->
                <select class="form-select col-md-6" name="cartype_id">
                    <option selected></option>
                        @foreach($types as $type)
                            <option value="{{$type->id}}">{{$type->cartype}}</option>
                        @endforeach
                </select>
            </div>            

            <div class="form-group row">
                <!-- 576px以上の画面幅のとき、ラベルは2つ分のカラム幅で表示する指定を追加 -->
                <label class="col-form-label col-md-2">車名</label>
                <!-- 576px以上の画面幅のとき、フォーム部品は2つ分のカラム幅で表示する指定を追加 -->
                <div class="col-md-6">
                    <input type="text" class="form-control" name="car_name" maxlength="20">
                </div>
            </div>

            <div class="form-group row">
                <!-- 576px以上の画面幅のとき、ラベルは2つ分のカラム幅で表示する指定を追加 -->
                <label class="col-form-label col-md-2">本体価格</label>
                <!-- 576px以上の画面幅のとき、フォーム部品は2つ分のカラム幅で表示する指定を追加 -->
                <div class="col-md-6">
                    <input type="text" class="form-control" name="price" oninput="value = value.replace(/[^0-9]+/i,'');">
                </div>
                <div class="col-1">円</div>
            </div>

            <!-- 576px以上の画面幅のとき、ラベルは2つ分のカラム幅で表示する指定を追加 -->
            <label class="col-form-label col-md-2">色</label>
            <!-- 576px以上の画面幅のとき、フォーム部品は2つ分のカラム幅で表示する指定を追加 -->
            <!-- 色セレクトボックス -->
            <select class="form-select col-md-6" name="carcolor_id">
                <option selected></option>
                    @foreach($colors as $color)
                        <option value="{{$color->id}}">{{$color->color}}</option>
                    @endforeach
            </select>

            <div class="form-group row">
                <!-- 576px以上の画面幅のとき、ラベルは2つ分のカラム幅で表示する指定を追加 -->
                <label class="col-form-label col-md-2">年式</label>
                <!-- 576px以上の画面幅のとき、フォーム部品は2つ分のカラム幅で表示する指定を追加 -->
                <!-- 年式セレクトボックス -->

                    <select class="form-select col-md-6" name="made_year">
                        <option selected></option>
                            @foreach($years as $key => $year)
                                <option value="{{$year}}">{{$year}}</option>
                            @endforeach
                    </select>

                <div class="col-1">年</div>
            </div>

            <div class="form-group row">
                <label class="col-2 col-form-label">走行距離</label>
                <div class="col-6">
                    <input type="text" class="form-control" name="mileage" oninput="value = value.replace(/[^0-9]+/i,'');">
                </div>
                <div class="col-1">km</div>
            </div>
            
            <div class="form-group row">
                <label class="col-2 col-form-label">排気量</label>
                <div class="col-6">
                    <input type="text" class="form-control" name="displacement" maxlength="4" oninput="value = value.replace(/[^0-9]+/i,'');">
                </div>
                <div class="col-1">cc</div>
            </div>

            <div class="form-group row">
                <label class="col-2 col-form-label">備考</label>
                <div class="col-6">
                    <textarea class="form-control" name="memo"></textarea>
                </div>
            </div>
            
            <div class="form-group offset-md-2">
                {!! Form::submit('登　録', ['class' => 'btn btn-primary']) !!}
            </div>

        {!! Form::close() !!}
    </div>

@endsection
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
                <input class=col-md-2" type=date>
                
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
            <div class="mt-2 border">        
                @foreach($cars as $car)
                    <div class="form-group row border-bottom p-2">
                        <div class="col-md-2">画像（フロント）を表示</div>
                        {{-- 車両詳細フォーム --}}
                        <div class="col-md-6">
                            <p class="mt-2 pb-3 border-bottom">{!! link_to_route('cars.show', $car->car_name, ['id' => $car->id]) !!}</p>
                            <p class="mt-2">{{$car->memo}}</p>
                        </div>
                        <div class="col-md-1 mt-2 small text-center">
                            <span style="text-decoration: underline;">年式</span>
                            <p>{{$car->made_year}}年</p>
                            <span style="text-decoration: underline;">本体価格</span>
                            <p>{{$car->price}}円</p>
                        </div>
                        <div class="col-md-1 mt-2 small text-center">
                            <span style="text-decoration: underline;">走行距離</span>
                            <p>{{$car->mileage}}km</p>
                            <span style="text-decoration: underline;">支払総額</span>
                            <div><span class="text-warning font-weight-bold">{{$car->total_price}}</span>円</div>
                        </div>
                        <div class="col-md-2">
                            @if ($car->created_user_id == \Auth::id())                        
                                {{-- 車両編集フォーム --}}
                                {!! Form::open(['route' => ['cars.edit', $car->id], 'method' => 'get']) !!}
                                    {!! Form::submit('編集', ['class' => 'btn btn-primary']) !!}
                                {!! Form::close() !!}
                                {{-- 車両削除フォーム --}}
                                {!! Form::open(['route' => ['cars.destroy', $car->id], 'method' => 'delete']) !!}
                                    {!! Form::submit('削除', ['class' => 'btn btn-danger']) !!}
                                {!! Form::close() !!}
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="text-center mt-4">
                <!-- ページネーションのリンク -->
                {{ $cars->links() }}
            </div>
        </div>
    </div>
    
@endsection
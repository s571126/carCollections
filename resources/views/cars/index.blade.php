@extends('layouts.app')

@section('content')

<!-- ここにページ毎のコンテンツを書く -->
    <h1>車両一覧</h1>

    {{ Form::open(['route' => 'cars.search' , 'method' => 'get']) }}
        <div class="p-3">
            <div class="form-group row">
                {{ form::label('maker','メーカー', ['class' => 'form-check-label col-md-2']) }}
                <!-- メーカーセレクトボックス -->
                {{Form::select('maker_id', $makers,null,['class' => 'form-select col-md-2'])}}

                {{ form::label('cartype','車種', ['class' => 'form-check-label col-md-2']) }}
                <!-- 車種セレクトボックス -->
                {{Form::select('cartype_id', $types,null,['class' => 'form-select col-md-2'])}}
                
                {{ form::label('car_name','車名', ['class' => 'form-check-label col-md-2']) }}
                {{Form::text('name', null, ['class' => 'form-control border-dark col-md-2'])}}
            </div>
        
            <div class="form-group row">
                {{ form::label('price','価格', ['class' => 'form-check-label col-md-2']) }}
                <!-- 価格セレクトボックス -->
                <select class="form-select col-md-2" name=price_id>
                    <option value="" selected>選択してください</option>
                    <option value="1">～999999</option>
                    <option value="2">1,000,000～1,999,999</option>
                    <option value="3">2,000,000～2,999,999</option>
                    <option value="4">3,000,000～</option>
                </select>
                
                {{ form::label('created_at','登録日', ['class' => 'form-check-label col-md-2']) }}
                <!-- 登録日選択フォーム -->
                <input class="col-md-2" type=date name="created_at">
                
                {{ form::label('color','色', ['class' => 'form-check-label col-md-2']) }}
                <!-- 色セレクトボックス -->
                {{Form::select('carcolor_id', $colors,null,['class' => 'form-select col-md-2'])}}
            </div>
        </div>
        
        <div class="mt-4 border-bottom border-dark"></div>
        
        <div class="p-2">
            <div class="d-flex flex-row justify-content-end mt-4">
                {{ Form::reset('条件をクリア', ['class' => 'btn btn-secondary mr-4']) }}
                {{ Form::submit('条件で検索', ['name' => 'update', 'class' => 'btn btn-primary']) }}
            </div>
        </div>
    {{ Form::close() }}
    
    <div class="mt-4 border border-dark">
        <div class="mt-2 p-4">
            <div class="d-flex flex-row justify-content-between">
                <div>
                    xxxxx / xxxxx 台     <!-- 検索してヒットした件数/車両テーブル全件数-->
                </div>
                <div class="d-flex flex-row justify-content-between">
                    <div>
                        {!! Form::open(['route' => ['cars.csv'], 'method' => 'get']) !!}
                            {!! Form::submit('CSV出力', ['class' => 'btn btn-primary mr-4']) !!}
                        {!! Form::close() !!}
                    </div>
                    <div>
                        {!! Form::open(['route' => ['cars.excel'], 'method' => 'get']) !!}
                            {!! Form::submit('Excel出力', ['class' => 'btn btn-primary mr-4']) !!}
                        {!! Form::close() !!}
                    </div>
                    <div>
                        {{-- 車両登録ページへのリンク --}}
                        {!! link_to_route('cars.create', '新規登録', [], ['class' => 'btn btn-primary']) !!}
                    </div>
                </div>
            </div>
            <!-- 車両一覧（行）を表示 -->
            <div class="mt-2 border">        
                @foreach($cars as $car)
                    <div class="form-group row border-bottom p-2">
                        <div class="col-md-2">
                            @if ( $car->pictures->where('parts_code', 1)->first() )
                                <img src="{{ $car->pictures->where('parts_code', 1)->first()->parts_path }}" alt="" class="img-fluid">
                            @else
                                <img src="/noimage.png" alt="" class="img-fluid">
                            @endif
                        </div>
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
                                <div class="d-flex flex-column">
                                    <div>                                
                                        {{-- 車両編集フォーム --}}
                                        {!! Form::open(['route' => ['cars.edit', $car->id], 'method' => 'get']) !!}
                                            {!! Form::submit('編集', ['class' => 'btn btn-primary btn-block m-2']) !!}
                                        {!! Form::close() !!}
                                    </div>
                                    <div> 
                                        {{-- 車両削除フォーム --}}
                                        {!! Form::open(['route' => ['cars.destroy', $car->id], 'method' => 'delete']) !!}
                                            {!! Form::submit('削除', ['class' => 'btn btn-danger btn-block m-2']) !!}
                                        {!! Form::close() !!}
                                    </div>
                                </div>
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
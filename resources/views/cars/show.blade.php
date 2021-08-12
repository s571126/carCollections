@extends('layouts.app')

@section('content')

<!-- ここにページ毎のコンテンツを書く -->
    <h1>車両詳細</h1>

    <div class="p-4">

        {{-- ボタン --}}
        @include('cars_common.button')
        
        <div class="form-group row">
            {{Form::label('maker', 'メーカー',['class' => 'col-form-label col-md-2'])}}
            {{Form::label('maker', $maker->maker ,['class' => 'col-form-label col-md-6'])}}
        </div>
        
        <div class="form-group row">
            {{Form::label('type', '車種',['class' => 'col-form-label col-md-2'])}}
            {{Form::label('type', $type->cartype ,['class' => 'col-form-label col-md-6'])}}
        </div>        
        
        <div class="form-group row">
            {{Form::label('car_name', '車名',['class' => 'col-form-label col-md-2'])}}
            {{Form::label('car_name', $car->car_name ,['class' => 'col-form-label col-md-6'])}}
        </div>    

        <div class="form-group row">
            {{Form::label('price', '本体価格',['class' => 'col-form-label col-md-2'])}}
            {{Form::label('price', $car->price . "　円" ,['class' => 'col-form-label col-md-6'])}}
        </div>

        <div class="form-group row">
            {{Form::label('price', '支払総額',['class' => 'col-form-label col-md-2'])}}
            {{Form::label('price', $car->total_price . "　円" ,['class' => 'col-form-label col-md-6'])}}
        </div>

        <div class="form-group row">
            {{Form::label('color', '色',['class' => 'col-form-label col-md-2'])}}
            {{Form::label('carcolor_id', $color->color ,['class' => 'col-form-label col-md-6'])}}
        </div>

        <div class="form-group row">
            {{Form::label('year', '年式',['class' => 'col-form-label col-md-2'])}}
            {{Form::label('made_year', $car->made_year . "　年",['class' => 'col-form-label col-md-6'])}}
        </div>
        
        <div class="form-group row">
            {{Form::label('mileage', '走行距離',['class' => 'col-form-label col-md-2'])}}
            {{Form::label('mileage', $car->mileage . "　km" ,['class' => 'col-form-label col-md-6', 'min' => 0])}}
        </div>
        
        <div class="form-group row">
            {{Form::label('displacement', '排気量',['class' => 'col-form-label col-md-2'])}}
            {{Form::label('displacement', $car->displacement . "　cc" ,['class' => 'col-form-label col-md-6'])}}
        </div>

        <div class="form-group row">
            {{Form::label('memo', '備考',['class' => 'col-form-label col-md-2'])}}
            {{Form::label('memo', $car->memo ,['class' => 'col-form-label col-md-6'])}}
        </div>

    </div>
    
    <h2>画像</h2>
    
    <div class="p-4">
        
            <table class="table table-bordered">
                <tr>
                    <th class="col-md-3">
                        <div class="d-flex justify-content-between">
                            <div>フロント</div>
                            <div class="form-check">
                                @if ( $car->pictures->where('parts_code', 1)->first() )
                                    <input class="form-check-input" type="checkbox" name=checks[] value="1" id="check_delete_1">
                                @else
                                    <input class="form-check-input" type="checkbox" name=checks[] value="1" id="check_delete_1" disabled>
                                @endif
                                <label class="form-check-label" for="check_front">削除</label>
                            </div>
                        </div>    
                    </th>
                    <th class="col-md-3">
                        <div class="d-flex justify-content-between">
                            <div>リア</div>
                            <div class="form-check">
                                @if ( $car->pictures->where('parts_code', 2)->first() )
                                    <input class="form-check-input" type="checkbox" name=checks[] value="2" id="check_delete_2">
                                @else
                                    <input class="form-check-input" type="checkbox" name=checks[] value="2" id="check_delete_2" disabled>
                                @endif
                                <label class="form-check-label" for="check_rear">削除</label>
                            </div>
                        </div>
                    </th>
                    <th class="col-md-3">
                        <div class="d-flex justify-content-between">
                            <div>インテリア</div>
                            <div class="form-check">
                                @if ( $car->pictures->where('parts_code', 3)->first() )
                                    <input class="form-check-input" type="checkbox" name=checks[] value="3" id="check_delete_3">
                                @else
                                    <input class="form-check-input" type="checkbox" name=checks[] value="3" id="check_delete_3" disabled>
                                @endif
                                <label class="form-check-label" for="check_interior">削除</label>
                            </div>
                        </div>
                    </th>
                </tr>
                <tr>
                    <td class="col-md-3">
                        <img src="{{$carImages[0]}}" alt="" class="img-fluid">
                    </td>
                    <td class="col-md-3">
                        <img src="{{$carImages[1]}}" alt="" class="img-fluid">
                    </td>
                    <td class="col-md-3">
                        <img src="{{$carImages[2]}}" alt="" class="img-fluid">
                    </td>
                </tr>
                <tr>
                    @if ($car->created_user_id == \Auth::id())
                        <td>
                            <form action="{{ action('CarsController@image_upload') }}" method="post" enctype="multipart/form-data">
                                @if ( $car->pictures->where('parts_code', 1)->first() )
                                    画像の上書きは不可、削除してから再度アップロード
                                @else
                                    <input type="file" name="image" accept=".png,.jpg">
                                    {{ csrf_field() }}
                                    <input type="submit" value="アップロード" class="btn btn-primary" name="front">
                                    <input type="hidden" name="id" value="{{$car->id}}">
                                @endif
                            </form>
                        </td>
                        <td>
                            <form action="{{ action('CarsController@image_upload') }}" method="post" enctype="multipart/form-data">
                                @if ( $car->pictures->where('parts_code', 2)->first() )
                                    画像の上書きは不可、削除してから再度アップロード
                                @else
                                    <input type="file" name="image" accept=".png,.jpg">
                                    {{ csrf_field() }}
                                    <input type="submit" value="アップロード" class="btn btn-primary" name="rear">
                                    <input type="hidden" name="id" value="{{$car->id}}">
                                @endif
                            </form>
                        </td>
                        <td>
                            <form action="{{ action('CarsController@image_upload') }}" method="post" enctype="multipart/form-data">
                                @if ( $car->pictures->where('parts_code', 3)->first() )
                                    画像の上書きは不可、削除してから再度アップロード
                                @else
                                    <input type="file" name="image" accept=".png,.jpg">
                                    {{ csrf_field() }}
                                    <input type="submit" value="アップロード" class="btn btn-primary" name="interior">
                                    <input type="hidden" name="id" value="{{$car->id}}">
                                @endif    
                            </form>
                        </td>
                    @endif
                </tr>
                <tr>
                    <th class="col-md-3">
                        <div class="d-flex justify-content-between">
                            <div>サイド</div>
                            <div class="form-check">
                                @if ( $car->pictures->where('parts_code', 4)->first() )
                                    <input class="form-check-input" type="checkbox" name=checks[] value="4" id="check_delete_4">
                                @else
                                    <input class="form-check-input" type="checkbox" name=checks[] value="4" id="check_delete_4" disabled>
                                @endif
                                <label class="form-check-label" for="check_side">削除</label>
                            </div>
                        </div>
                    </th>
                    <th class="col-md-3">
                        <div class="d-flex justify-content-between">
                            <div>その他</div>
                            <div class="form-check">
                                @if ( $car->pictures->where('parts_code', 5)->first() )
                                    <input class="form-check-input" type="checkbox" name=checks[] value="5" id="check_delete_5">
                                @else
                                    <input class="form-check-input" type="checkbox" name=checks[] value="5" id="check_delete_5" disabled>
                                @endif
                                <label class="form-check-label" for="check_other">削除</label>
                            </div>
                        </div>
                    </th>
                </tr>
                <tr>
                    <td class="col-md-3">
                        <img src="{{$carImages[3]}}" alt="" class="img-fluid">
                    </td>
                    <td>
                        <img src="{{$carImages[4]}}" alt="" class="img-fluid">
                    </td>
                </tr>
                <tr>
                    @if ($car->created_user_id == \Auth::id())
                        <td>
                            <form action="{{ action('CarsController@image_upload') }}" method="post" enctype="multipart/form-data">
                                @if ( $car->pictures->where('parts_code', 4)->first() )
                                    画像の上書きは不可、削除してから再度アップロード
                                @else
                                    <input type="file" name="image" accept=".png,.jpg">
                                    {{ csrf_field() }}
                                    <input type="submit" value="アップロード" class="btn btn-primary" name="side">
                                    <input type="hidden" name="id" value="{{$car->id}}">
                                @endif
                            </form>
                        </td>
                        <td>
                            <form action="{{ action('CarsController@image_upload') }}" method="post" enctype="multipart/form-data">
                                @if ( $car->pictures->where('parts_code', 5)->first() )
                                    画像の上書きは不可、削除してから再度アップロード
                                @else
                                    <input type="file" name="image" accept=".png,.jpg">
                                    {{ csrf_field() }}
                                    <input type="submit" value="アップロード" class="btn btn-primary" name="other">
                                    <input type="hidden" name="id" value="{{$car->id}}">
                                @endif    
                            </form>
                        </td>
                    @endif
                </tr>
            </table>    
    
        {{-- 画像一括削除 --}}
        {!! Form::open(['route' => ['pictures.destroy' , $car->id], 'method' => 'delete']) !!}    
            @if ($car->created_user_id == \Auth::id())
                <div class="d-flex justify-content-end">
                    {!! Form::submit('画像一括削除', ['class' => 'btn btn-danger']) !!}
                </div>
            @endif
            <input type="hidden" name=checks[] id=check_delete_1_cron>
            <input type="hidden" name=checks[] id=check_delete_2_cron>
            <input type="hidden" name=checks[] id=check_delete_3_cron>
            <input type="hidden" name=checks[] id=check_delete_4_cron>
            <input type="hidden" name=checks[] id=check_delete_5_cron>            
        {!! Form::close() !!}
            
        {{-- ボタン --}}
        @include('cars_common.button')
        
    </div>
    
<script type="text/javascript">

    document.getElementById('check_delete_1').addEventListener('change', test);
    document.getElementById('check_delete_2').addEventListener('change', test);
    document.getElementById('check_delete_3').addEventListener('change', test);
    document.getElementById('check_delete_4').addEventListener('change', test);
    document.getElementById('check_delete_5').addEventListener('change', test);

    function test() {
        if(document.getElementById('check_delete_1').checked){
            document.getElementById('check_delete_1_cron').value = document.getElementById('check_delete_1').value;
        }else{
            document.getElementById('check_delete_1_cron').value = "" ;
        }
    
        if(document.getElementById('check_delete_2').checked){
            document.getElementById('check_delete_2_cron').value = document.getElementById('check_delete_2').value;
        }else{
            document.getElementById('check_delete_2_cron').value = "" ;
        }    

        if(document.getElementById('check_delete_3').checked){
            document.getElementById('check_delete_3_cron').value = document.getElementById('check_delete_3').value;
        }else{
            document.getElementById('check_delete_3_cron').value = "" ;
        }    

        if(document.getElementById('check_delete_4').checked){
            document.getElementById('check_delete_4_cron').value = document.getElementById('check_delete_4').value;
        }else{
            document.getElementById('check_delete_4_cron').value = "" ;
        }    

        if(document.getElementById('check_delete_5').checked){
            document.getElementById('check_delete_5_cron').value = document.getElementById('check_delete_5').value;
        }else{
            document.getElementById('check_delete_5_cron').value = "" ;
        }    

    }

</script>
        
@endsection
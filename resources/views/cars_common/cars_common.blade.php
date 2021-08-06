<div class="form-group row">
    {{Form::label('maker', 'メーカー',['class' => 'col-form-label col-md-2'])}}
    <!-- メーカーセレクトボックス -->
    {{Form::select('maker_id', App\Maker::makerSelectlist(),null,['class' => 'form-select col-md-6'])}}
</div>

<div class="form-group row">
    <!-- 576px以上の画面幅のとき、ラベルは2つ分のカラム幅で表示する指定を追加 -->
    <label class="col-form-label col-md-2">車種</label>
    <!-- 車種セレクトボックス -->
    {{Form::select('cartype_id', App\Cartype::cartypeSelectlist(),null,['class' => 'form-select col-md-6'])}}
</div>            

<div class="form-group row">
    {{Form::label('car_name', '車名',['class' => 'col-form-label col-md-2'])}}
    {{Form::text('car_name', null,['class' => 'col-form-control col-md-6', 'maxlength' => "20"])}}
</div>

<div class="form-group row">
    {{Form::label('price', '本体価格',['class' => 'col-form-label col-md-2'])}}
    {{Form::text('price', null,['class' => 'col-form-label col-md-6'])}}
    <div class="col-1">円</div>
</div>

<div class="form-group row">
    {{Form::label('color', '色',['class' => 'col-form-label col-md-2'])}}
    {{Form::select('carcolor_id', App\CarColor::carColorSelectlist(),null,['class' => 'form-select col-md-6'])}}
</div>

<div class="form-group row">
    {{Form::label('year', '年式',['class' => 'col-form-label col-md-2'])}}
    <!-- 年式セレクトボックス -->
    {{Form::select('made_year', $years,null,['class' => 'form-select col-md-6'])}}
    <div class="col-1">年</div>
</div>

<div class="form-group row">
    {{Form::label('mileage', '走行距離',['class' => 'col-form-label col-md-2'])}}
    {{Form::number('mileage', null,['class' => 'col-form-control col-md-6', 'min' => 0])}}
    <div class="col-1">km</div>
</div>

<div class="form-group row">
    {{Form::label('displacement', '排気量',['class' => 'col-form-label col-md-2'])}}
    {{Form::number('displacement', null,['class' => 'col-form-control col-md-6' , 'maxlength' => '4' , 'min' => 0 ])}}
    <div class="col-1">cc</div>
</div>

<div class="form-group row">
    {{Form::label('memo', '備考',['class' => 'col-form-label col-md-2'])}}
    {{Form::textarea('memo', null,['class' => 'col-form-control col-md-6' , 'rows' => '3'])}}
</div>
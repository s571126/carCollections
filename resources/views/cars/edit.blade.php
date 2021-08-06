@extends('layouts.app')

@section('content')

<!-- ここにページ毎のコンテンツを書く -->
    <h1>車両編集</h1>

    <div class="p-4">
        {!! Form::model($car, ['route' => ['cars.update', 'id' => $car->id], 'method' => 'put']) !!}
        
            {{-- ユーザ情報 --}}
            @include('cars_common.cars_common')

            <div class="form-group offset-md-2">
                {!! Form::submit('更　新', ['class' => 'btn btn-primary']) !!}
            </div>
            
        {!! Form::close() !!}
    
    </div>

@endsection
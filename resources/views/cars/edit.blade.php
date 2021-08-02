@extends('layouts.app')

@section('content')

<!-- ここにページ毎のコンテンツを書く -->
    <h1>車両編集</h1>

　　<!-- createと同じbladeをinclude -->
    <div class="row">
        <div class="col-6">
            {!! Form::model($car, ['route' => ['cars.update', $car->id], 'method' => 'put']) !!}

                <div class="form-group">
                    {!! Form::label('content', 'タスク:') !!}
                    {!! Form::text('content', null, ['class' => 'form-control']) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('content', 'ステータス:') !!}
                    {!! Form::text('status', null, ['class' => 'form-control']) !!}
                </div>

                {!! Form::submit('更新', ['class' => 'btn btn-primary']) !!}

            {!! Form::close() !!}
        </div>
    </div>

@endsection
@if ($car->created_user_id == \Auth::id())
    <div class="d-flex justify-content-end mt-4">
        {!! Form::open(['route' => ['cars.destroy', $car->id], 'method' => 'delete']) !!}
            {!! Form::submit('削除', ['class' => 'btn btn-danger mr-2']) !!}
        {!! Form::close() !!}
        {!! Form::open(['route' => ['cars.edit', $car->id], 'method' => 'get']) !!}
            {!! Form::submit('編集', ['class' => 'btn btn-primary mr-2']) !!}
        {!! Form::close() !!}
        {!! Form::open(['route' => ['cars.copy', $car->id], 'method' => 'get']) !!}
            {!! Form::submit('コピーして登録', ['class' => 'btn btn-primary']) !!}
        {!! Form::close() !!}
    </div>
@endif
<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="utf-8">
        <title>carCollections</title>
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css">
    </head>

    <body>
        {{-- エラーメッセージ --}}
        @include('commons.error_messages')

        <div class="text-center mt-4 border-bottom">
            <h1>ユーザー登録</h1>
        </div>
    
        <div class="row">
            <div class="col-sm-6 offset-sm-3 mt-4">
    
                {!! Form::open(['route' => 'signup.post']) !!}
                    <div class="form-group">
                        {!! Form::label('name', '氏名') !!}
                        {!! Form::text('name', null, ['class' => 'form-control']) !!}
                    </div>
    
                    <div class="form-group">
                        {!! Form::label('email', 'メール') !!}
                        {!! Form::email('email', null, ['class' => 'form-control']) !!}
                    </div>
    
                    <div class="form-group">
                        {!! Form::label('password', 'パスワード') !!}
                        {!! Form::password('password', ['class' => 'form-control']) !!}
                    </div>
    
                    <div class="form-group">
                        {!! Form::label('password_confirmation', 'パスワード再確認') !!}
                        {!! Form::password('password_confirmation', ['class' => 'form-control']) !!}
                    </div>
    
                    <div class="d-flex flex-row justify-content-between mt-4">
                        <a href="login" class="btn btn-secondary col-sm-5">戻　る</a>
                        {!! Form::submit('登　録', ['class' => 'btn btn-primary col-sm-5']) !!}
                    </div>
                {!! Form::close() !!}
                
            </div>
        </div>
    </body>
</html>
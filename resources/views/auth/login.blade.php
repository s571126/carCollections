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
            <h1>carCollections<br>ログイン</h1>
        </div>
    
        <div class="mt-4 row">
            <div class="col-md-6 pr-4 text-right">
                <!-- 画像を表示 -->
                あとで画像を表示する
            </div>
            <!-- 576px以上の画面幅のとき、右側は6つ分のカラム幅で表示する指定を追加 -->
            <div class="col-md-6">
                <div class="row">
                    <div class="col-sm-6 pl-4">
            
                        {!! Form::open(['route' => 'login.post']) !!}
                            <div class="form-group">
                                {!! Form::label('email', 'メールアドレス') !!}
                                {!! Form::email('email', null, ['class' => 'form-control']) !!}
                            </div>
            
                            <div class="form-group">
                                {!! Form::label('password', 'パスワード') !!}
                                {!! Form::password('password', ['class' => 'form-control']) !!}
                            </div>

                            <div class="mt-4">
                                {!! Form::submit('ログイン', ['class' => 'btn btn-primary btn-block']) !!}
                            </div>
                        {!! Form::close() !!}
                        
                        {{-- ユーザ登録ページへのリンク --}}
                        <p class="mt-2">未登録？ {!! link_to_route('signup.get', 'ユーザー登録へ') !!}</p>
                    </div>
                </div>
            </div>
        </div>    
    </body>
</html>
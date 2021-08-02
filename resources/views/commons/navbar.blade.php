<header class="mb-4">
    <nav class="navbar navbar-expand-sm navbar-dark bg-dark">
        {{-- トップページへのリンク --}}
        <a class="navbar-brand" href="/">carCollections</a>

        <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#nav-bar">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="nav-bar">
            <ul class="navbar-nav mr-auto"></ul>
            <ul class="navbar-nav">
                {{-- ユーザ登録ページへのリンク --}}
                <li class="nav-item text-white mr-4">{{ Auth::user()->name }}</li>
                {{-- ログアウトへのリンク --}}
                <li class="nav-item">{!! link_to_route('logout.get', 'ログアウト') !!}</li>
            </ul>
        </div>
    </nav>
</header>
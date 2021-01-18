<header class="mb-4">
    <nav class="navbar navbar-expand-sm navbar-dark bg-dark">
        {{-- トップページへのリンク --}}
        <a class="navbar-brand" href="/">TaskList</a>

        <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#nav-bar">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="nav-bar">
            <ul class="navbar-nav mr-auto"></ul>
            @if(Auth::check())
            <ul class="navbar-nav">
                {{-- 認証済み --}}
                <li class="nav-item">{!! link_to_route('tasks.create', 'Create New Task', [], ['class' => 'nav-link']) !!}</li>
                {{-- ログアウト --}}
                <li class="nav-item">{!! link_to_route('logout.get', 'Log out', [], ['class' => 'nav-link']) !!}</li>
            </ul>
            @else
            <ul class="navbar-nav">
                {{-- 認証なし--}}
                {{-- ユーザ登録ページへのリンク --}}
                <li class="nav-item">{!! link_to_route('signup.get', 'Sign up', [], ['class' => 'nav-link']) !!}</li>
                {{-- ログインページへのリンク --}}
                <li class="nav-item">{!! link_to_route('login', 'Log in', [], ['class' => 'nav-link']) !!}</li>
            </ul>
            @endif
        </div>
    </nav>
</header>
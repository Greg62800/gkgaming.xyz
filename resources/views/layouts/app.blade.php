<!doctype html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        @if(Auth::check())
            @if(Auth::user()->unreadNotifications->count())
                ({{ Auth::user()->unreadNotifications->count() }})
            @endif
        @endif
        @yield('title') | Gkgaming
    </title>
    <link rel="stylesheet" href="/css/app.css"/>
    <link rel="icon" href="{{ url('/img/favicon.ico') }}">
</head>
<body>
    <div id="account"></div>
    <div class="topbar">
        <div class="topbar__icon"></div>
        <a class="topbar__logo" href="/">GK</a>
        <div class="menu">
            <a href="/">Accueil</a>
            {{ HTML::link(route('blog.index'), 'Blog') }}
        </div>
    </div>
    <div class="menu__account{{ Auth::guest() ? ' unsigned' : ' signed_in' }}">
        @if(Auth::guest())
            <a href="{{ url('/auth/register') }}">S'inscrire</a>
            <a href="{{ url('/auth/login') }}">Se connecter</a>
        @else
            <div class="notifications" id="app">
                <a href="#">
                    <i class="fa fa-bell-o">
                        @if(Auth::user()->unreadNotifications->count())
                            <span class="notif">{{ Auth::user()->unreadNotifications->count() }}</span>
                        @endif
                    </i>
                </a>
                <div class="menu__notification">
                    <div class="notification__header">
                        Notifications
                    </div>
                    @foreach(Auth::user()->Notifications->take(3) as $notification)
                        @if($notification->type === 'App\Notifications\NewArticles')
                            <a href="{{ route('notifications.show', [($notification->type)::toId($notification->data), $notification->id]) }}" class="item {{ ($notification->read_at ? 'is_read' : '') }}">
                                {{ ($notification->type)::toText($notification->data) }}
                            </a>
                        @elseif($notification->type === 'App\Notifications\NewComments')
                            <a href="{{ route('notifications.show_article', [($notification->type)::toUrl($notification->data), $notification->id]) }}" class="item {{ ($notification->read_at ? 'is_read' : '') }}">
                                {{ ($notification->type)::toText($notification->data) }}
                            </a>
                        @else
                            <a href="{{ route('notifications.read', $notification->id) }}" class="item {{ ($notification->read_at ? 'is_read' : '') }}">
                                {{ ($notification->type)::toText($notification->data) }}
                            </a>
                        @endif
                    @endforeach
                    <a href="{{ route('notifications.index') }}" class="notification__footer">
                        <span>Toutes les notifications</span>
                    </a>
                </div>
            </div>
            <div class="block">
                <img src="{{ Auth::user()->avatar_file }}" class="avatar"/>
            </div>
        @endif
    </div>
    @if(Auth::user())
        <div class="menu__user">
            <header>
                <img class="avatar" src="{{ Auth::user()->avatar_file }}"/>
            </header>
            <div class="content">
                @if(Auth::user()->isAdmin())
                    <a href="{{ route('admin.index') }}">
                        <span class="icon">
                            <i class="fa fa-dashboard"></i>
                        </span>
                        Dashboard
                    </a>
                @endif
                <a href="{{ route('users.edit') }}">
                    <span class="icon">
                        <i class="fa fa-pencil"></i>
                    </span>
                    Editer mon compte
                </a>
                <a href="{{ route('profil.view') }}">
                    <span class="icon">
                        <i class="fa fa-user-circle"></i>
                    </span>
                    Mon compte
                </a>
                <a href="{{ route('users.logout') }}" class="logout">
                    <span class="icon logout">
                        <i class="fa fa-sign-out"></i>
                    </span>
                    Se déconnecter
                </a>
            </div>
        </div>
    @endif
    @yield('user_profil')
    <div class="container">
        @yield('breadcrumb')
        <div id="notification"></div>
        @if(Session::has('error'))
            <div class="notification error">
                {{ Session::get('error') }}
            </div>
        @endif
        @if(Session::has('success'))
            <div class="notification success">
                {{ Session::get('success') }}
            </div>
        @endif
        @yield('content')
    </div>
    <footer class="footer">
        &copy; <a href="{{ route('home.index') }}">GkGaming</a>
    </footer>
    <div class="back_to_top" id="back_to_top">
        <i class="fa fa-arrow-up"></i>
    </div>
{{ HTML::script('/js/jquery.js') }}
{{ HTML::script('/js/app.js') }}
</body>
</html>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>@yield('title') | GkGaming::Administration</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    {{ HTML::style('/Admin/app.css') }}
    {{ HTML::style('/Admin/custom.css') }}
</head>
<body>
    <div class="topbar">
        <div class="topbar__icon"></div>
        <a class="topbar__logo" href="{{ route('admin.index') }}">Administration</a>
        <div class="topbar__menu">
            <a href="{{ route('admin.index') }}">
                <i class="fa fa-dashboard"></i>
                Accueil
            </a>
            <div class="dropdown">
                <a href="#">
                    <span class="fa fa-newspaper-o"></span>
                    Articles
                    <i class="caret"></i>
                </a>
                <div class="dropdown-menu">
                    <a href="{{ route('admin.articles') }}">
                      <i class="fa fa-tasks"></i>
                      Gérer
                    </a>
                    <a href="{{ route('admin.articles.new') }}">
                      <i class="fa fa-plus"></i>
                      Ajouter un article
                    </a>
                </div>
            </div>
            <div class="dropdown">
                <a href="#">
                    <span class="fa fa-comments-o"></span>
                    Commentaires
                    <i class="caret"></i>
                </a>
                <div class="dropdown-menu">
                    <a href="#">
                      <i class="fa fa-tasks"></i>
                      Gérer
                    </a>
                    <a href="#">
                        <i class="fa fa-eye"></i>
                        Voir
                    </a>
                </div>
            </div>
            <a href="{{ route('home.index') }}">
                <i class="fa fa-code"></i>
                Voir le site
            </a>
            <div class="topbar__footer">
              <a href="{{ route('home.index') }}">GkGaming</a>
            </div>
        </div>
    </div>
    <div class="container">
        @yield('content')
    </div>
<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
<script src="/Admin/app.js"></script>
<script src="/Admin/custom.js"></script>
</body>
</html>

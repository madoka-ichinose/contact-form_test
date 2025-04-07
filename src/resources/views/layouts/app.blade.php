<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>FashionablyLate</title>
  <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
  <link rel="stylesheet" href="{{ asset('css/common.css') }}" />
  @yield('css')
</head>

<body>
 @if (!isset($hideHeader) || !$hideHeader)
  <header class="header">
    <div class="header__inner">
        <a class="header__logo" href="/">FashionablyLate</a>
        @if (!isset($hideNav) || !$hideNav)
         <nav>
            <ul class="header-nav">
                @if (request()->is('login'))
                    <li><a class="header-nav__link" href="/register">register</a></li>
                @elseif (request()->is('register'))
                    <li><a class="header-nav__link" href="/login">login</a></li>
                @else
                    @if (Auth::check())
                        <li>
                            <a class="header-nav__link" href="/logout" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                logout
                            </a>
                        </li>
                        <form id="logout-form" action="/logout" method="POST" style="display: none;">
                            @csrf
                        </form>
                    @else
                        <li><a class="header-nav__link" href="/register">register</a></li>
                    @endif
                @endif
            </ul>
         </nav>
        @endif
    </div>
 </header>
 @endif

  <main>
    @yield('content')
     
  </main>
   @yield('js')
</body>
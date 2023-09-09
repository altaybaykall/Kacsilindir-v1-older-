<!DOCTYPE html>
<html lang="tr-TR">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" href="{{ url('/images/kctitle.png') }}">
    <title>KacSilindir  @yield('title')</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous" />
    <script defer src="https://use.fontawesome.com/releases/v5.5.0/js/all.js" integrity="sha384-GqVMZRt5Gn7tB9D9q7ONtcp4gtHIUEW/yG7h98J7IpE3kpi+srfFyyB/04OV6pG0" crossorigin="anonymous"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Source+Sans+Pro:ital,wght@0,400;0,700;1,400;1,700&display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Signika:wght@500&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserra&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css'])
    @vite(['resources/js/app.js'])
</head>
<body>
<header class="header-bar mb-0">

    <a href="/">
        <img class = "main-logo" src="/images/logosmallbeyaz.png"></a>

    <div class="container d-flex flex-column flex-md-row align-items-center p-3 ">

        <ul class="navbar mr-auto   navbar-expand-sm-bg ">
            <li class="nav-item active px-3"><a href="/">Anasayfa</a></li>
            <li class="nav-item text-white px-3"><a href="/haberler">Haberler</a></li>
            <li class="nav-item px-3"><a href="/karsilastir">Karşılaştırma</a></li>

        </ul>

        <div class="row align-items-right">

            @auth
                <div class="col-mr-auto ">
                    <button class="btn btn-dark noHover dropdown-toggle" style="background-color:#23272b; border:none; height: 40px" type="button" id="menu1" data-toggle="dropdown">

                        @if(Auth::user()->avatar !== '/images/profileiconblack.png')
                            <img style="width: 35px; height: 35px; border-radius: 30px;" src="{{Auth::user()->avatar}}">
                        @else
                            <img style="width: 35px; height: 35px; border-radius: 30px;" src="/images/profileiconwhite.png" alt="pp" >
                        @endif
                        <span class="caret ml-2"></span>
                    </button>
                    <div class="dropdown-menu my-3">
                        <a class="dropdown-item" href="/profile">Profilim <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-lines-fill ml-2" viewBox="0 0 16 16">
                                <path d="M6 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm-5 6s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H1zM11 3.5a.5.5 0 0 1 .5-.5h4a.5.5 0 0 1 0 1h-4a.5.5 0 0 1-.5-.5zm.5 2.5a.5.5 0 0 0 0 1h4a.5.5 0 0 0 0-1h-4zm2 3a.5.5 0 0 0 0 1h2a.5.5 0 0 0 0-1h-2zm0 3a.5.5 0 0 0 0 1h2a.5.5 0 0 0 0-1h-2z"/>
                            </svg></a>
                        <a class="dropdown-item" href="/favorites">Favorilerim <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-star-fill ml-2" viewBox="0 0 16 16">
                                <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"/>
                            </svg></a>
                        <a class="dropdown-item" href="/karsilastir/listem">Karşılaştırmam </a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="{{ url('/logout') }}">Hesaptan Çık <svg xmlns="http://www.w3.org/2000/svg" width="13" height="15" fill="currentColor" class="bi bi-box-arrow-left ml-2" viewBox="0 0 16 16">
                                <path fill-rule="evenodd" d="M6 12.5a.5.5 0 0 0 .5.5h8a.5.5 0 0 0 .5-.5v-9a.5.5 0 0 0-.5-.5h-8a.5.5 0 0 0-.5.5v2a.5.5 0 0 1-1 0v-2A1.5 1.5 0 0 1 6.5 2h8A1.5 1.5 0 0 1 16 3.5v9a1.5 1.5 0 0 1-1.5 1.5h-8A1.5 1.5 0 0 1 5 12.5v-2a.5.5 0 0 1 1 0v2z"/>
                                <path fill-rule="evenodd" d="M.146 8.354a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L1.707 7.5H10.5a.5.5 0 0 1 0 1H1.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3z"/>
                            </svg></a>
                    </div>

                    @else
                        <div class="login-section">
                            <a href="/login" class="login-link" >Giriş yap</a>
                            <a href="/register" class="register-link" >Kayıt Ol</a>
                        </div>
                </div>
        </div>

    </div>
    @endauth
</header>
    <div class ="container-error" >

          <h2>404</h2>
         <h3>Oops! Aradığınız Sayfa Bulunamadı.</h3>
        <span><a href="/home">Anasayfaya dön</a> </span>
    </div>



</body>


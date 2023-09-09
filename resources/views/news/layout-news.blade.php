<!DOCTYPE html>
<html lang="tr_TR">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="icon" href="{{ url('/images/kctitle.png') }}">
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>KacSilindir - @yield('title')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="keywords" content="">
    <meta name="description" content="">
    <meta name="author" content="">
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous" />
    <script defer src="https://use.fontawesome.com/releases/v5.5.0/js/all.js" integrity="sha384-GqVMZRt5Gn7tB9D9q7ONtcp4gtHIUEW/yG7h98J7IpE3kpi+srfFyyB/04OV6pG0" crossorigin="anonymous"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Source+Sans+Pro:ital,wght@0,400;0,700;1,400;1,700&display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css'])
    @vite(['resources/css/news.css'])
    @vite(['resources/css/fullauthpage.css'])


</head>
<header class="header-bar mb-0">

    <a href="/">
        <img class = "main-logo" src="/images/logobeyaz.png"></a>
    <div class="container d-flex flex-column flex-md-row align-items-center pe-auto">
        <ul class="navbar mr-auto   navbar-expand-sm-bg ">

            <li class="nav-item  px-3"><a href="/">Anasayfa</a></li>
            <li class="nav-item text-white px-3"><a href="/haberler">Haberler</a></li>

            <li class="nav-item px-3 "><a href="/karsilastir">Karşılaştırma</a></li>

        </ul>
    </div>
        @auth
        <div class="row align-items-right mr-auto">
            <div class="authed">
                <button class="authed-button btn btn-dark noHover dropdown-toggle" type="button" id="menu1" data-toggle="dropdown">

                    @if(Auth::user()->avatar !== '/images/profileiconblack.png')
                        <img class="authed-img"  src="{{Auth::user()->avatar}}">
                    @else
                        <img class="authed-img" src="/images/profileiconwhite.png" alt="pp" >
                    @endif
                    <span class="caret ml-2"></span>
                </button>
                <div class="authed-drop dropdown-menu my-3 mr-auto">
                    <a class="dropdown-item" href="/profile">Profilim <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-lines-fill ml-2" viewBox="0 0 16 16">
                            <path d="M6 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm-5 6s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H1zM11 3.5a.5.5 0 0 1 .5-.5h4a.5.5 0 0 1 0 1h-4a.5.5 0 0 1-.5-.5zm.5 2.5a.5.5 0 0 0 0 1h4a.5.5 0 0 0 0-1h-4zm2 3a.5.5 0 0 0 0 1h2a.5.5 0 0 0 0-1h-2zm0 3a.5.5 0 0 0 0 1h2a.5.5 0 0 0 0-1h-2z"/>
                        </svg></a>
                    <a class="dropdown-item" href="/favorites">Favorilerim <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-star-fill ml-2" viewBox="0 0 16 16">
                            <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"/>
                        </svg></a>
                    @can('admin')
                        <a class="dropdown-item" href="/dashboard">Dashboard <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-lines-fill ml-2" viewBox="0 0 16 16">
                                <path d="M6 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm-5 6s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H1zM11 3.5a.5.5 0 0 1 .5-.5h4a.5.5 0 0 1 0 1h-4a.5.5 0 0 1-.5-.5zm.5 2.5a.5.5 0 0 0 0 1h4a.5.5 0 0 0 0-1h-4zm2 3a.5.5 0 0 0 0 1h2a.5.5 0 0 0 0-1h-2zm0 3a.5.5 0 0 0 0 1h2a.5.5 0 0 0 0-1h-2z"/>
                            </svg></a>
                    @endcan
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
<div class="container-sidebar ">
    <div class="sidebar-area">

        <a class ="sidebar-a" href="/">
            <div class="sidebar-b">
                <div class="sidebar-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="#fc9003" class="sidebar-icon bi bi-house-door-fill " viewBox="0 0 16 16">
                        <path d="M6.5 14.5v-3.505c0-.245.25-.495.5-.495h2c.25 0 .5.25.5.5v3.5a.5.5 0 0 0 .5.5h4a.5.5 0 0 0 .5-.5v-7a.5.5 0 0 0-.146-.354L13 5.793V2.5a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v1.293L8.354 1.146a.5.5 0 0 0-.708 0l-6 6A.5.5 0 0 0 1.5 7.5v7a.5.5 0 0 0 .5.5h4a.5.5 0 0 0 .5-.5Z"/>
                    </svg>
                </div>
                <div class="sidebar-content">
                    <span>Anasayfa</span>
                </div></div></a>



        <a class ="sidebar-a" href=/haberler>
            <div class="sidebar-b">
                <div class="sidebar-icon">
                    <svg viewBox="0 0 28 28" class="sidebar-icon" version="1.1"  xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"  fill="#222222"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier">  <g id="🔍-Product-Icons" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"> <g id="ic_fluent_news_28_filled" fill="#53bdb6" fill-rule="nonzero"> <path d="M22,5.75 L22,20.5 C22,20.7761424 22.2238576,21 22.5,21 C22.7454599,21 22.9496084,20.8231248 22.9919443,20.5898756 L23,20.5 L23,7 L24.25,7 C25.1681734,7 25.9211923,7.70711027 25.9941988,8.60647279 L26,8.75 L26,20.75 C26,22.4830315 24.6435452,23.8992459 22.9344239,23.9948552 L22.75,24 L5.25,24 C3.51696854,24 2.10075407,22.6435452 2.00514479,20.9344239 L2,20.75 L2,5.75 C2,4.8318266 2.70711027,4.07880766 3.60647279,4.0058012 L3.75,4 L20.25,4 C21.1681734,4 21.9211923,4.70711027 21.9941988,5.60647279 L22,5.75 L22,20.5 L22,5.75 Z M9.74652744,13.0034726 L7.25,13.0034726 C6.3318266,13.0034726 5.57880766,13.7105828 5.5058012,14.6099454 L5.5,14.7534726 L5.5,17.25 C5.5,18.1681734 6.20711027,18.9211923 7.10647279,18.9941988 L7.25,19 L9.74652744,19 C10.6647008,19 11.4177198,18.2928897 11.4907262,17.3935272 L11.4965274,17.25 L11.4965274,14.7534726 C11.4965274,13.8352992 10.7894172,13.0822802 9.89005465,13.0092738 L9.74652744,13.0034726 Z M17.75,17.5 L14.25,17.5 L14.1482294,17.5068466 C13.7821539,17.556509 13.5,17.8703042 13.5,18.25 C13.5,18.6296958 13.7821539,18.943491 14.1482294,18.9931534 L14.25,19 L17.75,19 L17.8517706,18.9931534 C18.2178461,18.943491 18.5,18.6296958 18.5,18.25 C18.5,17.8703042 18.2178461,17.556509 17.8517706,17.5068466 L17.75,17.5 Z M7.25,14.5034726 L9.74652744,14.5034726 C9.86487417,14.5034726 9.96401426,14.585706 9.98992476,14.6961499 L9.99652744,14.7534726 L9.99652744,17.25 C9.99652744,17.3683467 9.91429402,17.4674868 9.80385014,17.4933973 L9.74652744,17.5 L7.25,17.5 C7.13165327,17.5 7.03251318,17.4177666 7.00660268,17.3073227 L7,17.25 L7,14.7534726 C7,14.6351258 7.08223341,14.5359857 7.19267729,14.5100752 L7.25,14.5034726 L9.74652744,14.5034726 L7.25,14.5034726 Z M17.75,13.0034726 L14.25,13.0034726 L14.1482294,13.0103192 C13.7821539,13.0599816 13.5,13.3737768 13.5,13.7534726 C13.5,14.1331683 13.7821539,14.4469635 14.1482294,14.4966259 L14.25,14.5034726 L17.75,14.5034726 L17.8517706,14.4966259 C18.2178461,14.4469635 18.5,14.1331683 18.5,13.7534726 C18.5,13.3737768 18.2178461,13.0599816 17.8517706,13.0103192 L17.75,13.0034726 Z M17.75,8.49665793 L6.25,8.49665793 L6.14822944,8.50350455 C5.78215388,8.55316697 5.5,8.86696217 5.5,9.24665793 C5.5,9.6263537 5.78215388,9.94014889 6.14822944,9.98981132 L6.25,9.99665793 L17.75,9.99665793 L17.8517706,9.98981132 C18.2178461,9.94014889 18.5,9.6263537 18.5,9.24665793 C18.5,8.86696217 18.2178461,8.55316697 17.8517706,8.50350455 L17.75,8.49665793 Z" id="🎨-Color"> </path> </g> </g> </g></svg>
                </div>
                <div class="sidebar-content">
                    <span>Haberler</span>
                </div></div></a>


        <a class ="sidebar-a" href=/karsilastir>
            <div class="sidebar-b">
                <div class="sidebar-icon">
                    <svg fill="#e30544" class="sidebar-icon" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 256 256" xml:space="preserve"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M241.2,152.8L209,45.6h-73.5V32.3c0-3.6-3.6-7.3-7.3-7.3c-3.6,0-7.3,3.6-7.3,7.3v13.4H47.4L15.2,152.8h-0.7h-3.6 c0,24.3,19.7,44.1,44.1,44.1s44.1-19.7,44.1-44.1h-4.2h-0.7L63.8,52.3h57.7v156.4H64.4v22.4h7.3h56.5h56.5h7.3v-22.4h-57.1V52.3 h57.7l-30.4,100.5h-0.7h-4.2c0,24.3,19.7,44.1,44.1,44.1s44.1-19.7,44.1-44.1h-3.6H241.2z M84.2,152.8H25.8l28.9-97.5L84.2,152.8z M172.2,152.8l29.5-97.5l28.9,97.5H172.2z"></path> </g></svg>
                </div>
                <div class="sidebar-content">
                    <span>Karşılaştırma</span>
                </div></div></a>



    </div>
    <div class="car-area">
        <div class="cararea-icon">
            <svg viewBox="0 0 30 30" id="Layer_1"  height="27px" width="27px"version="1.1" xml:space="preserve" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" fill="#ffffff" stroke="#ffffff"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round" stroke="#CCCCCC" stroke-width="0.06"></g><g id="SVGRepo_iconCarrier"><style type="text/css"> .st0{fill:#FD6A7E;} .st1{fill:#17B978;} .st2{fill:#8797EE;} .st3{fill:#2499f9;} .st4{fill:#37E0FF;} .st5{fill:#2FD9B9;} .st6{fill:#F498BD;} .st7{fill:#525252;} .st8{fill:#C6C9CC;} </style><path class="st7" d="M27,8h-2c-2.2,0-4,1.8-4,4v7c0,0.6-0.4,1-1,1h-1V5c0-0.6-0.4-1-1-1H6C5.4,4,5,4.4,5,5v20H4c-0.6,0-1,0.4-1,1v1 h18v-1c0-0.6-0.4-1-1-1h-1v-3h1c1.7,0,3-1.3,3-3v-7h1c1.1,0,2-0.9,2-2h1c0.6,0,1-0.4,1-1S27.6,8,27,8z M8,11c0-2.2,1.8-4,4-4 s4,1.8,4,4v1h-2.9c0-0.2-0.1-0.3-0.2-0.4l-1.3-1.9c-0.2-0.2-0.5-0.4-0.8-0.3c-0.4,0.1-0.6,0.5-0.4,0.9L11,12H8V11z"></path></g></svg>
            <span class="car-area-header">
                   <a href="/markalar">Markalar</a>
                </span>
        </div>



        <ul id="car-area-ul">
        </ul>
    </div>

</div>

